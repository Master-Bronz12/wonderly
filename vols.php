<?php
$page_title = 'Vols - Wonderly';
$page_description = 'Reservez vos vols au depart de la Cote d\'Ivoire';
$current_page = 'vols';

require_once 'includes/functions.php';
require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Reservez vos Vols</h1>
        <p>Comparez et reservez les meilleurs vols au depart de la Cote d'Ivoire</p>
    </div>
</section>

<section class="container">
    <div class="search-card">
        <form class="search-form" method="GET">
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
                    <i class="fas fa-plane-arrival"></i>
                    <input type="text" placeholder="Ou allez-vous ?" name="to" />
                </div>
            </div>
            <div class="field">
                <label>Depart</label>
                <div class="input-wrap">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="depart" />
                </div>
            </div>
            <div class="field">
                <label>Retour</label>
                <div class="input-wrap">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="return" />
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

<section class="container">
    <div class="section-header">
        <h2>Vols Populaires <i class="fas fa-plane"></i></h2>
    </div>
    <div class="flights-list">
        <div class="flight-card">
            <div class="flight-route">
                <span class="flight-from">Abidjan (ABJ)</span>
                <span class="flight-arrow"><i class="fas fa-arrow-right"></i></span>
                <span class="flight-to">Paris (CDG)</span>
            </div>
            <div class="flight-info">
                <span class="flight-airline"><i class="fas fa-plane"></i> Air France</span>
                <span class="flight-duration">6h30</span>
                <span class="flight-price">A partir de 550 000 FCFA</span>
                <a href="#" class="btn-reserver-vol">Reserver</a>
            </div>
        </div>

        <div class="flight-card">
            <div class="flight-route">
                <span class="flight-from">Abidjan (ABJ)</span>
                <span class="flight-arrow"><i class="fas fa-arrow-right"></i></span>
                <span class="flight-to">Dakar (DSS)</span>
            </div>
            <div class="flight-info">
                <span class="flight-airline"><i class="fas fa-plane"></i> Air Senegal</span>
                <span class="flight-duration">3h15</span>
                <span class="flight-price">A partir de 180 000 FCFA</span>
                <a href="#" class="btn-reserver-vol">Reserver</a>
            </div>
        </div>

        <div class="flight-card">
            <div class="flight-route">
                <span class="flight-from">Abidjan (ABJ)</span>
                <span class="flight-arrow"><i class="fas fa-arrow-right"></i></span>
                <span class="flight-to">Dubai (DXB)</span>
            </div>
            <div class="flight-info">
                <span class="flight-airline"><i class="fas fa-plane"></i> Emirates</span>
                <span class="flight-duration">8h45</span>
                <span class="flight-price">A partir de 650 000 FCFA</span>
                <a href="#" class="btn-reserver-vol">Reserver</a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>