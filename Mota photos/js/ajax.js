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




/*Pagination infinie pour la section catalogue
jQuery(document).ready(function ($) {

    let page = 2; 
    let loading = false; 

    $('#load-more').click(function () {
        if (!loading) {
            loading = true;
            loadMorePhotos(page, 'large');
            page++;
        }
    });

    function loadMorePhotos(page, thumbnail_size) {
        var offset = (page - 1) * 2; 
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'request_photos',
                page: page,
            },
            success: function (response) {
                if (response && response.length > 0) {
                    response.forEach(function (photo) {
                        let photoHTML = `
                            <div class="related_block" data-imgurl="${photo.thumbnail_url}" data-reference="${photo.reference}" data-categorie="${photo.categorie}">
                                <img src="${photo.thumbnail_url}" alt="${photo.post_title}">
                                <div class="overlay">
                                    <img class="eye-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_eye.svg" alt="Icone oeil">
                                    <img class="fullscreen-icon open-lightbox" src="<?php echo get_template_directory_uri(); ?>/assets/img/fullscreen.svg" alt="Icone fullscreen">
                                </div>
                            </div>
                        `;
                        $('#photos-container').append(photoHTML);
                    });
                    
                } else {
                    $('#load-more').hide();
                }
                loading = false;
            },
            error: function () {
                console.error('Erreur de chargement de la page.');
            }
        });
    }

});*/
    
    
    