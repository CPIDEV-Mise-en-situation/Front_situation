document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const closeBtn = document.querySelector('.close-btn');
    const nav = document.querySelector('.nav');

    // Ouverture
    hamburger.addEventListener('click', function() {
        nav.classList.add('active');
    });

    // Fermeture
    closeBtn.addEventListener('click', function() {
        nav.classList.remove('active');
    });
});
