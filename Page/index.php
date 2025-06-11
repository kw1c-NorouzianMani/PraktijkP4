<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
<?php
include '../Includes/header.php';

// Tellen hoe vaak deze gebruiker de website heeft bezocht
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
        <?php unset($_SESSION['welkom_status']); ?>
    <?php else: ?>
        <h2>Welkom bij Wat Eet Jij Vandaag</h2>
    <?php endif; ?>

    <p>Ontdek en beheer jouw favoriete items!</p>
    <img src="../Assest/banner.jpg" alt="Banner" />
</section>

<!-- Verborgen broncode met teller -->
<!-- bezoekersteller: <?= $_SESSION['visits'] ?> keer bezocht -->

<?php include '../Includes/footer.php'; ?>

