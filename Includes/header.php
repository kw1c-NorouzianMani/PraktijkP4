<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Wat Eet Je Vandaag</title>
    <link rel="stylesheet" href="../Style/style.css" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
<div class="page-container">
    <header class="main-header">
        <!-- Logo als link naar home -->
        <a href="../Page/index.php" class="logo">
            <img src="../Assest/WEJV_logo.png" alt="Logo" height="40">
        </a>

        <!-- Zoekbalk in de navbar -->
        <!-- Zoekbalk + filters in de navbar -->
        <div class="nav-search-bar">
            <form method="get" action="../Page/artikelen.php" style="display: flex; gap: 0.5em; align-items: center;">
                <input type="text" name="zoek" placeholder="Zoek een artikel..." style="flex: 2; padding: 0.5em; border-radius: 20px; border: 1px solid #ccc;">

                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                global $conn;
                // Haal genres en auteurs op
                require_once '../Includes/db.php';
                $genres = $conn->query("SELECT * FROM genre")->fetchAll();
                $auteurs = $conn->query("SELECT * FROM author")->fetchAll();
                ?>

                <select name="genre" style="flex: 1; padding: 0.4em; border-radius: 20px;">
                    <option value="">Genre</option>
                    <?php foreach ($genres as $g): ?>
                        <option value="<?= $g['id'] ?>"><?= htmlspecialchars($g['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="auteur" style="flex: 1; padding: 0.4em; border-radius: 20px;">
                    <option value="">Auteur</option>
                    <?php foreach ($auteurs as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" style="padding: 0.4em 1em; border-radius: 20px;">Zoek</button>
            </form>
        </div>

        <!-- Navigatie -->
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
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($is_admin): ?>
                        <li><a href="../Page/admin.php">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="../Page/artikelen.php">Artikelen</a></li>
                    <li><a href="../Page/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../Page/login.php">Login</a></li>
                    <li><a href="../Page/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="content">

    </main>

    <?php if (isset($_SESSION['flash'])): ?>
        <?php
        $type = $_SESSION['flash']['type'] === 'error' ? 'flash-error' : 'flash-success';
        $message = $_SESSION['flash']['message'];
        ?>
        <div class="flash-message <?= $type ?>" id="flash"><?= htmlspecialchars($message) ?></div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>



