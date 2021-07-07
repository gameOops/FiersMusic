let isPlay = 0;
let songs = {};
let curSong = 0;
function play() {
    if(isPlay == 0) {
        $('#audioplayer').trigger("play");
        $('#play_btn').removeAttr('class');
        $('#play_btn').attr('class','bi bi-pause-circle-fill')
        isPlay = 1;
    } else {
        $('#audioplayer').trigger("pause");
        $('#play_btn').removeAttr('class');
        $('#play_btn').attr('class','bi bi-play-circle-fill')
        isPlay = 0;
    }
}
setInterval(function() {
    $('#audio_line').val(document.getElementById('audioplayer').currentTime)
    $('#audio_line').attr('max',document.getElementById('audioplayer').duration);
    if (document.getElementById('audioplayer').duration == document.getElementById('audioplayer').currentTime) {
        curSong++;
        setSong(songs[curSong])
        $('#audioplayer').trigger("play");
    }
    $('#cur_t').text(fancyTimeFormat(document.getElementById('audioplayer').currentTime));
    $('#dur_t').text(fancyTimeFormat(document.getElementById('audioplayer').duration));
    getColor()
},1000);
function setSong (song) {
    $('#cur_name').text(song.name);
    $('#cur_auth').text(song.author);
    $('#audioplayer').attr('src','/audio/'+song.src);
}

setTimeout(function() {
    setSong(songs[curSong])
},1000)

function getColor() {
    var
        fac = new FastAverageColor(),
        container = document.querySelector('.album_img'),
        color = fac.getColor(container.querySelector('img'));
    console.log(color['hex']);
    $('.content').css('background','linear-gradient(180deg, '+color["hex"]+' 0%, rgba(0,0,0,1) 39%, rgba(0,0,0,1) 100%)');
}
function fancyTimeFormat(time)
{
    var hrs = ~~(time / 3600);
    var mins = ~~((time % 3600) / 60);
    var secs = ~~time % 60;
    var ret = "";

    if (hrs > 0) {
        ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
    }

    ret += "" + mins + ":" + (secs < 10 ? "0" : "");
    ret += "" + secs;
    return ret;
}
var Visible = function (target) {
    var targetPosition = {
            top: window.pageYOffset + target.getBoundingClientRect().top,
            left: window.pageXOffset + target.getBoundingClientRect().left,
            right: window.pageXOffset + target.getBoundingClientRect().right,
            bottom: window.pageYOffset + target.getBoundingClientRect().bottom
        },
        windowPosition = {
            top: window.pageYOffset,
            left: window.pageXOffset,
            right: window.pageXOffset + document.documentElement.clientWidth,
            bottom: window.pageYOffset + document.documentElement.clientHeight
        };

    if (targetPosition.bottom > windowPosition.top && // Если позиция нижней части элемента больше позиции верхней чайти окна, то элемент виден сверху
        targetPosition.top < windowPosition.bottom && // Если позиция верхней части элемента меньше позиции нижней чайти окна, то элемент виден снизу
        targetPosition.right > windowPosition.left && // Если позиция правой стороны элемента больше позиции левой части окна, то элемент виден слева
        targetPosition.left < windowPosition.right) { // Если позиция левой стороны элемента меньше позиции правой чайти окна, то элемент виден справа

        return 'true';
    } else {
        return 'false';

    };
};
function setCookie(name, value, options = {}) {

    options = {
        path: '/',
        // при необходимости добавьте другие значения по умолчанию
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
let mn = 0;
function menu() {
    if (mn == 0) {
        $('#profile_menu').show();
        mn = 1;
    } else {
        $('#profile_menu').hide();
        mn = 0;
    }

}
function deleteCookie(name) {
    setCookie(name, "", {
        'max-age': -1
    })
}
function getColor2() {
    var
        fac = new FastAverageColor(),
        container = document.querySelector('.artist_img'),
        color = fac.getColor(container.querySelector('img'));
    console.log(color['hex']);
    $('.artist_bg').css('background-color',color['hex']);
}
