<?php
$page_title = 'Nos Destinations - Wonderly';
$page_description = 'Decouvrez les plus belles destinations en Cote d\'Ivoire et a travers le monde';
$current_page = 'destinations';

require_once 'includes/functions.php';

$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$destinations = getDestinations(null, $category);

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Nos Destinations</h1>
        <p>Decouvrez les plus belles destinations en Cote d'Ivoire et a travers le monde</p>
    </div>
</section>

<section class="container">
    <div class="filters">
        <a href="destinations.php?category=all" class="filter-btn <?php echo $category === 'all' ? 'active' : ''; ?>">Tous</a>
        <a href="destinations.php?category=ci" class="filter-btn <?php echo $category === 'ci' ? 'active' : ''; ?>">Cote d'Ivoire</a>
        <a href="destinations.php?category=afrique" class="filter-btn <?php echo $category === 'afrique' ? 'active' : ''; ?>">Afrique</a>
        <a href="destinations.php?category=international" class="filter-btn <?php echo $category === 'international' ? 'active' : ''; ?>">International</a>
        <a href="destinations.php?category=luxe" class="filter-btn <?php echo $category === 'luxe' ? 'active' : ''; ?>">Luxe</a>
    </div>
</section>

<section class="container">
    <div class="destinations-grid">
        <?php if (empty($destinations)): ?>
            <p style="grid-column: 1/-1; text-align: center; padding: 40px;">Aucune destination trouvee.</p>
        <?php else: ?>
            <?php foreach ($destinations as $dest): ?>
            <div class="dest-card">
                <div class="img-wrap" style="background-image:url('<?php echo $dest['image']; ?>');">
                    <span class="badge"><?php echo $dest['badge']; ?></span>
                </div>
                <div class="info">
                    <div class="country"><?php echo $dest['country']; ?></div>
                    <h4><?php echo $dest['city']; ?></h4>
                    <div class="rating">
                        <?php echo getStars($dest['rating']); ?>
                        <span>(<?php echo $dest['reviews']; ?> avis)</span>
                    </div>
                    <span class="price">A partir de <?php echo formatPrice($dest['price']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>