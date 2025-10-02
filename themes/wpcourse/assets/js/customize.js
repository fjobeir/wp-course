(function ($) {
    wp.customize("footer_signature", function (value) {
        value.bind(function (to) {
            $(".footer_signature").html(to);
        });
    });
})(jQuery);