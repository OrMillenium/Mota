console.log("Le JavaScript fonctionne correctement!");

/*Affichage modale */
document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.querySelector('#menu-item-47 a');
    const modalOverlay = document.querySelector('.popup-overlay');
    const modalContact = document.querySelector('.popup-contact');
    const contactButton = document.querySelector('#contact-btn');

    function openModal() {
        modalOverlay.style.display = 'flex';
    }

    function closeModal() {
        modalOverlay.style.display = 'none';
    }

    if (contactLink && modalOverlay && contactButton) {
        contactLink.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        });

        contactButton.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

/*Affichage menu burger */

    const toggle_btn = document.querySelector('.toggle_btn');
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

    
    

/*Affichage photos single photos */

    const arrowImages = document.querySelectorAll('.nav-arrow img.arrow');
    const minPhoto = document.querySelector('.min-photo');

    if (minPhoto) {
        arrowImages.forEach(arrow => {
            arrow.addEventListener('mouseover', function() {
                const imageUrl = arrow.getAttribute('data-image');
                minPhoto.innerHTML = `<img src="${imageUrl}" alt="thumbnail">`;
            });
        });
    }
});

/*Affichage filtre ajax */
jQuery(document).ready(function($) {
    $('#filters select').on('change', function() {
        var taxonomy = $(this).attr('id');
        var term = $(this).val();
        var data = {
            'action': 'filter_photos',
            'taxonomy': taxonomy,
            'term': term
        };
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: data,
            success: function(response) {
                $('#photos-container').html(response);
            }
        });
    });
});




/*Pagination infinie pour la section catalogue*/
var page = 1;

const loadMoreButton = document.getElementById('load-more');
const photosContainer = document.getElementById('photos-container');

if (loadMoreButton) {
    loadMoreButton.addEventListener('click', function() {
        page++;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', ajaxurl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);
                if (response.length > 0) {
                    response.forEach(function(photo) {
                        var photoHTML = `
                            <div class="related_block">
                                <img src="${photo.thumbnail_url}" alt="${photo.post_title}">
                            </div>
                        `;
                        photosContainer.insertAdjacentHTML('beforeend', photoHTML);
                    });

                    var totalPhotos = response.length;

                    if (totalPhotos < 8) {
                        loadMoreButton.style.display = 'none';
                    }

                } else {
                    loadMoreButton.style.display = 'none';
                }
            }
        };
        xhr.send('action=request_photos&page=' + page);
    });
}