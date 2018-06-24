import 'popper.js';
import 'bootstrap';
import './../modules/fontawesome-free-5.0.13/svg-with-js/js/fontawesome-all.min';

$(function () {

    var offset = 45;
    var speed = 200;

    $('body').scrollspy({
        target: '#navigation',
        offset: offset,
    })
    $('a[href^="#"]').click(function () {
        var the_id = $(this).attr("href");
        if (the_id === '#') {
            return;
        }
        $('html, body').animate({
            scrollTop: ($(the_id).offset().top - offset)
        }, speed);
        return false;
    });
})