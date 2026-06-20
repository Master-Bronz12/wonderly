<?php
$page_title = 'Blog - Wonderly';
$page_description = 'Inspirations, conseils et histoires de voyage en Cote d\'Ivoire et ailleurs';
$current_page = 'blog';

require_once 'includes/functions.php';
require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Blog Voyage</h1>
        <p>Inspirations, conseils et histoires de voyage en Cote d'Ivoire et ailleurs</p>
    </div>
</section>

<section class="container">
    <div class="blog-grid">
        <div class="blog-card">
            <div class="blog-img" style="background-image:url('https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=500&q=80');">
                <span class="blog-category">Culture</span>
            </div>
            <div class="blog-info">
                <span class="blog-date">15 Juin 2026</span>
                <h3>Les tresors caches de Grand-Bassam</h3>
                <p>Decouvrez l'histoire fascinante de l'ancienne capitale coloniale de la Cote d'Ivoire.</p>
                <a href="#" class="blog-readmore">Lire la suite <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="blog-card">
            <div class="blog-img" style="background-image:url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=500&q=80');">
                <span class="blog-category">Aventure</span>
            </div>
            <div class="blog-info">
                <span class="blog-date">10 Juin 2026</span>
                <h3>Randonnee dans les montagnes de Man</h3>
                <p>Un guide complet pour explorer les magnifiques paysages de la region de Man.</p>
                <a href="#" class="blog-readmore">Lire la suite <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="blog-card">
            <div class="blog-img" style="background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=80');">
                <span class="blog-category">Plage</span>
            </div>
            <div class="blog-info">
                <span class="blog-date">5 Juin 2026</span>
                <h3>Les plus belles plages de San-Pedro</h3>
                <p>Partez a la decouverte des plages paradisiaques de San-Pedro.</p>
                <a href="#" class="blog-readmore">Lire la suite <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>