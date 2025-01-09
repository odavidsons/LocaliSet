const form = document.getElementById('AddFormulario');
const modalElement = document.getElementById('addEmployeeModal'); // Obtém o elemento modal
const modal = new bootstrap.Modal(modalElement); // Inicializa o modal


form.addEventListener('submit', function(event) {
    event.preventDefault();

    const officeNumber = document.getElementById('Numero').value;
    const officeSize = document.getElementById('Tamanho').value;
    const officePrice = document.getElementById('Preco').value;
    const officeIncubator = document.getElementById('IdIncubadora').value;
    const officeAvailability = document.getElementById('Disponibilidade').value;

    fetch('../PHP/adicionarescritorio.php', {
        method: 'POST',
        body: new URLSearchParams({
            acao: 'adicionar', // Envia a ação para o PHP
            officeNumber,
            officeSize,
            officePrice,
            officeIncubator,
            officeAvailability
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            form.reset();
            modal.hide();
            adicionarLinhaNaTabela(officeNumber, officeSize, officePrice, officeIncubator, officeAvailability);
        } else {
            console.error('Erro ao adicionar escritório:', data.message);
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
        alert("Erro na requisição");
    });
});

function adicionarLinhaNaTabela(officeNumber, officeSize, officePrice, officeIncubator, officeAvailability) {
    const tabela = document.querySelector('table tbody');
    const novaLinha = tabela.insertRow();
    const celulaNumero = novaLinha.insertCell();
    const celulaTamanho = novaLinha.insertCell();
    const celulaPreco = novaLinha.insertCell();
    const celulaIncubadora = novaLinha.insertCell();
    const celulaDisponibilidade = novaLinha.insertCell();
    const celulaAcoes = novaLinha.insertCell();

    celulaNumero.textContent = officeNumber;
    celulaTamanho.textContent = officeSize;
    celulaPreco.textContent = officePrice;
    celulaIncubadora.textContent = officeIncubator;
    celulaDisponibilidade.textContent = officeAvailability;
    celulaAcoes.innerHTML = '<button class="btn btn-sm btn-primary">Editar</button> <button class="btn btn-sm btn-danger">Deletar</button>';
}