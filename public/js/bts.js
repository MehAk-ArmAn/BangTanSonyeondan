// OT7 hidden navbar toggle
document.addEventListener('keydown', function(e) {
    if (e.key === '7') {
        const navbar = document.getElementById('secret-navbar');
        if (!navbar) return;
        navbar.style.display = (navbar.style.display === 'none') ? 'block' : 'none';
    }
});

