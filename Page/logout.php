<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
<?php
session_start();
$_SESSION['flash'] = "Je bent uitgelogd.";
session_destroy();
header("Location: index.php");
exit;

