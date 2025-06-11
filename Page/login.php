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
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['welkom_status'] = "terug";  // 👈 Toegevoegd
        $_SESSION['flash'] = "Je bent succesvol ingelogd.";
        header("Location: index.php");
        exit;
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>
<section class="login-form">
    <h2>Inloggen</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <label>Gebruikersnaam: <input type="text" name="username" required></label>
        <label>Wachtwoord:
            <div class="password-wrapper">
                <input type="password" name="password" id="password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
            </div>
        </label>
        <button type="submit">Inloggen</button>
    </form>
</section>
<?php include '../Includes/footer.php'; ?>



