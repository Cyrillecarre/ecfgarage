document.addEventListener('DOMContentLoaded', function() {
    const option = document.querySelector('.option');
    const optionAdditionnel = document.querySelectorAll('.optionAdditionnel');

    option.addEventListener('click', function() {
        optionAdditionnel.forEach(function(element) {
            element.classList.toggle('display-block');
        });
        });
    });

