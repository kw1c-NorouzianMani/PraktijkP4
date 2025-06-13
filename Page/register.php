<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
session_start(); // helemaal bovenaan
global $conn;
require '../Includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $plain_password = $_POST['password'];
    $password = password_hash($plain_password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $check->execute([$username]);

    if ($check->rowCount() > 0) {
        $_SESSION['flash'] = ["type" => "error", "message" => "Deze gebruikersnaam bestaat al. Kies een andere."];
        header("Location: register.php");
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);

        $_SESSION['user'] = $username;
        $_SESSION['welkom_status'] = "nieuw";
        $_SESSION['flash'] = ["type" => "success", "message" => "Je account is aangemaakt. Welkom!"];
        header("Location: index.php");
        exit;
    }
}

include '../Includes/header.php';
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





