<?php
include_once "classes/Menu.php";

use classes\Menu;
$menu = new Menu();

if(!file_exists("menu.json")) {
    $menu->saveDataToFile();
}
