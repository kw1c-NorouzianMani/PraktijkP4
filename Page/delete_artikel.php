<?php
global $conn;
require '../Includes/db.php';
session_start();

// Alleen admin toegang
if (!isset($_SESSION['user'])) {
    $_SESSION['flash'] = "Je moet ingelogd zijn.";
    header("Location: login.php");
    exit;
}
$stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = ?");
$stmt->execute([$_SESSION['user']]);
$is_admin = $stmt->fetchColumn();
if (!$is_admin) {
    $_SESSION['flash'] = "Geen toegang.";
    header("Location: index.php");
    exit;
}

// Artikel verwijderen
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    echo "Geen ID opgegeven.";
    exit;
}

$stmt = $conn->prepare("DELETE FROM menu_info WHERE id = ?");
$stmt->execute([$id]);

$_SESSION['flash'] = "Artikel verwijderd.";
header("Location: artikelen.php");
exit;
?>

