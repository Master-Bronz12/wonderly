<section class="container newsletter">
    <div class="left">
        <span class="icon"><i class="fas fa-paper-plane"></i></span>
        <div>
            <h3>Abonnez-vous a Notre Newsletter</h3>
            <p>Recevez les meilleures offres et inspirations directement dans votre boite mail.</p>
        </div>
    </div>
    <div class="center">
        <form method="POST" action="index.php">
            <input type="email" name="newsletter_email" placeholder="Entrez votre email" required />
            <button type="submit" name="newsletter_submit" class="btn-sub">S'abonner</button>
        </form>
    </div>
    <div class="social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
    </div>
</section>

<div id="toast" class="toast"></div>

<footer>
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <span>Wonderly</span> – Agence de Voyage en Cote d'Ivoire</p>
        <p style="font-size: 12px; opacity: 0.7; margin-top: 4px;">
            Fait par <strong style="color: var(--primary);">MASTER BRONZ DIGITAL</strong> 
            | <a href="mailto:masterbronzdigital12@gmail.com" style="color: var(--text-muted); text-decoration: none;">masterbronzdigital12@gmail.com</a>
        </p>
    </div>
</footer>

<?php 
$flash = getFlash();
if ($flash): 
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    showToast('<?php echo addslashes($flash['message']); ?>', '<?php echo $flash['type']; ?>');
});
</script>
<?php endif; ?>

<script src="js/script.js"></script>
</body>
</html>