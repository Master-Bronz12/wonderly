<?php
// ============================================
// FONCTIONS PHP - WONDERLY
// ============================================

// Inclure la configuration pour avoir accès à $pdo
require_once __DIR__ . '/../config/database.php';

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function formatPrice($price) {
    return number_format($price, 0, ',', ' ') . ' FCFA';
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function generateBookingReference() {
    return 'WND-' . date('Y') . '-' . strtoupper(substr(uniqid(), -6));
}

function getUserData($userId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute(array($userId));
        return $stmt->fetch();
    } catch(PDOException $e) {
        return null;
    }
}

function getDestinations($limit = null, $category = null) {
    global $pdo;
    try {
        $sql = "SELECT * FROM destinations WHERE 1=1";
        $params = array();
        
        if ($category && $category !== 'all') {
            $sql .= " AND category = ?";
            $params[] = $category;
        }
        
        $sql .= " ORDER BY is_popular DESC, id DESC";
        
        if ($limit) {
            $sql .= " LIMIT ?";
            $params[] = $limit;
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return array();
    }
}

function getCircuits($limit = null) {
    global $pdo;
    try {
        $sql = "SELECT * FROM circuits WHERE is_active = TRUE ORDER BY id DESC";
        if ($limit) {
            $sql .= " LIMIT ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($limit));
        } else {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return array();
    }
}

function getHotels($limit = null) {
    global $pdo;
    try {
        $sql = "SELECT * FROM hotels WHERE is_active = TRUE ORDER BY stars DESC";
        if ($limit) {
            $sql .= " LIMIT ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($limit));
        } else {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return array();
    }
}

function getUserBookings($userId) {
    global $pdo;
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
            WHERE b.user_id = ?
            ORDER BY b.created_at DESC
        ");
        $stmt->execute(array($userId));
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return array();
    }
}

function createBooking($userId, $data) {
    global $pdo;
    
    try {
        $reference = generateBookingReference();
        
        $stmt = $pdo->prepare("
            INSERT INTO bookings (
                user_id, booking_type, item_id, booking_reference,
                travel_date, return_date, adults, children, total_price, status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
        ");
        
        $returnDate = isset($data['return_date']) ? $data['return_date'] : null;
        $adults = isset($data['adults']) ? $data['adults'] : 1;
        $children = isset($data['children']) ? $data['children'] : 0;
        
        $stmt->execute(array(
            $userId,
            $data['booking_type'],
            $data['item_id'],
            $reference,
            $data['travel_date'],
            $returnDate,
            $adults,
            $children,
            $data['total_price']
        ));
        
        return $pdo->lastInsertId();
    } catch(PDOException $e) {
        return false;
    }
}

function getStars($rating) {
    $full = floor($rating);
    $half = ($rating - $full) >= 0.5 ? 1 : 0;
    $empty = 5 - $full - $half;
    
    $html = '';
    for ($i = 0; $i < $full; $i++) {
        $html .= '★';
    }
    if ($half) {
        $html .= '★';
    }
    for ($i = 0; $i < $empty; $i++) {
        $html .= '☆';
    }
    return $html;
}

function subscribeNewsletter($email) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO newsletter (email) VALUES (?)");
        $stmt->execute(array($email));
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

function setFlash($type, $message) {
    $_SESSION['flash'] = array(
        'type' => $type,
        'message' => $message
    );
}

function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function getDbConnection() {
    global $pdo;
    return $pdo;
}
?>