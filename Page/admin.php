<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
<?php
global$conn;
include '../Includes/header.php';
require '../Includes/db.php';

// Controleer of gebruiker is ingelogd
if (!isset($_SESSION['user'])) {
  $_SESSION['flash'] = "Je moet ingelogd zijn.";
  header("Location: login.php");
  exit;
}

// Controleer of gebruiker een admin is
$stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = ?");
$stmt->execute([$_SESSION['user']]);
$is_admin = $stmt->fetchColumn();

if (!$is_admin) {
  $_SESSION['flash'] = "Je hebt geen toegang tot de adminpagina.";
  header("Location: index.php");
  exit;
}

// Haal gebruikers op uit database
$gebruikers = $conn->query("SELECT username, password, is_admin FROM users")->fetchAll();
?>

<section class="admin-panel">
  <h2>Admin Dashboard</h2>
  <p>Alle geregistreerde gebruikers:</p>
  <table>
    <tr><th>Gebruikersnaam</th><th>Password</th><th>Admin?</th></tr>
    <?php foreach ($gebruikers as $user): ?>
      <tr>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['password']) ?></td>
        <td><?= $user['is_admin'] ? '✅' : '❌' ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</section>

<?php include '../Includes/footer.php'; ?>

