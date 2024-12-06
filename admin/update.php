<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();
$menuItems = $admin->getMenu($_GET['id']);
$menuItem = $menuItems[0];

if(isset($_POST['submit'])) {
    $update = $admin->updateMenu($_POST['id'], $_POST);

    if($update) {
        header("Location: index.php");
    } else {
        echo '<p style="color: red">Zaznam neuspesne vlozeny</p>';
    }
}
?>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="insert.php">Vlozit menu</a></li>
</ul><br>
<form action="update.php" method="post">
    <input type="text" name="class" value="<?php echo $menuItem['class']; ?>" placeholder="CSS class"><br>
    <input type="text" name="class-a" value="<?php echo $menuItem['class-a']; ?>" placeholder="CSS A class"><br>
    <input type="text" name="href" value="<?php echo $menuItem['href']; ?>" placeholder="Link"><br>
    <input type="text" name="css-id" value="<?php echo $menuItem['css-id']; ?>" placeholder="CSS id"><br>
    <input type="text" name="role" value="<?php echo $menuItem['role']; ?>" placeholder="CSS role"><br>
    <input type="text" name="data-bs-toggle" value="<?php echo $menuItem['data-bs-toggle']; ?>" placeholder="Data attribute"><br>
    <input type="text" name="aria-expanded" value="<?php echo $menuItem['aria-expanded']; ?>" placeholder="CSS expanded"><br>
    <input type="text" name="content" value="<?php echo $menuItem['content']; ?>" placeholder="Name"><br>
    <input type="text" name="class-ul" value="<?php echo $menuItem['class-ul']; ?>" placeholder="CSS UL"><br>
    <input type="text" name="aria-labelledby" value="<?php echo $menuItem['aria-labelledby']; ?>" placeholder="CSS Labelled By"><br>
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" name="submit" value="Aktualizuj">
</form>