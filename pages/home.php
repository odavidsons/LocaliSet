<?php

?>
<div class="container-flex">
    <div class="home_content">
        <?php
        //Alert messages
        if (isset($_GET['accountdelete']) && $_GET['accountdelete'] == "success") {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='uploadAlert'>
            Account deleted successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        if (isset($_GET['accessrestricted']) && $_GET['accessrestricted'] == 'true') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' id='accessAlert'>
            Access to this page is restricted!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>

        <!-- Centered Card -->
        <div class="container-centered">
            <div class="card text-center" id="home_welcome_card">
                <div class="card-body">
                    <h5 class="card-title">Bem Vindo</h5>
                    <br>
                    <p class="card-text">Texto a explicar o projeto</p>
                </div>
            </div>
        </div>
    </div>
</div>
