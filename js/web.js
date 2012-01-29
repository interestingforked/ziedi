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
            $('.navigation .submenu').slideUp();
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
                $('#orderForm #price').val(responseData);
                
                var priceText = $('.prod-price').text();
                $('.prod-price').text(priceText.replace(/\d+\.\d+/, responseData));
                
            },
            dataType: 'html'
        });
    });
    
    $('#poetryList a').live('click', function () {
        var url = $(this).attr('href');
        if (url == '#') return false;
        $.ajax({
            type: 'GET',
            url: url,
            success: function (responseData) {
                $('#poetryId').val(responseData.id);
                $('#poetryVariant').html(responseData.content);
            },
            dataType: 'json'
        });
        return false;
    });
    
    $('#submitPhrase').live('click', function () {
        var phraseId = $('#poetryId').val();
        var phraseContent = $('#poetryVariant').html();
        $('#phrase_id').val(phraseId);
        $('#phrase').html(phraseContent);
        return false;
    });
    
    $('.gift-select a').live('click', function () {
        var list = $(this).parent().parent();
        var area = $(list).attr('title');
        var prevEleme = $(list).find('.current');
        var prevHtml = $(prevEleme).html();
        if (prevHtml != null) {
            prevHtml = prevHtml.replace('<b>','');
            prevHtml = prevHtml.replace('</b>','');
            $(prevEleme).html(prevHtml)
        }
        $(prevEleme).removeClass('current');
        $(this).parent().addClass('current');
        var html = $(this).html();
        $(this).html('<b>' + html + '</b>');
        var url = $(this).attr('href');
        if (url == '#') return false;
        $.get(url, function (data) {
            $('#' + area).html(data);
            if (area == 'poetryList') {
                $('#poetryList a:first').click();
            }
        });
        return false;
    });

    $('.gift-select').each(function (index) {
        $(this).find('a:first').click();
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
    
    $('.deleteCartItem').click(function () {
        var productInfo = $(this).attr('rel').split('__');
        $('#tmpForm #action').val('removeItem');
        $('#tmpForm #productId').val(productInfo[0]);
        $('#tmpForm #productNodeId').val(productInfo[1]);
        $('#tmpForm').submit();
        return false;
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
    
    $('.addToCartButton').live('click', function () {
        var formId = $(this).attr('rel');
        $('#' + formId).submit();
        return false;
    });
    
    $('#checkoutStep1').submit(function () {
        if ( ! checkDate()) {
            return false;
        }
        if ($('#full_address').val() == null || $('#full_address').val() == '') {
            messageAlert(5);
            return false;
        }
        return true;
    });
    
    var price = parseFloat($('#price').val());
    var shippingPrice = parseFloat($('#shippingPrice').val());
    var additionalPrice = parseFloat($('#additionalPrice').val());
    $('#thePrice').text(price + additionalPrice + shippingPrice);

    $('#shipping_time').live('change', function () {
        var price = parseFloat($('#price').val());
        var shippingPrice = parseFloat($('#shippingPrice').val());
        var additionalPrice = parseFloat($('#additionalPrice').val());

        var value = $(this).val();
        if (value == '5') {
            $('#shippingExactTime').show();
            if (additionalPrice == 0 || additionalPrice == 3) {
                additionalPrice += 7;
            }
        } else {
            $('#shippingExactTime').hide();
            if (additionalPrice == 7 || additionalPrice == 10) {
                additionalPrice = additionalPrice - 7;
            }
            checkDate();
        }
        
        $('#additionalPrice').val(additionalPrice);
        $('#shipping_city').change();
        shippingPrice = parseFloat($('#shippingPrice').val());
        
        $('#thePrice').text(price + additionalPrice + shippingPrice);
    });

    $('#clarify_everything').live('click', function () {
        var price = parseFloat($('#price').val());
        var additionalPrice = parseFloat($('#additionalPrice').val());
        var shippingPrice = parseFloat($('#shippingPrice').val());
        if ($(this).prop('checked') == true) {
            if (additionalPrice == 0 || additionalPrice == 7) {
                additionalPrice += 3;
            } else {
                additionalPrice = 3;
            }
        } else {
            if (additionalPrice == 3 || additionalPrice == 10) {
                additionalPrice = additionalPrice - 3;
            }
        }
        $('#additionalPrice').val(additionalPrice)
        $('#thePrice').text(price + additionalPrice + shippingPrice);
    });

    $('#shipping_city').change(function () {
        var price = parseFloat($('#price').val());
        var additionalPrice = parseFloat($('#additionalPrice').val());
        var shippingPrice = 0;
        var value = $(this).val();
        switch (value) {
            case '1':
                shippingPrice += 0;
                break;
            case '2':
            case '3':
            case '6':
                shippingPrice += 5;
                break;
            case '4':
            case '7':
            case '8':
                shippingPrice += 10;
                break;
            case '5':
                shippingPrice += 15;
                break;
        }
        var nowDate = new Date();
        if ($('#shipping_time').val() == '1' || $('#shipping_time').val() == '4' || nowDate.getDay() > 4) {
            shippingPrice += 5;
            if (value == '8') {
                shippingPrice += 5;
            }
        }
        if ($('#shipping_time').val() == '5') {
            var timeFromH = parseInt($('#exact_interval_from_h').val());
            if ((timeFromH >= 7 && timeFromH < 8) || timeFromH >= 18) {
                shippingPrice += 5;
                if (value == '8') {
                    shippingPrice += 5;
                }
            }
        }
        $('#shippingPrice').val(shippingPrice);
        $('#thePrice').text(price + additionalPrice + shippingPrice);
    });
    
    $('#shipping_time').change();
    $('#shipping_city').change();

    $('#shipping_date_day, #shipping_date_month, #shipping_date_year, #exact_interval_from_h, '+
            '#exact_interval_from_m, #exact_interval_till_h, #exact_interval_till_m, ').change(function () {
        $('#shipping_city').change();
        checkDate();
    });
    
    var messages = {
        lv : {
            0: 'Šāds datums jau ir pagājis!',
            1: 'Intervals jau ir pagatnē!',
            2: 'Šo intervalu vairs nevar izvēlēties!',
            3: 'Piegāde ir iespējama ne atrāk ka divas stundas pēc pasūtījuma noformēšanas!',
            4: 'Izējamās dienās piegāde ārpus Rīgas rajona netiek piedāvāta!',
            5: 'Lauks "Precīza adrese" jābūt aizpildīts!',
            6: 'Intervāls nevar būt mazāks par vienu stundu!'
        },
        ru : {
            0: 'Эта дата уже в прошлом!',
            1: 'Интервал уже в прошлом!',
            2: 'Этот интервал уже нельзя выбрать!',
            3: 'Доставка возможна только через два часа после оформления заказа!',
            4: 'Доставка вне Рижского района на выходных не осуществляется!',
            5: 'Поле "Точный адрес" обязательно для заполнения!',
            6: 'Интервал не может быть менее одного часа!'
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
            if (timeTillH < timeFromH) {
                messageAlert(6);
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
        } else {
            if (timeTillH <= timeFromH) {
                messageAlert(6);
                return false;
            }
        }
        return true;
    }

});