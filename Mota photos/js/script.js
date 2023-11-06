console.log("le JavaScript fonctionne correctement!")

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



/* récupération de la référence photo pour le champs de contact*/
document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.querySelector('#menu-item-47');
    const contactBtn = document.querySelector('#contact-btn');
    const modalOverlay = document.querySelector('.popup-overlay');
    const refField = document.querySelector('#ref_field');

    function openModal() {
        modalOverlay.style.display = 'flex';
        // Si refField existe et contactBtn a un attribut data-reference, préremplissez le champ.
        if (refField && contactBtn.hasAttribute('data-reference')) {
            refField.value = contactBtn.getAttribute('data-reference');
        }
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
const toggle_btn = document.querySelector('.toggle_btn');
const burger = document.querySelector('.Menu');


    toggle_btn.addEventListener('click', () => {
        burger.classList.toggle('nav_open');
        toggle_btn.classList.toggle('active');
    });
/* FERMETURE MENU SUR CLIC LIEN */

const menuLinks = document.querySelectorAll('.MenuFull ul li a');
menuLinks.forEach(link => {
    link.addEventListener('click', () => {
        burger.classList.remove('nav_open');
        toggle_btn.classList.remove('active');
    });
});


/* Affichage miniature*/

document.addEventListener('DOMContentLoaded', function() {
    const arrowLeft = document.querySelector('.arrow-left');
    const arrowRight = document.querySelector('.arrow-right');
    const minPhotoLeft = document.querySelector('.minPhoto-left');
    const minPhotoRight = document.querySelector('.minPhoto-right');
  
    // Affichage de la miniature au survol des flèches
    arrowLeft.addEventListener('mouseover', function() {
      minPhotoLeft.style.display = 'block';
    });
    arrowLeft.addEventListener('mouseout', function() {
      minPhotoLeft.style.display = 'none';
    });
  
    arrowRight.addEventListener('mouseover', function() {
      minPhotoRight.style.display = 'block';
    });
    arrowRight.addEventListener('mouseout', function() {
      minPhotoRight.style.display = 'none';
    });
  
    // Changement d'image au clic des flèches
    arrowLeft.addEventListener('click', function() {
      window.location.href = arrowLeft.getAttribute('data-previous-photo');
    });
    arrowRight.addEventListener('click', function() {
      window.location.href = arrowRight.getAttribute('data-next-photo');
    });
  });
  




/* Filtres*/

(function($){
    // Fonction pour récupérer les photos en fonction des filtres
    function fetchFilteredPhotos(){
        var filter = {
            'categorie': $('#categorie').val(),
            'format': $('#format').val(),
            'annee': $('#annee').val(),
        };
        
        $.ajax({
            url: ajaxloadmore.ajaxurl,
            data: {
                'action': 'filter_photos', // Vous créerez cette action dans functions.php
                'filter': filter
            },
            type: 'POST',
            beforeSend: function(){
                $('#photos-container').html('<div class="loading">Chargement...</div>');
            },
            success: function(data) {
                $('#photos-container').html(data);
            }
        });
    }

    // Attachez l'événement change aux sélecteurs pour déclencher la fonction de filtrage
    $('#photo-filters select').on('change', function(){
        fetchFilteredPhotos(); // Appel de la fonction lorsqu'un filtre est modifié
    });
})(jQuery);


/*Lightbox ouverture et fermeture*/

// Code pour la lightbox
document.addEventListener('DOMContentLoaded', function() {
    var lightbox = document.getElementById('lightbox');
    var lightboxImage = document.querySelector('.lightbox-image');
    var lightboxCategory = document.querySelector('.lightbox-category');
    var lightboxReference = document.querySelector('.lightbox-reference');
    var currentIndex = 0; // Index de l'image actuellement affichée

    function updateLightbox(index) {
        var images = document.querySelectorAll('.fullscreen-icon');
        var image = images[index];
        lightboxImage.src = image.getAttribute('data-full');
        lightboxCategory.textContent = image.getAttribute('data-category');
        lightboxReference.textContent = image.getAttribute('data-reference');
        currentIndex = index;
    }

    function openLightbox(index) {
        updateLightbox(index);
        lightbox.style.display = 'block';
    }

    function closeLightbox() {
        lightbox.style.display = 'none';
    }

    // Cette fonction attache les événements aux images, y compris celles chargées dynamiquement
    window.attachEventsToImages = function() {
        var images = document.querySelectorAll('.fullscreen-icon');
        images.forEach((image, index) => {
            image.removeEventListener('click', imageClickHandler); // Supprime les anciens événements pour éviter les doublons
            image.addEventListener('click', imageClickHandler); // Ajoute l'événement click
        });
    };

    // Gestionnaire d'événement de click pour les images
    function imageClickHandler(event) {
        var images = document.querySelectorAll('.fullscreen-icon');
        var index = Array.prototype.indexOf.call(images, event.target.closest('.fullscreen-icon'));
        openLightbox(index);
    }

    // Attachez les événements initiaux aux images
    attachEventsToImages();

    // Fermeture de la lightbox
    document.querySelector('.close-lightbox').addEventListener('click', closeLightbox);

    // Navigation précédente
    document.querySelector('.lightbox-prev').addEventListener('click', function() {
        var images = document.querySelectorAll('.fullscreen-icon');
        if (currentIndex > 0) {
            updateLightbox(currentIndex - 1);
        } else {
            updateLightbox(images.length - 1);
        }
    });

    // Navigation suivante
    document.querySelector('.lightbox-next').addEventListener('click', function() {
        var images = document.querySelectorAll('.fullscreen-icon');
        if (currentIndex < images.length - 1) {
            updateLightbox(currentIndex + 1);
        } else {
            updateLightbox(0);
        }
    });

    // Fermer la lightbox si l'utilisateur clique en dehors de l'image
    lightbox.addEventListener('click', function(event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });
});

// Code pour le chargement de plus d'images avec Ajax
(function($) {
    $('#load-more').click(function() {
        var button = $(this),
            data = {
                'action': 'load_more',
                'query': ajaxloadmore.query_vars,
                'page': button.data('page')
            };

        $.ajax({
            url: ajaxloadmore.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Chargement...');
            },
            success: function(data) {
                if (data === 'no_posts') {
                    button.remove();
                } else if(data) {
                    button.data('page', button.data('page') + 1);
                    $('#photo-block-more').before($(data));
                    button.text('Charger plus');
                    attachEventsToImages(); // Réattacher les événements après chaque chargement
                } else {
                    button.text('Plus de photos à charger');
                }
            }
        });
    });
})(jQuery);




/*Affichage pagination infinie*/


(function($){
    $('#load-more').click(function(){
        var button = $(this),
            data = {
                'action': 'load_more',
                'query': ajaxloadmore.query_vars,
                'page': button.data('page')
            };

        $.ajax({
            url: ajaxloadmore.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Chargement...');
            },
            success: function(data) {
                if (data === 'no_posts') {
                    button.remove(); // Supprimez le bouton s'il n'y a plus de posts
                } else if(data) {
                    button.data('page', button.data('page') + 1);
                    var $newContent = $(data);
                    $('#photos-container').append($newContent); // Assurez-vous de modifier ici si nécessaire
                    button.text('Charger plus');
                    
                    // Mettre à jour la lightbox avec les nouvelles images
                    if(window.updateLightboxImages) {
                        window.updateLightboxImages();
                    }
                } else {
                    button.text('Plus de photos à charger');
                }
            }
        });
    });
})(jQuery);