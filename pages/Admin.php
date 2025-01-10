<?php 
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION["user_id"])) {
	header("Location: index.php?page=login");
	exit();
} elseif ($_SESSION['usertype'] != '1') {
	header("Location: index.php?page=search");
	exit();
}


require_once 'config.php';

// Connect to the database
$connection = new mysqli($_dbhost, $_dbusername, $_dbpassword, $_dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch all entries from the `escritorio` table
$result = $connection->query("SELECT * FROM escritorio");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gestão de Escritórios</h2>
    
    <!-- Table -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>ID Incubadora</th>
                <th>Tamanho (m²)</th>
                <th>Preço (€)</th>
                <th>Disponibilidade</th>
                <th>Número</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['IDIncubadora']; ?></td>
                    <td><?php echo $row['Tamanho']; ?> m²</td>
                    <td><?php echo $row['Preco']; ?></td>
                    <td><?php echo $row['Disponibilidade'] ? 'Sim' : 'Não'; ?></td>
                    <td><?php echo $row['Numero']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="populateEditForm(<?php echo htmlspecialchars(json_encode($row)); ?>)">Editar</button>
                        <form method="post" action="PHP/admin_actions.php" style="display:inline-block;">
                            <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza de que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Form for adding or editing -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 id="form-title" class="mb-0">Adicionar Escritório</h3>
        </div>
        <div class="card-body">
            <form method="post" action="PHP/admin_actions.php">
                <input type="hidden" name="ID" id="edit-ID">
                
                <div class="mb-3">
                    <label for="edit-IDIncubadora" class="form-label">ID Incubadora:</label>
                    <input type="number" name="IDIncubadora" id="edit-IDIncubadora" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="edit-Tamanho" class="form-label">Tamanho (m²):</label>
                    <input type="number" name="Tamanho" id="edit-Tamanho" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="edit-Preco" class="form-label">Preço (€):</label>
                    <input type="number" step="0.01" name="Preco" id="edit-Preco" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="edit-Disponibilidade" class="form-label">Disponibilidade:</label>
                    <select name="Disponibilidade" id="edit-Disponibilidade" class="form-select" required>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="edit-Numero" class="form-label">Número:</label>
                    <input type="text" name="Numero" id="edit-Numero" class="form-control" required>
                </div>
                
                <button type="submit" name="add" id="add-button" class="btn btn-success">Adicionar</button>
                <button type="submit" name="update" id="update-button" class="btn btn-primary" style="display:none;">Atualizar</button>
            </form>
        </div>
    </div>
</div>

<script>
function populateEditForm(data) {
    document.getElementById('form-title').textContent = 'Editar Escritório';
    document.getElementById('edit-ID').value = data.ID;
    document.getElementById('edit-IDIncubadora').value = data.IDIncubadora;
    document.getElementById('edit-Tamanho').value = data.Tamanho;
    document.getElementById('edit-Preco').value = data.Preco;
    document.getElementById('edit-Disponibilidade').value = data.Disponibilidade;
    document.getElementById('edit-Numero').value = data.Numero;
    document.getElementById('add-button').style.display = 'none';
    document.getElementById('update-button').style.display = 'inline-block';
}
</script>

<?php $connection->close(); ?>
