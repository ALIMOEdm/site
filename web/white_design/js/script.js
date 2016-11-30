$(document).ready(function(){

});
$(document).ready(function () {
    /**
     * Crap too long texts for news preview
     */
    $(".js-main-news-description").dotdotdot({
        ellipsis: '... '
    });
    showCurrencyRate();
    showWeatherForecast();
    showCurrentData();
    showCelebrate();
    digitalWatch();
    removeInternalRefsFromParsedText();

    $('[data-role="news-image"]').each(function (index, elem) {
        var url = $(elem).data('url');
        $(elem).css('background-image', 'url('+url+')');
    });

    $('[data-role="group-image"], [data-role="full-news-image"], [data-role="any-image"]').each(function (index, elem) {
        var url = $(elem).data('url');
        var img = document.createElement('img');
        img.src = url;
        if($(elem).data('height')){
            img.setAttribute('height', $(elem).data('height'));
        }
        if($(elem).data('width')){
            img.setAttribute('width', $(elem).data('width'));
        }
        if($(elem).data('alt')){
            img.setAttribute('alt', $(elem).data('alt'));
        }
        $(elem).append(img);
    });

    // Top mail ru
    var _tmr = window._tmr || (window._tmr = []);
    _tmr.push({id: "2767489", type: "pageView", start: (new Date()).getTime()});
    (function (d, w, id) {
        if (d.getElementById(id)) return;
        var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
        ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
        var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
        if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
    })(document, window, "topmailru-code");
    ///

    //Live internet

    $('[data-role="live-internet"]').html("<a href='//www.liveinternet.ru/click' "+
    "target=_blank><img src='//counter.yadro.ru/hit?t27.6;r"+
    escape(document.referrer)+((typeof(screen)=="undefined")?"":
    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
    ";"+Math.random()+
    "' alt='' title='LiveInternet: показано количество просмотров и"+
    " посетителей' "+
    "border='0' width='88' height='120'><\/a>");
    //////
});

function getCurrencyRate(){
    var d = $.Deferred();
    $.ajax({
        type: 'post',
        url: routes['currency_rate'],
        success: function(data){
            d.resolve(data);
        }
    });

    return d
}

/**
 * show currency rate
 */
function showCurrencyRate(){
    getCurrencyRate().then(function (data) {
        var res = data.data;
        for(key in res){
            var str = res[key];
            if(key == 'EUR'){
                $('.js-eur').html(str);
            }else if(key == 'USD'){
                $('.js-usd').html(str);
            }
        }
    });
}

function getWeatherForecast(){
    var d = $.Deferred();
    $.ajax({
        type: 'post',
        url: routes['currency_weather_forecast'],
        success: function(data){
            d.resolve(data);
        }
    });
    return d;
}

/**
 * Show weather forecast
 */
function showWeatherForecast(){
    getWeatherForecast().then(function (data) {
        if(data.success === true){
            var res = data.data;
            var temperature = +res['temperature'];
            temperature = Math.round(temperature);
            if(temperature > 0){
                temperature = '+'+temperature;
            }
            $('.js-temperature').html(temperature+'<span class="light">°C</span>');

            var wind = Math.round(+res['wind_speed']);
            $('.js-wind').html(wind+'<span class="light">м/с</span>');

            var humidity = Math.round(+res['humidity']);
            $('.js-humidity').html(humidity+'<span class="light">%</span>');

            var visibility = Math.round(+res['visibility']);
            $('.js-visibility').html(visibility+'<span class="light">м</span>');
        }
    })
}

function getCelebrate()
{
    var d = $.Deferred();
    $.ajax({
        type: 'post',
        url: routes['get_celebrate'],
        success: function(data){
            d.resolve(data);
        }
    });
    return d;
}

function showCelebrate(){
    getCelebrate().then(function (data) {
        if (data.success === true) {
            $('.js-celebration').html(data.data.celebrate);
        }
    });
}

function digitalWatch() {
    var date = new Date();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    if (hours < 10) hours = "0" + hours;
    if (minutes < 10) minutes = "0" + minutes;
    if (seconds < 10) seconds = "0" + seconds;
    document.querySelector('.js-time').innerHTML = hours + ":" + minutes + ":" + seconds;
    setTimeout(digitalWatch, 1000);
}

/**
 * Get formatted data
 * @returns {Date}
 */
function getCurrentFormattedData(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }
    today = dd+'.'+mm+'.'+yyyy+'г.';
    return today;
}

/**
 * Show current data on a page
 */
function showCurrentData(){
    $('.js-day').html(getCurrentFormattedData());
}




function removeInternalRefsFromParsedText(){
    /**
     * remove links to internal resources other sites
     */
    $('.one-news-main-content').find('[href^="/"]').each(function () {
        $(this).replaceWith('<span>'+$(this).html()+'</span>')
    });

    /**
     * remove empty elements
     */
    $('.one-news-main-content div, .one-news-main-content  p').each(function () {
        if(!$(this).html().trim().replace(/&nbsp;/, '').length){
            $(this).remove();
        }
    })
}

$(document).on('click', '[data-role="apply-filters"]', function(){
    $('#search-form').submit();
});

$(document).on('click', '[data-role="apply-group-filter"]', function(){
    //$('#search-form').submit();
    var magnificPopup = $.magnificPopup.instance; // save instance in magnificPopup variable
    magnificPopup.close();
    $('#search-form').submit();
});