console.log("le JavaScript fonctionne correctement!")


/*FERMETURE MODALE*/

document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.querySelector('#menu-item-47 a'); 
    const modalOverlay = document.querySelector('.popup-overlay');
    const modalContact = document.querySelector('.popup-contact');

    // Fonction pour ouvrir la modal
    function openModal() {
       modalOverlay.style.display = 'flex';
    }

    // Fonction pour fermer la modal
    function closeModal() {
       modalOverlay.style.display = 'none';
    }

    if (contactLink && modalOverlay) {
        // Ajout d'un écouteur pour le clic sur le lien "Contact"
        contactLink.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    // Ajout d'un écouteur pour fermer la modal en cliquant en dehors d'elle
    window.addEventListener('click', function(event) {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

    
});