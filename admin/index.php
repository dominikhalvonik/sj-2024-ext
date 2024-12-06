<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();
$menuItems = $admin->getMenu();
?>

<html>
<head>
    <title>Admin panel</title>
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="insert.php">Vlozit menu</a></li>
    </ul>
<table>
    <tr>
        <td>ID</td>
        <td>Meno</td>
        <td>Aktualizovat</td>
        <td>Vymazat</td>
    </tr>
    <?php
    foreach ($menuItems as $menuItem) {
        ?>
        <tr>
            <td><?php echo $menuItem['id']; ?></td>
            <td><?php echo $menuItem['content']; ?></td>
            <td><a href="update.php?id=<?php echo $menuItem['id']; ?>">Aktualizuj</a></td>
            <td><a href="delete.php?id=<?php echo $menuItem['id']; ?>">Vymazat</a></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
