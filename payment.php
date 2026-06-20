<?php
$page_title = 'Paiement - Wonderly';
$page_description = 'Effectuez votre paiement securise';
$current_page = 'payment';

require_once 'includes/functions.php';

if (!isLoggedIn()) {
    setFlash('error', 'Veuillez vous connecter pour effectuer un paiement.');
    header('Location: login.php');
    exit();
}

$bookingId = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'card';
    
    try {
        $stmt = $pdo->prepare("UPDATE bookings SET status = 'confirmed', payment_status = 'paid' WHERE id = ?");
        $stmt->execute(array($bookingId));
        
        $stmt = $pdo->prepare("INSERT INTO payments (booking_id, amount, payment_method, status, payment_date) VALUES (?, ?, ?, 'completed', NOW())");
        $stmt->execute(array($bookingId, $booking['total_price'], $paymentMethod));
        
        setFlash('success', 'Paiement effectue avec succes !');
        header('Location: confirmation.php?id=' . $bookingId);
        exit();
    } catch(PDOException $e) {
        setFlash('error', 'Erreur lors du paiement.');
    }
}

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Paiement securise</h1>
        <p>Finalisez votre reservation en toute securite</p>
    </div>
</section>

<section class="container payment-section">
    <div class="payment-grid">
        <!-- Recapitulatif -->
        <div class="payment-summary">
            <h3><i class="fas fa-receipt"></i> Recapitulatif</h3>
            
            <div class="summary-item">
                <span class="summary-label">Destination</span>
                <span class="summary-value"><?php echo $booking['item_name']; ?></span>
            </div>
            
            <div class="summary-item">
                <span class="summary-label">Date</span>
                <span class="summary-value"><?php echo date('d M Y', strtotime($booking['travel_date'])); ?></span>
            </div>
            
            <div class="summary-item">
                <span class="summary-label">Voyageurs</span>
                <span class="summary-value"><?php echo $booking['adults']; ?> Adultes<?php echo $booking['children'] > 0 ? ', ' . $booking['children'] . ' Enfants' : ''; ?></span>
            </div>
            
            <div class="summary-divider"></div>
            
            <div class="summary-total">
                <span class="total-label">Total a payer</span>
                <span class="total-amount"><?php echo formatPrice($booking['total_price']); ?></span>
            </div>
            
            <div class="summary-secure">
                <i class="fas fa-lock"></i> Paiement 100% securise
            </div>
        </div>
        
        <!-- Formulaire de paiement -->
        <div class="payment-form">
            <h3><i class="fas fa-credit-card"></i> Moyen de paiement</h3>
            
            <form method="POST">
                <div class="payment-methods">
                    <button type="button" class="payment-method active" data-method="card">
                        <i class="fas fa-credit-card"></i> Carte
                    </button>
                    <button type="button" class="payment-method" data-method="orange_money">
                        <i class="fas fa-mobile-alt"></i> Orange
                    </button>
                    <button type="button" class="payment-method" data-method="mtn_money">
                        <i class="fas fa-mobile-alt"></i> MTN
                    </button>
                    <button type="button" class="payment-method" data-method="wave">
                        <i class="fas fa-bolt"></i> Wave
                    </button>
                </div>
                
                <input type="hidden" name="payment_method" id="paymentMethod" value="card" />
                
                <div class="payment-content" id="payment-card">
                    <div class="form-group">
                        <label>Numero de carte</label>
                        <div class="input-wrap">
                            <i class="fas fa-credit-card"></i>
                            <input type="text" placeholder="1234 5678 9012 3456" maxlength="19" />
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group half">
                            <label>Date d'expiration</label>
                            <div class="input-wrap">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="text" placeholder="MM/AA" maxlength="5" />
                            </div>
                        </div>
                        <div class="form-group half">
                            <label>CVV</label>
                            <div class="input-wrap">
                                <i class="fas fa-lock"></i>
                                <input type="text" placeholder="123" maxlength="4" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Titulaire</label>
                        <input type="text" placeholder="Nom du titulaire" />
                    </div>
                </div>
                
                <div class="payment-content" id="payment-orange" style="display:none;">
                    <div class="form-group">
                        <label>Numero Orange Money</label>
                        <div class="input-wrap">
                            <i class="fas fa-phone"></i>
                            <input type="tel" placeholder="01 00 00 00 00" />
                        </div>
                    </div>
                    <div class="payment-info">
                        <i class="fas fa-info-circle"></i>
                        Vous recevrez une demande de paiement sur votre telephone.
                    </div>
                </div>
                
                <div class="payment-content" id="payment-mtn" style="display:none;">
                    <div class="form-group">
                        <label>Numero MTN Mobile Money</label>
                        <div class="input-wrap">
                            <i class="fas fa-phone"></i>
                            <input type="tel" placeholder="01 00 00 00 00" />
                        </div>
                    </div>
                    <div class="payment-info">
                        <i class="fas fa-info-circle"></i>
                        Vous recevrez une demande de paiement sur votre telephone.
                    </div>
                </div>
                
                <div class="payment-content" id="payment-wave" style="display:none;">
                    <div class="form-group">
                        <label>Numero Wave</label>
                        <div class="input-wrap">
                            <i class="fas fa-phone"></i>
                            <input type="tel" placeholder="01 00 00 00 00" />
                        </div>
                    </div>
                    <div class="payment-info">
                        <i class="fas fa-info-circle"></i>
                        Scannez le QR code ou entrez votre numero.
                    </div>
                </div>
                
                <button type="submit" class="btn-primary btn-full btn-payment">
                    <i class="fas fa-check-circle"></i> Payer <?php echo formatPrice($booking['total_price']); ?>
                </button>
            </form>
            
            <div class="payment-security">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <h4>Paiement securise</h4>
                    <p>Vos donnees sont cryptees et ne sont jamais stockees.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.payment-method').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.payment-method').forEach(function(b) {
            b.classList.remove('active');
        });
        this.classList.add('active');
        
        var method = this.dataset.method;
        document.getElementById('paymentMethod').value = method;
        
        document.querySelectorAll('.payment-content').forEach(function(el) {
            el.style.display = 'none';
        });
        var target = document.getElementById('payment-' + method);
        if (target) target.style.display = 'block';
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>