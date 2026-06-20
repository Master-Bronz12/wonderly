<?php
$page_title = 'FAQ - Wonderly';
$page_description = 'Toutes les reponses a vos questions sur Wonderly';
$current_page = 'faq';

require_once 'includes/functions.php';
require_once 'includes/header.php';
?>

<section class="container page-header">
    <div class="page-header-content">
        <h1>Questions Frequentes</h1>
        <p>Toutes les reponses a vos questions sur Wonderly</p>
    </div>
</section>

<section class="container faq-section">
    <div class="faq-list">
        <div class="faq-item">
            <button class="faq-question">
                <span>Comment puis-je reserver un voyage avec Wonderly ?</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Pour reserver un voyage avec Wonderly, suivez ces etapes simples :</p>
                <ol>
                    <li>Creez un compte ou connectez-vous</li>
                    <li>Choisissez votre destination</li>
                    <li>Selectionnez les dates et le nombre de voyageurs</li>
                    <li>Choisissez votre hebergement et vos activites</li>
                    <li>Effectuez le paiement en ligne securise</li>
                </ol>
                <p>Vous recevrez une confirmation par email dans les minutes qui suivent.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <button class="faq-question">
                <span>Quels moyens de paiement acceptez-vous ?</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Nous acceptons plusieurs moyens de paiement pour votre confort :</p>
                <ul>
                    <li><strong>Cartes bancaires :</strong> Visa, Mastercard, American Express</li>
                    <li><strong>Mobile Money :</strong> Orange Money, MTN Mobile Money</li>
                    <li><strong>Wave :</strong> Paiement via l'application Wave</li>
                </ul>
                <p>Tous les paiements sont securises et cryptes.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <button class="faq-question">
                <span>Puis-je modifier ma reservation apres validation ?</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Oui, vous pouvez modifier votre reservation sous certaines conditions :</p>
                <ul>
                    <li>Jusqu'a 7 jours avant le depart : modification gratuite</li>
                    <li>Entre 7 et 3 jours avant le depart : frais de 10% du montant</li>
                    <li>Moins de 3 jours : modification non garantie</li>
                </ul>
                <p>Contactez notre service client pour toute demande de modification.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <button class="faq-question">
                <span>Quelle est votre politique d'annulation ?</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Notre politique d'annulation est flexible :</p>
                <ul>
                    <li><strong>Annulation 30+ jours avant :</strong> Remboursement integral</li>
                    <li><strong>Annulation 15-29 jours avant :</strong> 75% rembourse</li>
                    <li><strong>Annulation 7-14 jours avant :</strong> 50% rembourse</li>
                    <li><strong>Annulation -7 jours :</strong> Aucun remboursement</li>
                </ul>
            </div>
        </div>
        
        <div class="faq-item">
            <button class="faq-question">
                <span>Ai-je besoin d'un visa pour voyager a l'etranger ?</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Les formalites de visa varient selon votre destination :</p>
                <ul>
                    <li><strong>Visa gratuit :</strong> CEDEAO, Tunisie, Maroc</li>
                    <li><strong>Visa a l'arrivee :</strong> Kenya, Tanzanie, Egypte</li>
                    <li><strong>Visa obligatoire avant depart :</strong> Europe, USA, Canada, Asie</li>
                </ul>
                <p>Nous vous accompagnons dans vos demarches de visa.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <button class="faq-question">
                <span>Quelle assurance voyage recommandez-vous ?</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="faq-answer">
                <p>Nous recommandons vivement une assurance voyage complete :</p>
                <ul>
                    <li><strong>Assistance medicale :</strong> Prise en charge des frais de sante</li>
                    <li><strong>Annulation :</strong> Remboursement en cas d'imprevu</li>
                    <li><strong>Bagages :</strong> Indemnisation en cas de perte ou vol</li>
                    <li><strong>Rapatriement :</strong> Retour au domicile en urgence</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>