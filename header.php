<header class="p-2">
	<div class="container-fluid">
		<div class="d-flex flex-wrap justify-content-center justify-content-lg-start">
			<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
			<?php
                if (isset($_SESSION['username'])) {
				echo '
                <li class="nav-item">
					<a class="nav-link text-light" href="index.php?page=search">Pesquisar escritórios</a>
				</li>';
				} else {
					echo '<li class="nav-item">
					<a class="nav-link text-light">O acesso sem conta não é permitido</a>
				</li>';
				}
				?>
			</ul>
			<div class="text-end">
				<ul class="nav">
                <?php
                if (isset($_SESSION['username'])) {
					if ($_SESSION['usertype'] == '1') {
						echo "<li class='nav-item'>
						<a class='nav-link text-light' href='index.php?page=adminPanel'>Admin Panel</a>
						</li>";
					}
                    ?>
					<li class="nav-item">
						<a class="nav-link text-light" href="index.php?page=favourites">Favoritos</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link text-light"><?php echo $_SESSION['username'] ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="index.php?page=logout"><span class='material-symbols-outlined align-middle'>logout</span> </a>
					</li>
                    <?php
                } else {
                    ?>
					<li class="nav-item">
						<a class="nav-link text-light"></a>
					</li>
                    <!-- Icon style 
					<li class="nav-item dropdown-center">
					<a class="nav-link dropdown-toggle text-light" href="#" data-bs-toggle="dropdown"
						aria-expanded="false">Sessão</a>
					<ul class="dropdown-menu">
						<li>
							<a class="dropdown-item text-dark"
								href="index.php?page=login">Entrar</a>
						</li>
						<li>
							<a class="dropdown-item text-dark"
								href="index.php?page=signup">Registar</a>
						</li>
					</ul>
				    </li>-->
                    <?php
                }
                ?>
				</ul>
			</div>
		</div>
	</div>
</header>