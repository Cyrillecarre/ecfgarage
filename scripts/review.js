document.addEventListener('DOMContentLoaded', function() {
    const star1 = document.getElementById('etoile1');
    const star2 = document.getElementById('etoile2');
    const star3 = document.getElementById('etoile3');
    const star4 = document.getElementById('etoile4');
    const star5 = document.getElementById('etoile5');

    star1.addEventListener('click', function() {
        star2.classList.remove('inputClic');
        star3.classList.remove('inputClic');
        star4.classList.remove('inputClic');
        star5.classList.remove('inputClic');
    });

    star2.addEventListener('click', function() {
        star1.classList.add('inputClic');
        star3.classList.remove('inputClic');
        star4.classList.remove('inputClic');
        star5.classList.remove('inputClic');

    });
    star3.addEventListener('click', function() {
        star1.classList.add('inputClic');
        star2.classList.add('inputClic');
        star4.classList.remove('inputClic');
        star5.classList.remove('inputClic');
    });
    star4.addEventListener('click', function() {
        star1.classList.add('inputClic');
        star2.classList.add('inputClic');
        star3.classList.add('inputClic');
        star5.classList.remove('inputClic');
    });
    star5.addEventListener('click', function(){
        star1.classList.add('inputClic');
        star2.classList.add('inputClic');
        star3.classList.add('inputClic');
        star4.classList.add('inputClic');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.getElementById('burger-menu');
    const navList = document.querySelectorAll('.navListe');

    burgerMenu.addEventListener('click', function() {
        navList.forEach(item => {
            item.classList.toggle('show');
        });
    });
});