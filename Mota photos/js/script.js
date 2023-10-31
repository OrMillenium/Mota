console.log("Le JavaScript fonctionne correctement!");

/*Affichage modale */

document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.querySelector('#menu-item-47');
    const contactBtn = document.querySelector('#contact-btn');
    const modalOverlay = document.querySelector('.popup-overlay');

    function openModal() {
        modalOverlay.style.display = 'flex';
    }

    function closeModal() {
        modalOverlay.style.display = 'none';
    }

    if (contactLink) {
        contactLink.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    if (contactBtn) {
        contactBtn.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });
});

/*Affichage menu burger */

    let toggle_btn = document.querySelector('.toggle_btn');
    const burger = document.querySelector('.Menu');

    if (toggle_btn && burger) {
        toggle_btn.addEventListener('click', () => {
            burger.classList.toggle('nav_open');
            toggle_btn.classList.toggle('active');
        });
    }

    const menuLinks = document.querySelectorAll('.MenuFull ul li a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            burger.classList.remove('nav_open');
            if (toggle_btn) {
                toggle_btn.classList.remove('active');
            }
        });
    });

    
    
/*Ouverture et fermeture lightbox */
$(document).ready(function() {
    var $lightbox = $('.lightbox'); // Sélectionnez la lightbox

    $('.fullscreen-icon').click(function(e) {
        e.preventDefault();

        var url = $(this).parent().prev().attr('src'); // Récupérez l'URL de l'image
        var categorie = $(this).data('categorie'); // Récupérez la catégorie
        var reference = $(this).data('reference'); // Récupérez la référence
        var index = $(this).data('index'); // Récupérez l'index

        
        $lightbox.data('categorie', categorie); // Stockez la catégorie dans la lightbox
        $lightbox.data('reference', reference); // Stockez la référence dans la lightbox
        $lightbox.data('index', index); // Stockez l'index dans la lightbox

        // Afficher la catégorie et la référence dans la lightbox
        $('.lightbox-category').text(categorie);
        $('.lightbox-reference').text(reference);
        $('.lightbox-photo').html('<img src="' + url + '">');
        $lightbox.fadeIn();
    });

    $('.close-lightbox').click(function() {
        $lightbox.fadeOut();
    });
});