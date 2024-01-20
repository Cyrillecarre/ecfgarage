
document.addEventListener('DOMContentLoaded', function () {
    const rangeInputPrix = document.getElementById('rangeInputPrix');
    const currentValuePrix = document.getElementById('currentValuePrix');
    rangeInputPrix.addEventListener('input', (event) => {
        currentValuePrix.textContent = event.target.value;
    });

    const rangeInputAnnee = document.getElementById('rangeInputAnnee');
    const currentValueAnnee = document.getElementById('currentValueAnnee');
    rangeInputAnnee.addEventListener('input', (event) => {
        currentValueAnnee.textContent = event.target.value;
    });

    const rangeInputKm = document.getElementById('rangeInputKm');
    const currentValueKm = document.getElementById('currentValueKm');
    rangeInputKm.addEventListener('input', (event) => {
        currentValueKm.textContent = event.target.value;
    });
});

class Filtre {
    constructor() {
        this.filtreForm = document.getElementById('filtreForm');
        this.rangeInputPrix = document.getElementById('rangeInputPrix');
        this.rangeInputAnnee = document.getElementById('rangeInputAnnee');
        this.rangeInputKm = document.getElementById('rangeInputKm');
        this.vehiculeContent = document.querySelectorAll('.vehiculeContent');

        this.currentValuePrix = document.getElementById('currentValuePrix');
        this.currentValueAnnee = document.getElementById('currentValueAnnee');
        this.currentValueKm = document.getElementById('currentValueKm');

        this.rangeInputPrix.addEventListener('input', (event) => {
            this.currentValuePrix.textContent = event.target.value;
        });
        this.rangeInputAnnee.addEventListener('input', (event) => {
            this.currentValueAnnee.textContent = event.target.value;
        });
        this.rangeInputKm.addEventListener('input', (event) => {
            this.currentValueKm.textContent = event.target.value;
        });

        this.filtreForm.addEventListener('submit', function (event) {
            event.preventDefault();
            this.filterVehicules();
        }.bind(this));
    }

    filterVehicules() {
        const formData = new FormData(this.filtreForm);
        const params = new URLSearchParams(formData).toString();
    
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/server/filtre.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                this.updateVehiculeContent(xhr.responseText);
            } else if (xhr.readyState === 4) {
                console.error('Erreur lors de la requête au serveur. Statut:', xhr.status);
            }
        };
        xhr.send(params);
    }
    
    
    
    updateVehiculeContent(response) {
        const vehiculeContener = document.querySelector('.vehiculeContener');
        vehiculeContener.innerHTML = response;
        }   
    } 

const filtre = new Filtre();



