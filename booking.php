<?php
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    setFlash('error', 'Veuillez vous connecter pour reserver.');
    header('Location: login.php');
    exit();
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (empty($type) || !$id) {
    header('Location: destinations.php');
    exit();
}

$table = '';
switch ($type) {
    case 'circuit':
        $table = 'circuits';
        break;
    case 'flight':
        $table = 'flights';
        break;
    case 'hotel':
        $table = 'hotels';
        break;
    default:
        header('Location: destinations.php');
        exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE id = ? AND is_active = 1");
    $stmt->execute(array($id));
    $item = $stmt->fetch();

    if (!$item) {
        header('Location: destinations.php');
        exit();
    }

    $bookingData = array(
        'booking_type' => $type,
        'item_id' => $id,
        'travel_date' => date('Y-m-d', strtotime('+1 month')),
        'adults' => 2,
        'children' => 0,
        'total_price' => $item['price']
    );

    $bookingId = createBooking($_SESSION['user_id'], $bookingData);

    if ($bookingId) {
        setFlash('success', 'Reservation creee ! Procedez au paiement.');
        header('Location: payment.php?booking_id=' . $bookingId);
    } else {
        setFlash('error', 'Erreur lors de la reservation.');
        header('Location: ' . $type . 's.php');
    }
} catch(PDOException $e) {
    setFlash('error', 'Erreur de base de donnees.');
    header('Location: destinations.php');
}
exit();
?>