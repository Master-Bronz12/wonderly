<?php
$page_title = 'Accueil - Voyagez avec nous en Cote d\'Ivoire';
$page_description = 'Wonderly - Agence de voyage ivoirienne.';
$current_page = 'accueil';

require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_submit'])) {
    $email = filter_var($_POST['newsletter_email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (subscribeNewsletter($email)) {
            setFlash('success', 'Merci ! Vous etes inscrit a notre newsletter.');
        } else {
            setFlash('error', 'Cet email est deja inscrit.');
        }
    } else {
        setFlash('error', 'Email invalide.');
    }
    header('Location: index.php');
    exit();
}

$destinations = getDestinations(4);
$circuits = getCircuits(3);

require_once 'includes/header.php';
?>

<section class="container hero" id="hero">
    <div class="hero-content">
        <span class="hero-badge"><i class="fas fa-plane"></i> EXPLOREZ. REVEZ. DECOUVREZ.</span>
        <h1>
            Decouvrez des<br />
            <span class="handwritten">Merveilles avec Nous</span>
        </h1>
        <p>Des circuits, hotels et vols exceptionnels pour des voyages inoubliables.</p>
        <a href="destinations.php" class="btn-primary">Explorer maintenant <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<section class="container search-section">
    <div class="search-card">
        <div class="search-tabs" id="searchTabs">
            <span class="active"><i class="fas fa-plane"></i> Vols</span>
            <span><i class="fas fa-hotel"></i> Hotels</span>
            <span><i class="fas fa-suitcase"></i> Circuits</span>
            <span><i class="fas fa-gift"></i> Forfaits</span>
        </div>
        <form class="search-form" method="GET" action="vols.php">
            <div class="field">
                <label>Depart</label>
                <div class="input-wrap">
                    <i class="fas fa-plane-departure"></i>
                    <input type="text" value="Abidjan (ABJ)" name="from" />
                </div>
            </div>
            <div class="field">
                <label>Destination</label>
                <div class="input-wrap">
                    <i class="fas fa-map-pin"></i>
                    <input type="text" placeholder="Ou allez-vous ?" name="to" />
                </div>
            </div>
            <div class="field">
                <label>Depart</label>
                <div class="input-wrap">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" value="<?php echo date('Y-m-d', strtotime('+1 month')); ?>" name="depart" />
                </div>
            </div>
            <div class="field">
                <label>Retour</label>
                <div class="input-wrap">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" value="<?php echo date('Y-m-d', strtotime('+1 month +1 week')); ?>" name="return" />
                </div>
            </div>
            <div class="field">
                <label>Voyageurs</label>
                <div class="input-wrap">
                    <i class="fas fa-user"></i>
                    <select name="travelers">
                        <option value="1">1 Adulte</option>
                        <option value="2">2 Adultes</option>
                        <option value="2,1" selected>2 Adultes, 1 Enfant</option>
                        <option value="3,1">3 Adultes, 1 Enfant</option>
                        <option value="4,2">4 Adultes, 2 Enfants</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-search"><i class="fas fa-search"></i> Rechercher</button>
        </form>
    </div>
</section>

<section class="container advantages">
    <div class="advantage-item">
        <span class="icon"><i class="fas fa-gem"></i></span>
        <div class="text">
            <h4>Meilleur Prix Garanti</h4>
            <p>Nous vous offrons les meilleurs tarifs toujours.</p>
        </div>
    </div>
    <div class="advantage-item">
        <span class="icon"><i class="fas fa-headset"></i></span>
        <div class="text">
            <h4>Support 24h/24 7j/7</h4>
            <p>Nous sommes la pour vous aider a tout moment.</p>
        </div>
    </div>
    <div class="advantage-item">
        <span class="icon"><i class="fas fa-shield-alt"></i></span>
        <div class="text">
            <h4>Reservations Securisees</h4>
            <p>Vos donnees et paiements sont 100% securises.</p>
        </div>
    </div>
    <div class="advantage-item">
        <span class="icon"><i class="fas fa-medal"></i></span>
        <div class="text">
            <h4>Experiences Selectionnees</h4>
            <p>Des circuits et hotels choisis avec soin.</p>
        </div>
    </div>
</section>

<section class="container">
    <div class="section-header">
        <h2>Destinations Populaires <i class="fas fa-paper-plane"></i></h2>
        <a href="destinations.php" class="view-all">Voir tout <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="destinations-grid">
        <?php if (empty($destinations)): ?>
            <p style="grid-column: 1/-1; text-align: center; padding: 40px;">Aucune destination disponible.</p>
        <?php else: ?>
            <?php foreach ($destinations as $dest): ?>
            <div class="dest-card" onclick="window.location.href='destinations.php?id=<?php echo $dest['id']; ?>'">
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

<section class="container why-section">
    <div class="section-header">
        <h2>Pourquoi Choisir <span class="handwritten">Wonderly</span> ?</h2>
    </div>
    <div class="why-grid">
        <div class="why-item">
            <div class="icon"><i class="fas fa-globe-americas"></i></div>
            <h4>Large Choix</h4>
            <p>Des milliers de vols, hotels et circuits a travers le monde.</p>
        </div>
        <div class="why-item">
            <div class="icon"><i class="fas fa-thumbs-up"></i></div>
            <h4>Approuve par les Voyageurs</h4>
            <p>Rejoignez des milliers de voyageurs satisfaits.</p>
        </div>
        <div class="why-item">
            <div class="icon"><i class="fas fa-credit-card"></i></div>
            <h4>Reservation Flexible</h4>
            <p>Reservez facilement et modifiez vos plans si besoin.</p>
        </div>
        <div class="why-item">
            <div class="icon"><i class="fas fa-award"></i></div>
            <h4>Offres Exclusives</h4>
            <p>Accedez a des reductions et offres speciales.</p>
        </div>
    </div>
</section>

<section class="container promo-banner">
    <div class="content">
        <h2>EN ROUTE !<br /><span>Votre Prochaine Aventure Vous Attend !</span></h2>
        <p>Decouvrez des lieux magnifiques et creez des souvenirs inoubliables.</p>
        <a href="circuits.php" class="btn-outline">Planifier mon voyage <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>