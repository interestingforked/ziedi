$(document).ready(function () {
    
    $('.navigation .submenu').hide();
    $('.navigation .current .submenu').show();
    
    var currentMainNavElement = $('.navigation .current');
    if ($(currentMainNavElement).find('.current').length > 0) {
        var elementHtml = $('.current', currentMainNavElement).html();
        $('.current', currentMainNavElement).html('<b>' + elementHtml + '</b>');
    } else {
        var elementHtml = $('.navigation .current').html();
        $('.navigation .current').html('<b>' + elementHtml + '</b>');
    }
    
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
    
    $('.postcardList a').live('click', function () {
        var url = $(this).attr('href');
        if (url == '#') return false;
        $.get(url, function (data) {
            $('#postcardList').html(data);
        });
        return false;
    });
    
    $('.giftList a').live('click', function () {
        var url = $(this).attr('href');
        if (url == '#') return false;
        $.get(url, function (data) {
            $('#giftList').html(data);
        });
        return false;
    });
    
    $('.gift-select a').live('click', function () {
        var url = $(this).attr('href');
        if (url == '#') return false;
        $.get(url, function (data) {
            $('.gift-list').html(data);
        });
        return false;
    });
    
    $('.postcardList a:first').click();
    $('.giftList a:first').click();
    $('.gift-select a:first').click();
    
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
    
    $('.deleteCartItem').click(function () {
        var productInfo = $(this).attr('rel').split('__');
        $('#tmpForm #action').val('removeItem');
        $('#tmpForm #productId').val(productInfo[0]);
        $('#tmpForm #productNodeId').val(productInfo[1]);
        $('#tmpForm').submit();
    });
    
    $('.orderItem').live('click', function () {
        var productInfo = $(this).attr('rel').split('_');
        $('#tmpForm #action').val('addItem');
        $('#tmpForm #productType').val(productInfo[0]);
        $('#tmpForm #productId').val(productInfo[1]);
        $('#tmpForm #productNodeId').val(productInfo[2]);
        $('#tmpForm #price').val(productInfo[3]);
        
        var pattern = /cart/i;
        if (pattern.test(document.URL)) {
            $('#tmpForm').submit();
        } else {
            var serializedForm = $('#tmpForm').serialize();
            $.ajax({
                type: 'POST',
                url: document.URL,
                data: serializedForm,
                success: function (responseData) {
                    alert(responseData);
                },
                dataType: 'html'
            });
        }
        return false;
    });

});