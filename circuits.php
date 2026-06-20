<?php
$page_title = 'Nos Circuits - Wonderly';
$page_description = 'Decouvrez nos circuits touristiques en Cote d\'Ivoire et a l\'international';
$current_page = 'circuits';

require_once 'includes/functions.php';

$circuits = getCircuits();

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Nos Circuits Touristiques</h1>
        <p>Des experiences uniques pour decouvrir la Cote d'Ivoire et l'Afrique</p>
    </div>
</section>

<section class="container">
    <div class="circuits-grid">
        <?php if (empty($circuits)): ?>
            <p style="grid-column: 1/-1; text-align: center; padding: 40px;">Aucun circuit disponible.</p>
        <?php else: ?>
            <?php foreach ($circuits as $circuit): ?>
            <div class="circuit-card">
                <div class="circuit-img" style="background-image:url('<?php echo $circuit['image']; ?>');">
                    <span class="circuit-duration"><?php echo $circuit['duration']; ?> jours</span>
                </div>
                <div class="circuit-info">
                    <h3><?php echo $circuit['title']; ?></h3>
                    <p class="circuit-location"><i class="fas fa-map-marker-alt"></i> <?php echo $circuit['location']; ?></p>
                    <p class="circuit-desc"><?php echo $circuit['description']; ?></p>
                    <div class="circuit-features">
                        <?php 
                        $features = explode(', ', $circuit['features']);
                        foreach ($features as $feature): 
                        ?>
                        <span><i class="fas fa-check-circle"></i> <?php echo $feature; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="circuit-footer">
                        <span class="circuit-price">A partir de <?php echo formatPrice($circuit['price']); ?></span>
                        <?php if (isLoggedIn()): ?>
                        <a href="booking.php?type=circuit&id=<?php echo $circuit['id']; ?>" class="btn-reserver">Reserver</a>
                        <?php else: ?>
                        <a href="login.php" class="btn-reserver">Connectez-vous</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>