window.onload = function() {
    $("iframe").each(function(index, item) {
        if ($(item).attr("data-src").match(/(https?:)?\/\/www\.youtube(-nocookie)?\.com/) ||
            $(item).attr("data-src").match(/(https?:)?\/\/www\.facebook)?\.com/)) {
            $(item).attr('src', $(item).attr('data-src'));
        }
    });
};

$(document).ready(function() {
    $("iframe").each(function(index, item) {
        if ($(item).attr("data-src").match(/(https?:)?\/\/www\.youtube(-nocookie)?\.com/)) {
            var w = $(item).attr("width");
            var h = $(item).attr("height");
            var ar = h / w * 100;
            ar = ar.toFixed(2);
            $(item).css("max-width", w + "px");
            $(item).css("max-height", h + "px");
            $(item).wrap('<div style="max-width:' + w + 'px;height:100%"/>');
            $(item).wrap('<div style="padding-bottom:' + ar + '%"/>');
        }
    });
});
