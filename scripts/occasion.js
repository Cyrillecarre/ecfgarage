// filtre vehicule //
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

        //mise a jour des données du filtre//
        this.rangeInputPrix.addEventListener('input', (event) => {
            this.currentValuePrix.textContent = event.target.value;
        });
        this.rangeInputAnnee.addEventListener('input', (event) => {
            this.currentValueAnnee.textContent = event.target.value;
        });
        this.rangeInputKm.addEventListener('input', (event) => {
            this.currentValueKm.textContent = event.target.value;
        });

        //appel de filterVehicules au clic//
        this.filtreForm.addEventListener('submit', function (event) {
            event.preventDefault();
            this.filterVehicules();
        }.bind(this));
    }


    filterVehicules() {
        // objet à partir du formulaire filtreForm de la page occasion.php.
        const formData = new FormData(this.filtreForm);
        // Conversion des données pour envoyer au server
        const params = new URLSearchParams(formData).toString();
         // nouvelle instance de l'objet XMLHttpRequest pour envoyer au serveur (xhr est la reduction de XmlHttpRequest) 
         //state 0
        const xhr = new XMLHttpRequest();
         // state 1 pour 'filtre.php' sur le serveur. La requette est appelé
        xhr.open('POST', '/server/filtre.php', true);
         // state 2
         // puis state 3 (retour server)
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
     
        xhr.onreadystatechange = () => {
            // si la requête est terminée (state 4) on envoi xhr sinon on console.error
            if (xhr.readyState === 4 && xhr.status === 200) {
                this.updateVehiculeContent(xhr.responseText);
            } else if (xhr.readyState === 4) {
                console.error('Erreur lors de la requête au serveur. Statut:', xhr.status);
            }
        };
        
        xhr.send(params);
    }
    
    
    //affichage de la requete filtré au dessus//
    updateVehiculeContent(response) {
        const vehiculeContener = document.querySelector('.vehiculeContener');
        vehiculeContener.innerHTML = response;
        }   
    } 
    const filtre = new Filtre();

//action du burger menu//

document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.getElementById('burger-menu');
    const navList = document.querySelectorAll('.navListe');

    burgerMenu.addEventListener('click', function() {
        navList.forEach(item => {
            item.classList.toggle('show');
        });
    });
});