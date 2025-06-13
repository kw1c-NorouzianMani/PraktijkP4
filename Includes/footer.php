<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
</main>
<footer class="main-footer">
    <p>
        &copy; <?= date('Y') ?> Wat Eet Je Vandaag |
        <?= isset($_SESSION['user']) ? "Ingelogd als " . $_SESSION['user'] : "Niet ingelogd" ?>
    </p>
</footer>
</div> <!-- sluit .page-container -->
<script src="../JavaScript/script.js"></script>
</body>
</html>


