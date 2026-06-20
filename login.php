<?php
$page_title = 'Connexion - Wonderly';
$current_page = 'login';

require_once 'includes/functions.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        setFlash('error', 'Veuillez remplir tous les champs.');
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
            $stmt->execute(array($email));
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_email'] = $user['email'];
                
                setFlash('success', 'Bienvenue ' . $_SESSION['user_name'] . ' !');
                header('Location: index.php');
                exit();
            } else {
                setFlash('error', 'Email ou mot de passe incorrect.');
            }
        } catch(PDOException $e) {
            setFlash('error', 'Erreur de base de donnees.');
        }
    }
}

require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Connexion</h1>
        <p>Connectez-vous pour gerer vos reservations</p>
    </div>
</section>

<section class="container auth-section">
    <div class="auth-container" style="max-width: 500px; margin: 0 auto;">
        <div class="auth-card">
            <div class="auth-header">
                <h2><i class="fas fa-user-circle"></i> Bienvenue</h2>
            </div>
            <form method="POST" class="auth-form">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="votre@email.com" name="email" required />
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <div class="password-input">
                        <input type="password" placeholder="Votre mot de passe" name="password" required />
                        <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="auth-options">
                    <label style="font-size: 13px; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                        <input type="checkbox" name="remember" /> Se souvenir de moi
                    </label>
                    <a href="forgot-password.php" class="forgot-link">Mot de passe oublie ?</a>
                </div>
                <button type="submit" class="btn-primary btn-full">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </button>
            </form>
            <div class="auth-divider"><span>ou</span></div>
            <div class="social-login">
                <button type="button" class="btn-social btn-google"><i class="fab fa-google"></i> Google</button>
                <button type="button" class="btn-social btn-facebook"><i class="fab fa-facebook-f"></i> Facebook</button>
            </div>
            <div class="auth-footer">
                <p>Pas de compte ? <a href="register.php">Creer un compte</a></p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>