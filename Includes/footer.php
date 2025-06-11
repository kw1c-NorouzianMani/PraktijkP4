<?php
/**
 * Maker: Mani Norouzian
 * Date: 21-05-2025
 */
?>
</main>
<footer class="main-footer">
    <p>
        &copy; <?= date('Y') ?> MijnJumbo |
        <?= isset($_SESSION['user']) ? "Ingelogd als " . $_SESSION['user'] : "Niet ingelogd" ?>
    </p>
</footer>
<script src="../JavaScript/script.js"></script>
</body>
</html>

