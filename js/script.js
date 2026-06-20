// ============================================
// WONDERLY - JAVASCRIPT
// ============================================

(function() {
    'use strict';

    // ============================================
    // TOAST NOTIFICATION
    // ============================================
    function showToast(message, type = 'info') {
        const toast = document.getElementById('toast');
        if (!toast) return;

        toast.textContent = message;
        toast.className = 'toast ' + type;
        void toast.offsetWidth;
        toast.classList.add('show');

        clearTimeout(toast._timeout);
        toast._timeout = setTimeout(() => {
            toast.classList.remove('show');
        }, 3500);
    }

    // ============================================
    // HEADER SCROLL
    // ============================================
    function handleScroll() {
        const header = document.querySelector('header');
        if (!header) return;
        header.classList.toggle('scrolled', window.scrollY > 20);
    }

    // ============================================
    // MOBILE MENU
    // ============================================
    function setupMobileMenu() {
        const toggle = document.getElementById('menuToggle');
        const nav = document.getElementById('mainNav');
        const icon = toggle?.querySelector('i');

        if (!toggle || !nav) return;

        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = nav.classList.toggle('open');
            if (icon) {
                icon.className = isOpen ? 'fas fa-times' : 'fas fa-bars';
            }
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        document.addEventListener('click', function(e) {
            if (nav.classList.contains('open') &&
                !nav.contains(e.target) &&
                !toggle.contains(e.target)) {
                nav.classList.remove('open');
                if (icon) icon.className = 'fas fa-bars';
                document.body.style.overflow = '';
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && nav.classList.contains('open')) {
                nav.classList.remove('open');
                if (icon) icon.className = 'fas fa-bars';
                document.body.style.overflow = '';
            }
        });
    }

    // ============================================
    // SEARCH TABS
    // ============================================
    function setupSearchTabs() {
        const tabs = document.querySelectorAll('#searchTabs span');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }

    // ============================================
    // FAQ ACCORDION
    // ============================================
    function setupFaq() {
        document.querySelectorAll('.faq-question').forEach(btn => {
            btn.addEventListener('click', function() {
                const item = this.parentElement;
                const isActive = item.classList.contains('active');
                
                document.querySelectorAll('.faq-item').forEach(el => {
                    el.classList.remove('active');
                });
                
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
    }

    // ============================================
    // TOGGLE PASSWORD
    // ============================================
    function setupTogglePassword() {
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash';
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye';
                }
            });
        });
    }

    // ============================================
    // PAYMENT METHODS
    // ============================================
    function setupPaymentMethods() {
        document.querySelectorAll('.payment-method').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const method = this.dataset.method;
                document.getElementById('paymentMethod').value = method;
                
                document.querySelectorAll('.payment-content').forEach(el => el.style.display = 'none');
                const target = document.getElementById('payment-' + method);
                if (target) target.style.display = 'block';
            });
        });
    }

    // ============================================
    // INITIALISATION
    // ============================================
    function init() {
        handleScroll();
        setupMobileMenu();
        setupSearchTabs();
        setupFaq();
        setupTogglePassword();
        setupPaymentMethods();

        window.addEventListener('scroll', handleScroll, { passive: true });

        console.log('Wonderly - Site de voyage');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();