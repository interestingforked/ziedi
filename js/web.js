$(document).ready(function () {
    
    $('.navigation .submenu').hide();
    $('.navigation .current .submenu').show();
    $('.navigation a').click(function () {
        var url = $(this).attr('href');
        if (url == '#') {
            $(this).parent().find('.submenu').slideToggle();
            return false;
        } else {
            return true;
        }
    });
    
});