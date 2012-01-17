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
    
    $('input[name=productNodeId]').click(function () {
        var productNodeId = $(this).val();
        $.ajax({
            type: 'POST',
            url: document.URL,
            data: 'node=' + productNodeId,
            success: function (responseData) {
                $('#price').val(responseData);
                
                var priceText = $('.prod-price').text();
                $('.prod-price').text(priceText.replace(/\d+\.\d+/, responseData));
                
            },
            dataType: 'html'
        });
    });
    
    $('.gift-select a:first').click();
    
    $('.postcardList a').click(function () {
        var url = $(this).attr('href');
        if (url == '#') return false;
        $.get(url, function (data) {
            $('#postcardList').html(data);
        });
        return false;
    });
    
    $('.giftList a').click(function () {
        var url = $(this).attr('href');
        if (url == '#') return false;
        $.get(url, function (data) {
            $('#giftList').html(data);
        });
        return false;
    });
    
    $('.list .img a').live('click', function () {
        $.fancybox({
            'transitionIn' : 'elastic',
            'transitionOut' : 'elastic',
            'href' : this.href,
            'width' : 640,
            'height' : 480,
            'ajax' : {
                type : "GET"
            }
        });
        return false;
    });
    
    $('.images img').each(function (index) {
        if (index > 0) $(this).css('display', 'none');
    });
    
    $('.thumb img').hover(function () {
        var imageID = $(this).attr('id');
        $('.images img').css('display', 'none');
        $('#' + imageID.replace('thumb', 'big')).css('display', 'inline');
    });
    
    $('a[rel="image-group"]').fancybox({
        'titleShow' : false,
        'transitionIn' : 'elastic',
        'transitionOut' : 'elastic',
        'cyclic':true
    });
    
});