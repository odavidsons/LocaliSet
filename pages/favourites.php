<?php
if (!isset($_SESSION['username'])) {
    ?>
    <script type="text/javascript">
        location = "index.php?&error=Acesso negado"
    </script>
    <?php
}
$username = $_SESSION['username'];
$userId = $_SESSION['user_id'];	
?>
<div class="profile_content">
    <?php
    //Alert messages
    if (isset($_GET['error']) && $_GET['error'] != "") {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' id='uploadAlert'>
        ".$_GET['error']."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>
    
    <!-- Display user stats -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bem vindo <?php echo $_SESSION['username'] ?></h5>

        </div>
    </div>
</div>
