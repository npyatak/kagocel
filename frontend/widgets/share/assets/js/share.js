$(document).on('click', 'a.share', function(e) {
    if(typeof $(this).data('event') !== 'undefined') {
        ga('send', 'event', $(this).data('event'), $(this).data('param'));
    }
    
    url = getShareUrl($(this));
    window.open(url,'','toolbar=0,status=0,width=626,height=436');

    return false;
});

function getShareUrl(obj) {
    if(obj.data('soc') == 'vk') {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(obj.data('url'));
        url += '&title='       + encodeURIComponent(obj.data('title'));
        url += '&text='        + encodeURIComponent(obj.data('text'));
        url += '&image='       + encodeURIComponent(obj.data('image'));
        url += '&noparse=true';
    } else if(obj.data('soc') == 'fb') {
        url = 'https://www.facebook.com/sharer/sharer.php?';
        url += 'u=' + encodeURIComponent(obj.data('url'));
        url += '&title='     + encodeURIComponent(obj.data('title'));
        url += '&scrape=true';
    } else if(obj.data('soc') == 'ok') {
        url  = 'https://connect.ok.ru/offer';
        url += '?url=' + encodeURIComponent(obj.data('url'));
        url += '&title=' + encodeURIComponent(obj.data('title'));
        url += '&text=' + encodeURIComponent(obj.data('text'));
        url += '&imageUrl=' + encodeURIComponent(obj.data('image'));
    } else if(obj.data('soc') == 'tw') {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(obj.data('title'));
        url += '&url='      + encodeURIComponent(obj.data('url'));
        url += '&counturl=' + encodeURIComponent(obj.data('url'));
    } else if(obj.data('soc') == 'tg') {
        url  = 'https://telegram.me/share/url?';
        url += 'text='      + encodeURIComponent(obj.data('title'));
        url += '&url='      + encodeURIComponent(obj.data('url'));
        url += '&counturl=' + encodeURIComponent(obj.data('url'));
    }

    return url;
}