<?php
// Ne pas inclure database.php ici car il est déjà inclus dans functions.php
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
    <title>Wonderly – <?php echo isset($page_title) ? $page_title : 'Voyagez avec nous en Cote d\'Ivoire'; ?></title>
    
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Wonderly - Agence de voyage ivoirienne.'; ?>" />
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Kalam:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<header>
    <div class="container header-inner">
        <a href="index.php" class="logo">
            <span class="logo-icon"><i class="fas fa-paper-plane"></i></span>
            <span class="logo-text">
                Wonderly
                <small>VOYAGEZ AVEC NOUS</small>
            </span>
        </a>
        <nav id="mainNav">
            <a href="index.php" <?php echo (isset($current_page) && $current_page === 'accueil') ? 'class="active"' : ''; ?>>Accueil</a>
            <a href="destinations.php" <?php echo (isset($current_page) && $current_page === 'destinations') ? 'class="active"' : ''; ?>>Destinations</a>
            <a href="circuits.php" <?php echo (isset($current_page) && $current_page === 'circuits') ? 'class="active"' : ''; ?>>Circuits</a>
            <a href="vols.php" <?php echo (isset($current_page) && $current_page === 'vols') ? 'class="active"' : ''; ?>>Vols</a>
            <a href="hotels.php" <?php echo (isset($current_page) && $current_page === 'hotels') ? 'class="active"' : ''; ?>>Hotels</a>
            <a href="blog.php" <?php echo (isset($current_page) && $current_page === 'blog') ? 'class="active"' : ''; ?>>Blog</a>
            <a href="apropos.php" <?php echo (isset($current_page) && $current_page === 'apropos') ? 'class="active"' : ''; ?>>A Propos</a>
        </nav>
        <div class="header-contact">
            <div class="phone">
                <span class="icon-circle"><i class="fas fa-phone-alt"></i></span>
                <span class="text">
                    Besoin d'aide ?
                    <strong>+225 07 00 00 00 00</strong>
                </span>
            </div>
            <?php if (isLoggedIn()): ?>
                <a href="my-bookings.php" class="user-icon"><i class="fas fa-ticket-alt"></i></a>
                <a href="logout.php" class="user-icon"><i class="fas fa-sign-out-alt"></i></a>
            <?php else: ?>
                <a href="login.php" class="user-icon"><i class="fas fa-user"></i></a>
            <?php endif; ?>
        </div>
        <button class="menu-toggle" id="menuToggle" aria-label="Menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>