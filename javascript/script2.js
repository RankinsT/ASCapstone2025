// logo
document.addEventListener('DOMContentLoaded', function() {
    const logo = document.querySelector('.logo-img');
    window.addEventListener('scroll', function() {
        if(window.scrollY > 0) {
            logo.classList.add('hide-on-scroll');
        } else {
            logo.classList.remove('hide-on-scroll');
        }
    });
});