console.log("le JavaScript fonctionne correctement!")

/*Affichage modale */


document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.querySelector('#menu-item-47');
    const contactBtn = document.querySelector('#contact-btn');
    const modalOverlay = document.querySelector('.popup-overlay');
    const refField = document.querySelector('#ref_field');

    function openModal() {
        modalOverlay.style.display = 'flex';
    
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
    const minPhoto = document.getElementById('minPhoto');

    arrowLeft && arrowLeft.addEventListener('mouseover', function() {
        minPhoto.style.visibility = 'visible';
        minPhoto.style.opacity = 1;
        minPhoto.innerHTML = `<a href="${this.getAttribute('data-target-url')}">
                                <img src="${this.getAttribute('data-thumbnail-url')}" alt="Photo précédente">
                              </a>`;
    });

    arrowLeft && arrowLeft.addEventListener('mouseout', function() {
        minPhoto.style.visibility = 'hidden';
        minPhoto.style.opacity = 0;
    });

    arrowRight && arrowRight.addEventListener('mouseover', function() {
        minPhoto.style.visibility = 'visible';
        minPhoto.style.opacity = 1;
        minPhoto.innerHTML = `<a href="${this.getAttribute('data-target-url')}">
                                <img src="${this.getAttribute('data-thumbnail-url')}" alt="Photo suivante">
                              </a>`;
    });

    arrowRight && arrowRight.addEventListener('mouseout', function() {
        minPhoto.style.visibility = 'hidden';
        minPhoto.style.opacity = 0;
    });

    arrowLeft && arrowLeft.addEventListener('click', function() {
        window.location.href = this.getAttribute('data-target-url');
    });

    arrowRight && arrowRight.addEventListener('click', function() {
        window.location.href = this.getAttribute('data-target-url');
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
                'action': 'filter_photos', 
                'filter': filter
            },
            type: 'POST',
            beforeSend: function(){
                $('#photos-container').html('<div class="loading">Chargement...</div>');
            },
            success: function(data) {
                $('#photos-container').html(data);
                attachEventsToImages();
            }
        });
    }

    
    $('#photo-filters select').on('change', function(){
        fetchFilteredPhotos(); 
    });
})(jQuery);


/*Lightbox ouverture et fermeture*/


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

    // fonction attache les événements aux images,
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

//  Chargement de plus d'images avec Ajax
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
                    attachEventsToImages(); 
                } else {
                    button.text('Plus de photos à charger');
                }
            }
        });
    });
})(jQuery);




