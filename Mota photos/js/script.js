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

/* Défilement miniatures page single */







/*Ouverture et fermeture lightbox */
$(document).ready(function() {
    var $lightbox = $('.lightbox');
    var relatedBlockCount = window.relatedBlockCount;

    $('.fullscreen-icon').click(function(e) {
        e.preventDefault();
        var url = $(this).parent().prev().attr('src');
        var categorie = $(this).data('categorie');
        var reference = $(this).data('reference');
        var index = $(this).data('index');

        $lightbox.data('categorie', categorie);
        $lightbox.data('reference', reference);
        $lightbox.data('index', index);

        $('.lightbox-category').text(categorie);
        $('.lightbox-reference').text(reference);
        $('.lightbox-photo').html('<img src="' + url + '">');

        $lightbox.fadeIn();
    });

    $('.lightbox-prev').click(function() {
        var currentIndex = $lightbox.data('index');
        currentIndex = (currentIndex - 1 + relatedBlockCount) % relatedBlockCount;
        var photo_url = $('.fullscreen-icon').eq(currentIndex).data('imgurl');
        var categorie = $('.fullscreen-icon').eq(currentIndex).data('categorie');
        var reference = $('.fullscreen-icon').eq(currentIndex).data('reference');

        $lightbox.data('categorie', categorie);
        $lightbox.data('reference', reference);
        $lightbox.data('index', currentIndex);

        $('.lightbox-category').text(categorie);
        $('.lightbox-reference').text(reference);
        $('.lightbox-photo').html('<img src="' + photo_url + '">');
    });

    $('.lightbox-next').click(function() {
        var currentIndex = $lightbox.data('index');
        currentIndex = (currentIndex + 1) % relatedBlockCount;
        var photo_url = $('.fullscreen-icon').eq(currentIndex).data('imgurl');
        var categorie = $('.fullscreen-icon').eq(currentIndex).data('categorie');
        var reference = $('.fullscreen-icon').eq(currentIndex).data('reference');

        $lightbox.data('categorie', categorie);
        $lightbox.data('reference', reference);
        $lightbox.data('index', currentIndex);

        $('.lightbox-category').text(categorie);
        $('.lightbox-reference').text(reference);
        $('.lightbox-photo').html('<img src="' + photo_url + '">');
    });

    $('.close-lightbox').click(function() {
        $lightbox.fadeOut();
    });
});