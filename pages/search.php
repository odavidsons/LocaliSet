<?php
try {
    $stmt = $connection->query('SELECT * FROM incubadora');
    $incubadoras = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching locations: " . $e->getMessage();
    $incubadoras = [];
}


?>
<div class="container">
<div class="search_content">
<h1>Incubadoras empresariais no Porto</h1>
    <div id="map"></div>
    <div class="details">
        <form id="markerForm" method="POST" action="PHP/add_favorito.php">
            <label for="markerSelect">Selecione uma localização:</label>
            <select id="markerSelect" name="marker">
                <option value="">-- Opções --</option>
              
                
            </select>
            <label for="escritorioSelect">Selecionar Escritório:</label>
            <select id="escritorioSelect" name="escritorio" disabled>
                <option value="">-- Opções --</option>
            </select>
            
            <label for="monthSelect">Duração de renda:</label>
            <select id="monthSelect" name="months" disabled>
                <option value="">-- Selecionar meses --</option>
                <option value="1">1 mês</option>
                <option value="3">3 Meses</option>
                <option value="6">6 Meses</option>
                <option value="12">12 Meses</option>
                <option value="24">24 Meses</option>
                <option value="36">36 Meses</option>
                <option value="48">48 Meses</option>
            </select>

            <div id="totalCost" style="margin-top: 10px; font-weight: bold;">Custo total: 0€</div>

            <input type="hidden" name="totalCost" id="hiddenTotalCost" />
            <button type="submit" name="save_favorite" class="btn btn-primary" style="margin-top: 20px;" disabled id="saveSearchBtn">
                Guardar nos Favoritos
            </button>
        </form>
        <div id="details"></div>
        <div id="markerDetails"></div>
    </div>
</div></div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const monthSelect = document.getElementById('monthSelect');
    const totalCostDiv = document.getElementById('totalCost');

    let selectedOffice = null;
    const map = L.map('map').setView([41.146597, -8.640078], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

      // Fetch incubadoras and add them to the map and dropdown
      fetch('PHP/load_markers.php')
            .then(response => response.json())
            .then(data => { try {
                console.log("%j", data);
                } catch (e) {
                    console.error('Error parsing JSON:', data);
                }
                const markerSelect = document.getElementById('markerSelect');
                const escritorioSelect = document.getElementById('escritorioSelect');
                const detailsDiv = document.getElementById('details');
                const saveSearchBtn = document.getElementById('saveSearchBtn');

                data.forEach(location => {
                    // Add marker to the map
                    console.log(location.Nome,location.Latitude, location.Longitude);
                    const marker = L.marker([location.Latitude, location.Longitude]).addTo(map);
                    marker.bindPopup(`<b>${location.Nome}</b><br>Telefone: ${location.Contacto}<br>Email: ${location.Email}`);

                    // Add option to the dropdown
                    const option = document.createElement('option');
                    option.value = location.ID;
                    option.textContent = location.Nome;
                    markerSelect.appendChild(option);
                });

                // Load offices when an Incubadora is selected
                markerSelect.addEventListener('change', function () {
                    const selectedId = this.value;

                    // Reset Escritório dropdown and disable it initially
                    escritorioSelect.innerHTML = '<option value="">-- Selecionar Escritório --</option>';
                    escritorioSelect.disabled = true;
                    detailsDiv.innerHTML = '';

                    if (selectedId) {
                        console.log(selectedId);
                        // Fetch offices for the selected Incubadora
                        fetch(`PHP/load_escritorios.php?incubadora_id=${selectedId}`)
                            .then(response => response.json())
                            .then(offices => {  try {
                                console.log(JSON.parse(offices));
                            } catch (e) {
                                console.error('Error parsing JSON:', offices);
                            }
                                if (offices.length > 0) {
                                    offices.forEach(office => {
                                        console.log(office);
                                        const option = document.createElement('option');
                                        option.value = office.id;
                                        option.textContent = `Nº${office.numero} - ${office.tamanho}m² - ${office.preco}€`;
                                        option.setAttribute('data-preco',office.preco);
                                        escritorioSelect.appendChild(option);
                                    });
                                    escritorioSelect.disabled = false;
                                } else {
                                    escritorioSelect.disabled = true;
                                    alert('Não existem escritórios disponíveis.');
                                }
                            })
                            .catch(error => console.error('Erro ao carregar escritórios:', error));
                    } else {
                        escritorioSelect.disabled = true;
                    }
                });

                escritorioSelect.addEventListener('change', function () {
                    const selectedOption = escritorioSelect.options[escritorioSelect.selectedIndex];

                    if (selectedOption.dataset.preco) {
                        const price = parseFloat(selectedOption.dataset.preco); // Get price from data-price attribute
                        selectedOfficePreco = selectedOption.dataset.preco;
                        console.log(selectedOfficePreco);
                        monthSelect.disabled = false;
                    } else {
                        selectedOfficePreco = null;
                        monthSelect.disabled = true;
                    }

                    // Reset the total cost
                    totalCostDiv.textContent = 'Custo estimado: 0€';
                });


                // Handle month selection and calculate total cost
                monthSelect.addEventListener('change', function () {
                    const months = parseInt(this.value, 10);
                    
                    if (selectedOfficePreco && months > 0) {
                        const totalCost = selectedOfficePreco * months;
                        if (months < 24) {
                            var finalTaxCost = totalCost + (totalCost * 0.23);
                            totalCostDiv.innerHTML = `Período de renda de ${months} meses <br> Custo estimado: ${totalCost}€ <br> Taxa aplicada: 23% <br> Valor total: ${finalTaxCost}`;
                            hiddenTotalCost.value = totalCostDiv.innerHTML;
                        } else {
                            var finalTaxCost = totalCost + (totalCost * 0.13);
                            totalCostDiv.innerHTML = `Período de renda de ${months} meses <br> Custo estimado: ${totalCost}€ <br> Taxa aplicada: 13% <br> Valor total: ${finalTaxCost}`;
                            hiddenTotalCost.value = totalCostDiv.innerHTML;
                        }
                        saveSearchBtn.disabled = false;
                    } else {
                        totalCostDiv.textContent = 'Custo estimado: 0€';
                        hiddenTotalCost.value = '';
                        saveSearchBtn.disabled = true;
                    }
                });
            })
            .catch(error => console.error('Erro ao carregar dados:', error));
</script>