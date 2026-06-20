<?php
$page_title = 'Confirmation - Wonderly';
$page_description = 'Votre reservation a ete confirmee';
$current_page = 'confirmation';

require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$bookingId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$bookingId) {
    header('Location: destinations.php');
    exit();
}

try {
    $stmt = $pdo->prepare("
        SELECT b.*, 
               CASE 
                   WHEN b.booking_type = 'circuit' THEN c.title
                   WHEN b.booking_type = 'flight' THEN CONCAT(f.departure_city, ' -> ', f.arrival_city)
                   WHEN b.booking_type = 'hotel' THEN h.name
                   ELSE 'Forfait'
               END as item_name
        FROM bookings b
        LEFT JOIN circuits c ON b.booking_type = 'circuit' AND b.item_id = c.id
        LEFT JOIN flights f ON b.booking_type = 'flight' AND b.item_id = f.id
        LEFT JOIN hotels h ON b.booking_type = 'hotel' AND b.item_id = h.id
        WHERE b.id = ? AND b.user_id = ?
    ");
    $stmt->execute(array($bookingId, $_SESSION['user_id']));
    $booking = $stmt->fetch();

    if (!$booking) {
        header('Location: destinations.php');
        exit();
    }
} catch(PDOException $e) {
    setFlash('error', 'Erreur de base de donnees.');
    header('Location: destinations.php');
    exit();
}

require_once 'includes/header.php';
?>

<section class="container confirmation-section">
    <div class="confirmation-card">
        <div class="confirmation-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1>Reservation confirmee !</h1>
        <p class="confirmation-sub">Votre voyage est maintenant reserve. Preparez-vous a vivre une experience inoubliable.</p>
        
        <div class="confirmation-details">
            <div class="detail-item">
                <span class="detail-label">Numero de reservation</span>
                <span class="detail-value"><?php echo $booking['booking_reference']; ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Destination</span>
                <span class="detail-value"><?php echo $booking['item_name']; ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Date</span>
                <span class="detail-value"><?php echo date('d M Y', strtotime($booking['travel_date'])); ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Voyageurs</span>
                <span class="detail-value"><?php echo $booking['adults']; ?> Adultes<?php echo $booking['children'] > 0 ? ', ' . $booking['children'] . ' Enfants' : ''; ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Montant paye</span>
                <span class="detail-value" style="color: var(--primary); font-weight: 700; font-size: 18px;"><?php echo formatPrice($booking['total_price']); ?></span>
            </div>
        </div>
        
        <div class="confirmation-actions">
            <a href="my-bookings.php" class="btn-primary">
                <i class="fas fa-list"></i> Voir mes reservations
            </a>
            <a href="index.php" class="btn-outline" style="border-color: var(--primary); color: var(--primary);">
                <i class="fas fa-home"></i> Retour a l'accueil
            </a>
        </div>
        
        <div class="confirmation-info">
            <div class="info-box">
                <i class="fas fa-envelope"></i>
                <div>
                    <h4>Un email de confirmation vous a ete envoye</h4>
                    <p>Verifiez votre boite mail et vos spams.</p>
                </div>
            </div>
            <div class="info-box">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <h4>Besoin d'aide ?</h4>
                    <p>Contactez-nous au <strong>+225 07 00 00 00 00</strong></p>
                </div>
            </div>
        </div>
        
        <div class="confirmation-share">
            <p>Partagez votre excitation !</p>
            <div class="share-buttons">
                <a href="#" class="share-btn" style="background: #1877f2;"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="share-btn" style="background: #1da1f2;"><i class="fab fa-twitter"></i></a>
                <a href="#" class="share-btn" style="background: #e4405f;"><i class="fab fa-instagram"></i></a>
                <a href="#" class="share-btn" style="background: #25d366;"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>