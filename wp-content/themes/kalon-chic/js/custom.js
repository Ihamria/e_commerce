jQuery(document).ready(function($) {
    $('.masonry-layout').imagesLoaded(function() {
        $('.masonry-layout').masonry({
            itemSelector: '.post'
        });
    });
});