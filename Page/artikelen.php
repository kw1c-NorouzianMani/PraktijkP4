<?php
global $conn, $artikel;
include '../Includes/header.php';
require '../Includes/db.php';

// Zoek/filter parameters
$zoekterm = isset($_GET['zoek']) ? $_GET['zoek'] : '';
$genre_id = isset($_GET['genre']) ? $_GET['genre'] : '';
$author_id = isset($_GET['auteur']) ? $_GET['auteur'] : '';

// Query voorbereiden
$query = "SELECT m.*, g.name AS genre, a.name AS auteur
          FROM menu_info m
          LEFT JOIN genre g ON m.genre_id_1 = g.id
          LEFT JOIN author a ON m.author_id = a.id
          WHERE 1=1";

$params = [];

if ($zoekterm) {
    $query .= " AND (m.name LIKE ? OR m.ingredients LIKE ?)";
    $params[] = "%$zoekterm%";
    $params[] = "%$zoekterm%";
}

if ($genre_id) {
    $query .= " AND m.genre_id_1 = ?";
    $params[] = $genre_id;
}

if ($author_id) {
    $query .= " AND m.author_id = ?";
    $params[] = $author_id;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$artikelen = $stmt->fetchAll();

// Haal alle genres en auteurs voor dropdowns
$genres = $conn->query("SELECT * FROM genre")->fetchAll();
$auteurs = $conn->query("SELECT * FROM author")->fetchAll();
?>

<section class="artikel-filter">
    <h2>Zoek & Filter Artikelen</h2>
    <form method="get">
        <input type="text" name="zoek" placeholder="Zoek op naam of ingrediënten..." value="<?= htmlspecialchars($zoekterm) ?>">

        <select name="genre">
            <option value="">Alle genres</option>
<?php
  $imageData = base64_encode($artikel['img']);
  $imageType = "image/jpeg"; // of image/png, afhankelijk van jouw data
?>
<img src="data:<?= $imageType ?>;base64,<?= $imageData ?>" alt="Afbeelding van artikel" style="max-width:100%; height:auto; border-radius: 8px; margin-bottom: 1em;">
                    <p><strong>Genre:</strong> <?= htmlspecialchars($artikel['genre']) !== null ? htmlspecialchars($artikel['genre']) : 'Onbekend' ?></p>
                    <p><strong>Auteur:</strong> <?= htmlspecialchars($artikel['auteur']) !== null ? htmlspecialchars($artikel['auteur']) : 'Onbekend' ?></p>
                    <p><?= substr(htmlspecialchars($artikel['description']), 0, 100) ?>...</p>
                    <p><strong>Bereidingstijd:</strong> <?= $artikel['prepare_time'] ?> min</p>

                    <?php
                    // admin-knoppen tonen
                    if (isset($_SESSION['user'])) {
                        $stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = ?");
                        $stmt->execute([$_SESSION['user']]);
                        $is_admin = $stmt->fetchColumn();

                        if ($is_admin): ?>
                            <div class="admin-knoppen">
                                <a href="../Page/edit_artikel.php?id=<?= $artikel['id'] ?>">Bewerken</a>
                                <a href="../Page/delete_artikel.php?id=<?= $artikel['id'] ?>" onclick="return confirm('Weet je zeker dat je dit artikel wilt verwijderen?');">Verwijder</a>
                            </div>
                        <?php endif; } ?>
                </div>
        </select>

        <select name="auteur">
            <option value="">Alle auteurs</option>
            <?php foreach ($auteurs as $a): ?>
                <option value="<?= $a['id'] ?>" <?= $author_id == $a['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($a['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Zoeken</button>
    </form>
</section>

<section class="artikel-lijst">
    <?php if (count($artikelen) === 0): ?>
        <p>Geen resultaten gevonden.</p>
    <?php else: ?>
        <?php foreach ($artikelen as $artikel): ?>
            <div class="artikel-kaart">
                <h3><?= htmlspecialchars($artikel['name']) ?></h3>
                <p><strong>Genre:</strong> <?= htmlspecialchars($artikel['genre']) !== null ? htmlspecialchars($artikel['genre']) : 'Onbekend' ?></p>
                <p><strong>Auteur:</strong> <?= htmlspecialchars($artikel['auteur']) !== null ? htmlspecialchars($artikel['auteur']) : 'Onbekend' ?></p>
                <p><?= substr(htmlspecialchars($artikel['description']), 0, 100) ?>...</p>
                <p><strong>Bereidingstijd:</strong> <?= $artikel['prepare_time'] ?> min</p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<?php include '../Includes/footer.php'; ?>

