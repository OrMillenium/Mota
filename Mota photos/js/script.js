console.log("Le JavaScript fonctionne correctement!");

document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.querySelector('#menu-item-47 a');
    const modalOverlay = document.querySelector('.popup-overlay');
    const modalContact = document.querySelector('.popup-contact');
    const contactButton = document.querySelector('#contactButton');

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

    var page = 1;
    const loadMoreButton = document.getElementById('load-more');

    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function() {
            page++;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', ajaxurl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = xhr.responseText;
                    if (response) {
                        document.querySelector('.photo-container').insertAdjacentHTML('beforeend', response);
                    } else {
                        loadMoreButton.style.display = 'none';
                    }
                }
            };
            xhr.onerror = function() {
                console.log('Erreur réseau');
            };
            xhr.send('action=request_photos&page=' + page);
        });
    }

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