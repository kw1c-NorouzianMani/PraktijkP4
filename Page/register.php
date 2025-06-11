<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
<?php
global $conn;
include '../Includes/header.php';
require '../Includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

  $_SESSION['user'] = $username;
  $_SESSION['welkom_status'] = "nieuw";  // 👈 Toegevoegd
    $_SESSION['flash'] = "Je account is aangemaakt. Welkom!";
    header("Location: index.php");
  exit;
}
?>
<section class="login-form">
  <h2>Registreren</h2>
  <form method="post">
    <label>Gebruikersnaam: <input type="text" name="username" required></label>
      <label>Wachtwoord:
          <div class="password-wrapper">
              <input type="password" name="password" id="password" required>
              <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
          </div>
      </label>
    <button type="submit">Account aanmaken</button>
  </form>
</section>
<?php include '../Includes/footer.php'; ?>


