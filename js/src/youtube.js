// Deferred video loading
// https://scottdeluzio.com/defer-parsing-javascript-youtube-videos/
window.onload = function() {
    $("iframe").each(function(index, item) {
        if ($(item).attr("data-src").match(/(https?:)?\/\/www\.youtube(-nocookie)?\.com/) ||
            $(item).attr("data-src").match(/(https?:)?\/\/www\.facebook?\.com/)) {
            $(item).attr('src', $(item).attr('data-src'));
        }
    });
};
