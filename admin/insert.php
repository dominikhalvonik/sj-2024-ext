<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();


if(isset($_POST['submit'])) {
    $insert = $admin->insertMenu($_POST);
    if($insert) {
        echo '<p style="color: green">Zaznam uspesne vlozeny</p>';
    } else {
        echo '<p style="color: red">Zaznam neuspesne vlozeny</p>';
    }
}

?>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="insert.php">Vlozit menu</a></li>
</ul><br>
<form action="insert.php" method="post">
    <input type="text" name="class" value="" placeholder="CSS class"><br>
    <input type="text" name="class-a" value="" placeholder="CSS A class"><br>
    <input type="text" name="href" value="" placeholder="Link"><br>
    <input type="text" name="css-id" value="" placeholder="CSS id"><br>
    <input type="text" name="role" value="" placeholder="CSS role"><br>
    <input type="text" name="data-bs-toggle" value="" placeholder="Data attribute"><br>
    <input type="text" name="aria-expanded" value="" placeholder="CSS expanded"><br>
    <input type="text" name="content" value="" placeholder="Name"><br>
    <input type="text" name="class-ul" value="" placeholder="CSS UL"><br>
    <input type="text" name="aria-labelledby" value="" placeholder="CSS Labelled By"><br>
    <input type="submit" name="submit" value="Odoslat">
</form>