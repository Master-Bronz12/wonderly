<?php
$page_title = 'Mes Reservations - Wonderly';
$page_description = 'Consultez et gerez toutes vos reservations';
$current_page = 'my-bookings';

require_once 'includes/functions.php';

if (!isLoggedIn()) {
    setFlash('error', 'Veuillez vous connecter pour voir vos reservations.');
    header('Location: login.php');
    exit();
}

$bookings = getUserBookings($_SESSION['user_id']);

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Mes Reservations</h1>
        <p>Gerez toutes vos reservations en un seul endroit</p>
    </div>
</section>

<section class="container bookings-section">
    <?php if (empty($bookings)): ?>
        <div class="bookings-empty">
            <i class="fas fa-suitcase"></i>
            <h3>Aucune reservation</h3>
            <p>Vous n'avez pas encore de reservation. <a href="destinations.php">Decouvrez nos destinations</a></p>
        </div>
    <?php else: ?>
        <div class="bookings-list">
            <?php foreach ($bookings as $booking): 
                $statusClass = '';
                $statusLabel = '';
                switch ($booking['status']) {
                    case 'pending': $statusClass = 'status-upcoming'; $statusLabel = 'En attente'; break;
                    case 'confirmed': $statusClass = 'status-upcoming'; $statusLabel = 'Confirmee'; break;
                    case 'completed': $statusClass = 'status-completed'; $statusLabel = 'Terminee'; break;
                    case 'cancelled': $statusClass = 'status-cancelled'; $statusLabel = 'Annulee'; break;
                }
            ?>
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-info">
                        <span class="booking-status <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span>
                        <h3><?php echo $booking['item_name']; ?></h3>
                        <p class="booking-reference">Ref : <?php echo $booking['booking_reference']; ?></p>
                    </div>
                    <span class="booking-price"><?php echo formatPrice($booking['total_price']); ?></span>
                </div>
                <div class="booking-details">
                    <div class="booking-detail">
                        <i class="fas fa-calendar-alt"></i>
                        <span><?php echo date('d M Y', strtotime($booking['travel_date'])); ?></span>
                    </div>
                    <div class="booking-detail">
                        <i class="fas fa-user"></i>
                        <span><?php echo $booking['adults']; ?> Adultes<?php echo $booking['children'] > 0 ? ', ' . $booking['children'] . ' Enfants' : ''; ?></span>
                    </div>
                    <div class="booking-detail">
                        <i class="fas fa-tag"></i>
                        <span><?php echo ucfirst($booking['booking_type']); ?></span>
                    </div>
                </div>
                <div class="booking-actions">
                    <a href="confirmation.php?id=<?php echo $booking['id']; ?>" class="btn-primary" style="padding: 8px 20px; font-size: 13px;">
                        <i class="fas fa-eye"></i> Details
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once 'includes/footer.php'; ?>