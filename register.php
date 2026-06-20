<?php
$page_title = 'Inscription - Wonderly';
$current_page = 'register';

require_once 'includes/functions.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    
    $errors = array();
    
    if (empty($firstName) || empty($lastName)) {
        $errors[] = 'Nom et prenom requis.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email valide requis.';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Le mot de passe doit contenir au moins 8 caracteres.';
    }
    if ($password !== $passwordConfirm) {
        $errors[] = 'Les mots de passe ne correspondent pas.';
    }
    
    try {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute(array($email));
        if ($stmt->fetch()) {
            $errors[] = 'Cet email est deja utilise.';
        }
    } catch(PDOException $e) {
        $errors[] = 'Erreur de base de donnees.';
    }
    
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, phone) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute(array($firstName, $lastName, $email, $hashedPassword, $phone))) {
                setFlash('success', 'Compte cree avec succes !');
                header('Location: login.php');
                exit();
            }
        } catch(PDOException $e) {
            $errors[] = 'Erreur lors de la creation du compte.';
        }
    }
    
    if (!empty($errors)) {
        setFlash('error', implode('<br>', $errors));
    }
}

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Creer un compte</h1>
        <p>Rejoignez Wonderly et partez a l'aventure</p>
    </div>
</section>

<section class="container auth-section">
    <div class="auth-container" style="max-width: 550px; margin: 0 auto;">
        <div class="auth-card">
            <div class="auth-header">
                <h2><i class="fas fa-user-plus"></i> Inscription</h2>
            </div>
            <form method="POST" class="auth-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom <span class="required">*</span></label>
                        <input type="text" placeholder="Votre nom" name="last_name" required />
                    </div>
                    <div class="form-group">
                        <label>Prenom <span class="required">*</span></label>
                        <input type="text" placeholder="Votre prenom" name="first_name" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" placeholder="votre@email.com" name="email" required />
                </div>
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="tel" placeholder="+225 00 00 00 00" name="phone" />
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="required">*</span></label>
                    <div class="password-input">
                        <input type="password" placeholder="Min 8 caracteres" name="password" required />
                        <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirmer <span class="required">*</span></label>
                    <div class="password-input">
                        <input type="password" placeholder="Confirmez" name="password_confirm" required />
                        <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label style="font-size: 13px; font-weight: 400; display: flex; align-items: flex-start; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="terms" required style="margin-top: 3px;" /> 
                        J'accepte les <a href="legal.php" style="color: var(--primary);">Conditions Generales</a>
                    </label>
                </div>
                <button type="submit" class="btn-primary btn-full">
                    <i class="fas fa-user-plus"></i> Creer mon compte
                </button>
            </form>
            <div class="auth-divider"><span>ou</span></div>
            <div class="social-login">
                <button type="button" class="btn-social btn-google"><i class="fab fa-google"></i> Google</button>
                <button type="button" class="btn-social btn-facebook"><i class="fab fa-facebook-f"></i> Facebook</button>
            </div>
            <div class="auth-footer">
                <p>Deja un compte ? <a href="login.php">Se connecter</a></p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>