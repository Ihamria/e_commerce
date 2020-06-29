jQuery( document ).ready(function($) {
    "use strict";
    $('.cncb_parent_field').on('click', function () {
        $(this).parents('fieldset').find('.cncb_sub_field_wrapper').toggle('show');
    });
});
