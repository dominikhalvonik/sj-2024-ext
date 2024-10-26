<?php
include_once "classes/Menu.php";

use classes\Menu;
$menu = new Menu();
?>
<nav class="navbar navbar-expand-lg bg-light shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" class="logo img-fluid" alt="Kind Heart Charity">
            <span>
                        Kind Heart Charity
                        <small>Non-profit Organization</small>
                    </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php echo $menu->getMenuFromFile("header"); ?>
            </ul>
        </div>
    </div>
</nav>