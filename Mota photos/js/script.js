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
                    $('#photo-block-more').before($newContent);
                    button.text('Charger plus');
                } else {
                    button.text('Plus de photos à charger');
                }
            }
        });
    });
})(jQuery);
