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
            type: 'GET',
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
    
    var price = parseFloat($('#price').val());
    var shippingPrice = parseFloat($('#shippingPrice').val());
    $('#thePrice').text(price + shippingPrice);

    $('#shipping_time').change();
    $('#shipping_time').change(function () {
        var price = parseFloat($('#price').val());
        var value = $(this).val();
        if (value == '5') {
            $('#shippingExactTime').show();
        } else {
            $('#shippingExactTime').hide();
            checkDate();
        }
        $('#shippingPrice').val(7);
        var shippingPrice = parseFloat($('#shippingPrice').val());
        $('#thePrice').text(price + shippingPrice);
    });
    
    $('#shipping_date_day, #shipping_date_month, #shipping_date_year, #exact_interval_from_h, '+
            '#exact_interval_from_m, #exact_interval_till_h, #exact_interval_till_m, ').change(function () {
        checkDate();
    });
    
    $('#clarify_everything').click(function () {
        var price = parseFloat($('#thePrice').text());
        if ($(this).prop('checked') == true) {
            $('#thePrice').text(price + 3.00);
            $('#price').val(price + 3.00);
        } else {
            $('#thePrice').text(price - 3.00);
            $('#price').val(price - 3.00);
        }
    });
    
    $('#shipping_city').change();
    $('#shipping_city').change(function () {
        var price = parseFloat($('#price').val());
        var shippingPrice = parseFloat($('#shippingPrice').val());
        var value = $(this).val();
        switch (value) {
            case '1':
                shippingPrice = 0;
                break;
            case '2':
            case '3':
            case '6':
                shippingPrice = 5;
                break;
            case '4':
            case '7':
            case '8':
                shippingPrice = 10;
                break;
            case '5':
                shippingPrice = 15;
                break;
        }
        var nowDate = new Date();
        if ($('#shipping_time').val() == '1' || $('#shipping_time').val() == '4' || nowDate.getDay() > 4) {
            shippingPrice = shippingPrice + 5;
            if (value == '8') {
                shippingPrice = shippingPrice + 5;
            }
        } else {
            
        }
        $('#shippingPrice').val(shippingPrice);
        $('#thePrice').text(price + shippingPrice);
    });
    
    $('#shipping_time').change(function () {
        $('#shipping_city').change();
    });
    
    var messages = {
        lv : {
            0: 'Šāds datums jau ir pagājis!',
            1: 'Intervals jau ir pagatnē!',
            2: 'Šo intervalu vairs nevar izvēlēties!',
            3: 'Piegāde ir iespējama ne atrāk ka divas stundas pēc pasūtījuma noformēšanas!',
            4: 'Izējamās dienās piegāde ārpus Rīgas rajona netiek piedāvāta!'
        },
        ru : {
            0: 'Эта дата уже в прошлом!',
            1: 'Интервал уже в прошлом!',
            2: 'Этот интервал уже нельзя выбрать!',
            3: 'Доставка возможна только через два часа после оформления заказа!',
            4: 'Доставка вне Рижского района на выходных не осуществляется!'
        }
    };
    
    function messageAlert(code) {
        if (SITE_LANGUAGE == 'ru') {
            alert(messages.ru[code]);
        } else {
            alert(messages.lv[code]);
        }
    }

    function checkDate() {
        var nowDate = new Date();
        
        var inputDay = parseInt($('#shipping_date_day').val());
        var inputMonth = parseInt($('#shipping_date_month').val());
        var inputYear = parseInt($('#shipping_date_year').val());
        
        var checkInterval = true;
        var timeStart = 0;
        var timeEnd = 0;
        
        var timeFromH, timeFromM, timeTillH, timeTillM;
        if ($('#shipping_time').val() == '1') {
            timeStart = 0;
            timeEnd = 8;
        } else if ($('#shipping_time').val() == '2') {
            timeStart = 8;
            timeEnd = 14;
        } else if ($('#shipping_time').val() == '3') {
            timeStart = 14;
            timeEnd = 18;
        } else if ($('#shipping_time').val() == '4') {
            timeStart = 18;
            timeEnd = 24;
        } else if ($('#shipping_time').val() == '5') {
            checkInterval = false;
            timeFromH = parseInt($('#exact_interval_from_h').val());
            timeFromM = parseInt($('#exact_interval_from_m').val());
            timeTillH = parseInt($('#exact_interval_till_h').val());
            timeTillM = parseInt($('#exact_interval_till_m').val());
        }
        
        if (inputDay < nowDate.getDate() && (inputMonth - 1) <= nowDate.getMonth() && inputYear <= nowDate.getFullYear()) {
            messageAlert(0);
            return false;
        }
        if (inputDay == nowDate.getDate() && (inputMonth - 1) == nowDate.getMonth() && inputYear == nowDate.getFullYear()) {
            if (checkInterval && timeEnd < nowDate.getHours()) {
                messageAlert(1);
                return false;
            }
            if (checkInterval && nowDate.getHours() > timeStart && timeEnd < nowDate.getHours()) {
                messageAlert(2);
                return false;
            }
            if (checkInterval && (timeEnd - 2) <= nowDate.getHours()) {
                messageAlert(3);
                return false;
            }
            if ($('#shipping_city').val() == '8' && nowDate.getDay() > 4) {
                messageAlert(4);
                return false;
            }
            if (timeTillH < timeFromM) {
                messageAlert(2);
                return false;
            }
            var nowH = nowDate.getHours();
            var nowM = nowDate.getMinutes();
            if ((timeFromH <= nowH && timeFromM <= nowM) || (timeTillH <= nowH && timeTillM <= nowM)) {
                messageAlert(2);
                return false;
            }
            if (timeFromH <= (nowH + 2) || (timeFromH == (nowH + 2) && timeFromM <= nowM)) {
                messageAlert(3);
                return false;
            }
        }
        return true;
    }

});