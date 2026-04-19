import '../css/app.css';
import $ from 'jquery';

const imagesCtx = require.context('../images', false, /\.(png|ico|jpe?g)$/);
imagesCtx.keys().forEach(imagesCtx);

const videosCtx = require.context('../images', false, /\.mp4$/);
videosCtx.keys().forEach(videosCtx);

/**
 * MANAGE PAGE SCROLLING WITH ANCHOR
 * @author ludovic
 */
function scrollToId(id, callback) {
    $('html').animate({ scrollTop: $(id).offset().top }, 1000, null, callback);
}

$(function () {
    $('.action').on('click', function () {
        scrollToId($(this).data('target'));
    });

    $('#scrolltop').on('click', function () {
        scrollToId('#top');
    });

    $('.action').on('mouseenter', function () {
        $(this).parent().find('.bouton').addClass('move');
        $(this).parent().find('.hvr-sweep-to-right').addClass('animate');
    }).on('mouseleave', function () {
        $(this).parent().find('.bouton').removeClass('move');
        $(this).parent().find('.hvr-sweep-to-right').removeClass('animate');
    });

    $(document).on('scroll', function () {
        if ($(window).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });
});
