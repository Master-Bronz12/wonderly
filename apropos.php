<?php
$page_title = 'A Propos - Wonderly';
$page_description = 'Wonderly est une agence de voyage ivoirienne dediee a l\'excellence';
$current_page = 'apropos';

require_once 'includes/functions.php';
require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>A Propos de Wonderly</h1>
        <p>Votre agence de voyage ivoirienne dediee a l'excellence</p>
    </div>
</section>

<section class="container about-content">
    <div class="about-grid">
        <div class="about-text">
            <h2>Qui sommes-nous ?</h2>
            <p><strong>Wonderly</strong> est une agence de voyage ivoirienne creee pour vous faire decouvrir les merveilles de la Cote d'Ivoire et du monde entier.</p>
            <p>Notre equipe passionnee met tout en oeuvre pour vous offrir des experiences de voyage uniques, alliant qualite, securite et prix competitifs.</p>
            <p>Nous croyons que chaque voyage est une histoire a ecrire, et nous sommes la pour vous aider a ecrire la votre.</p>
            
            <div class="about-values">
                <div class="value-item">
                    <i class="fas fa-heart"></i>
                    <h4>Passion</h4>
                    <p>Nous aimons ce que nous faisons et cela se ressent.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-handshake"></i>
                    <h4>Confiance</h4>
                    <p>Nous construisons des relations durables avec nos clients.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-star"></i>
                    <h4>Excellence</h4>
                    <p>Nous visons toujours l'excellence dans nos services.</p>
                </div>
            </div>
        </div>
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=600&q=80" alt="Cote d'Ivoire" />
        </div>
    </div>
</section>

<section class="container stats-section">
    <div class="stats-grid">
        <div class="stat-item">
            <span class="stat-number">500+</span>
            <span class="stat-label">Voyages organises</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">98%</span>
            <span class="stat-label">Clients satisfaits</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">15+</span>
            <span class="stat-label">Pays visites</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">50+</span>
            <span class="stat-label">Partenaires hoteliers</span>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>