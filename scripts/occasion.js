document.addEventListener('DOMContentLoaded', function() {
    console.log('Page chargée');

    const vehiculesListElement = document.getElementById('vehiculesList');

    console.log('Avant fetch');

    fetch('/vehicule.php')
        .then(response => {
            console.log('Réponse du serveur :', response);
            return response.json();
        })
        .then(data => {
            console.log('Données récupérées avec succès :', data);
            data.forEach(car => {
                const vehiculeElement = document.createElement('div');
                vehiculeElement.innerHTML = `<p>${car.nom} - ${car.annee} - ${car.kilometrage} km</p>`;
                vehiculesListElement.appendChild(vehiculeElement);
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des données:', error));

    console.log('Après fetch');
});
