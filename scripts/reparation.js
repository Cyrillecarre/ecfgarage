//action du burger menu
document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.getElementById('burger-menu');
    const navList = document.querySelectorAll('.navListe');

    burgerMenu.addEventListener('click', function() {
        navList.forEach(item => {
            item.classList.toggle('show');
        });
    });
});