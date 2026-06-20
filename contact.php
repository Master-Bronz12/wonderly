<?php
$page_title = 'Contact - Wonderly';
$page_description = 'Contactez Wonderly, votre agence de voyage en Cote d\'Ivoire';
$current_page = 'contact';

require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = isset($_POST['subject']) ? filter_var($_POST['subject'], FILTER_SANITIZE_STRING) : '';
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute(array($name, $email, $subject, $message));
            setFlash('success', 'Message envoye ! Nous vous repondrons rapidement.');
            header('Location: contact.php');
            exit();
        } catch(PDOException $e) {
            setFlash('error', 'Erreur lors de l\'envoi du message.');
        }
    } else {
        setFlash('error', 'Veuillez remplir tous les champs obligatoires.');
    }
}

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Contactez-nous</h1>
        <p>Nous sommes la pour repondre a toutes vos questions</p>
    </div>
</section>

<section class="container contact-section">
    <div class="contact-grid">
        <div class="contact-info">
            <h2><i class="fas fa-info-circle"></i> Coordonnees</h2>
            
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h4>Adresse</h4>
                    <p>Abidjan, Cote d'Ivoire</p>
                </div>
            </div>
            
            <div class="contact-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <h4>Telephone</h4>
                    <p><a href="tel:+2250700000000">+225 07 00 00 00 00</a></p>
                </div>
            </div>
            
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h4>Email</h4>
                    <p><a href="mailto:contact@wonderly.ci">contact@wonderly.ci</a></p>
                </div>
            </div>
            
            <div class="contact-item">
                <i class="fas fa-clock"></i>
                <div>
                    <h4>Horaires d'ouverture</h4>
                    <p>
                        <strong>Lundi - Vendredi :</strong> 8h - 18h<br />
                        <strong>Samedi :</strong> 9h - 13h<br />
                        <strong>Dimanche :</strong> Ferme
                    </p>
                </div>
            </div>
            
            <div class="contact-social">
                <h4>Suivez-nous</h4>
                <div class="social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        
        <div class="contact-form">
            <h2><i class="fas fa-paper-plane"></i> Envoyez-nous un message</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Nom complet <span class="required">*</span></label>
                    <input type="text" placeholder="Votre nom et prenom" name="name" required />
                </div>
                
                <div class="form-group">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" placeholder="votre@email.com" name="email" required />
                </div>
                
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="tel" placeholder="Votre numero de telephone" name="phone" />
                </div>
                
                <div class="form-group">
                    <label>Sujet</label>
                    <select name="subject">
                        <option value="">-- Choisissez un sujet --</option>
                        <option value="renseignement">Renseignement sur un voyage</option>
                        <option value="reservation">Reservation</option>
                        <option value="devis">Demande de devis</option>
                        <option value="reclamation">Reclamation</option>
                        <option value="partenariat">Partenariat</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Message <span class="required">*</span></label>
                    <textarea rows="5" placeholder="Detaillez votre demande..." name="message" required></textarea>
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-paper-plane"></i> Envoyer le message
                </button>
            </form>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>