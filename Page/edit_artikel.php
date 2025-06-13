<?php
global $conn;
include '../Includes/header.php';
require '../Includes/db.php';

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

// Ophalen artikel
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    echo "Geen ID opgegeven.";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM menu_info WHERE id = ?");
$stmt->execute([$id]);
$artikel = $stmt->fetch();

if (!$artikel) {
    echo "Artikel niet gevonden.";
    exit;
}

// Update verwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $prepare_time = $_POST['prepare_time'];

    $stmt = $conn->prepare("UPDATE menu_info SET name = ?, description = ?, prepare_time = ? WHERE id = ?");
    $stmt->execute([$name, $description, $prepare_time, $id]);

    $_SESSION['flash'] = "Artikel bijgewerkt.";
    header("Location: artikelen.php");
    exit;
}
?>

<section class="login-form">
    <h2>Artikel bewerken</h2>
    <form method="post">
        <label>Titel:
            <input type="text" name="name" value="<?= htmlspecialchars($artikel['name']) ?>" required>
        </label>
        <label>Beschrijving:
            <textarea name="description" required><?= htmlspecialchars($artikel['description']) ?></textarea>
        </label>
        <label>Bereidingstijd (minuten):
            <input type="number" name="prepare_time" value="<?= $artikel['prepare_time'] ?>" required>
        </label>
        <button type="submit">Opslaan</button>
    </form>
</section>

<?php include '../Includes/footer.php'; ?>

