// Deferred iframe loading
// https://scottdeluzio.com/defer-parsing-javascript-youtube-videos/
window.onload = function() {
    $("iframe").each(function(index, item) {
        $(item).attr('src', $(item).attr('data-src'));
    });
};
