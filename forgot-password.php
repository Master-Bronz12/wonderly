<?php
$page_title = 'Mot de passe oublie - Wonderly';
$page_description = 'Reinitialisez votre mot de passe';
$current_page = 'forgot-password';

require_once 'includes/functions.php';
require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Mot de passe oublie</h1>
        <p>Nous vous aiderons a le reinitialiser</p>
    </div>
</section>

<section class="container auth-section">
    <div class="auth-container" style="max-width: 500px; margin: 0 auto;">
        <div class="auth-card">
            <div class="auth-header">
                <h2><i class="fas fa-key"></i> Reinitialisation</h2>
                <p>Entrez votre email pour recevoir un lien de reinitialisation</p>
            </div>
            
            <form method="POST" class="auth-form">
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" placeholder="votre@email.com" name="email" required />
                </div>
                
                <button type="submit" class="btn-primary btn-full">
                    <i class="fas fa-paper-plane"></i> Envoyer le lien
                </button>
            </form>
            
            <div class="auth-footer">
                <p><a href="login.php"><i class="fas fa-arrow-left"></i> Retour a la connexion</a></p>
            </div>
        </div>
        
        <div class="auth-benefits" style="max-width: 500px; margin: 0 auto;">
            <h3>Besoin d'aide ?</h3>
            <ul>
                <li><i class="fas fa-phone"></i> Contactez-nous au <strong>+225 07 00 00 00 00</strong></li>
                <li><i class="fas fa-envelope"></i> Ecrivez-nous a <strong>support@wonderly.ci</strong></li>
                <li><i class="fas fa-clock"></i> Disponible 24h/24 7j/7</li>
            </ul>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>