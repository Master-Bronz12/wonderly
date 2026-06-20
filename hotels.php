<?php
$page_title = 'Hotels - Wonderly';
$page_description = 'Decouvrez les meilleurs hotels en Cote d\'Ivoire et a l\'international';
$current_page = 'hotels';

require_once 'includes/functions.php';
$hotels = getHotels();

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Nos Hotels</h1>
        <p>Decouvrez les meilleurs hotels en Cote d'Ivoire et a l'international</p>
    </div>
</section>

<section class="container">
    <div class="search-card hotel-search">
        <form class="search-form" method="GET">
            <div class="field">
                <label>Destination</label>
                <div class="input-wrap">
                    <i class="fas fa-map-pin"></i>
                    <input type="text" placeholder="Ville ou region" name="destination" />
                </div>
            </div>
            <div class="field">
                <label>Arrivee</label>
                <div class="input-wrap">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="checkin" />
                </div>
            </div>
            <div class="field">
                <label>Depart</label>
                <div class="input-wrap">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="checkout" />
                </div>
            </div>
            <div class="field">
                <label>Voyageurs</label>
                <div class="input-wrap">
                    <i class="fas fa-user"></i>
                    <select name="travelers">
                        <option value="1">1 Adulte</option>
                        <option value="2" selected>2 Adultes</option>
                        <option value="2,1">2 Adultes, 1 Enfant</option>
                        <option value="3,1">3 Adultes, 1 Enfant</option>
                        <option value="4,2">4 Adultes, 2 Enfants</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-search"><i class="fas fa-search"></i> Rechercher</button>
        </form>
    </div>
</section>

<section class="container">
    <div class="section-header">
        <h2>Hotels Recommandes <i class="fas fa-hotel"></i></h2>
    </div>
    <div class="hotels-grid">
        <?php if (empty($hotels)): ?>
            <p style="grid-column: 1/-1; text-align: center; padding: 40px;">Aucun hotel disponible.</p>
        <?php else: ?>
            <?php foreach ($hotels as $hotel): ?>
            <div class="hotel-card">
                <div class="hotel-img" style="background-image:url('<?php echo $hotel['image']; ?>');">
                    <span class="hotel-stars"><?php echo str_repeat('★', $hotel['stars']); ?></span>
                </div>
                <div class="hotel-info">
                    <h3><?php echo $hotel['name']; ?></h3>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> <?php echo $hotel['location']; ?></p>
                    <p class="hotel-desc"><?php echo $hotel['description']; ?></p>
                    <div class="hotel-footer">
                        <span class="hotel-price">A partir de <?php echo formatPrice($hotel['price_per_night']); ?>/nuit</span>
                        <?php if (isLoggedIn()): ?>
                        <a href="booking.php?type=hotel&id=<?php echo $hotel['id']; ?>" class="btn-reserver">Reserver</a>
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