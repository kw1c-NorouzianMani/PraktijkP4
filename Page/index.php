<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../Includes/header.php';

// Tellen hoe vaak gebruiker bezoekt
if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 1;
} else {
    $_SESSION['visits']++;
}
?>

<section class="home-intro">
    <?php if (isset($_SESSION['user'])): ?>
        <?php if (isset($_SESSION['welkom_status']) && $_SESSION['welkom_status'] === 'nieuw'): ?>
            <h2>Welkom, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
        <?php else: ?>
            <h2>Welkom terug, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
        <?php endif; ?>
        <a href="../Page/artikelen.php">Bekijk alle artikelen</a>
        <?php unset($_SESSION['welkom_status']); ?>
    <?php else: ?>
        <h2>Welkom bij Wat Eet Jij Vandaag</h2>
    <?php endif; ?>

    <img src="../Assest/banner.jpg" alt="Banner" />
</section>
<?php include '../Includes/footer.php'; ?>

