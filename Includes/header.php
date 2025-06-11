<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
<?php
global $conn;
session_start();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>MijnJumbo</title>
    <link rel="stylesheet" href="../Style/style.css" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script> <!-- icon library -->
</head>
<body>
<header class="main-header">
    <div class="logo">
        <img src="../Assest/WEJV_logo.png" alt="Logo" height="40">
    </div>
    <nav>
        <ul>
            <?php
            $is_admin = false;
            if (isset($_SESSION['user'])) {
                require_once '../Includes/db.php';
                $stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = ?");
                $stmt->execute([$_SESSION['user']]);
                $is_admin = $stmt->fetchColumn();
            }
            ?>

            <ul>
                <li><a href="../Page/index.php"><i class="ph ph-house"></i></a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($is_admin): ?>
                        <li><a href="../Page/admin.php">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="../Page/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../Page/login.php">Login</a></li>
                    <li><a href="../Page/register.php">Register</a></li>
                <?php endif; ?>
            </ul>

        </ul>
    </nav>
</header>
<main>

</main>
<?php if (isset($_SESSION['flash'])): ?>
    <div class="flash-message" id="flash">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

