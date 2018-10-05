$(document).ready(function() {
    if (typeof YOUTUBE_VIDEO_MARGIN == "undefined") {
        YOUTUBE_VIDEO_MARGIN = 5;
    }
    $("iframe").each(function(index, item) {
        if ($(item).attr("src").match(/(https?:)?\/\/www\.youtube\.com/)) {
            var w = $(item).attr("width");
            var h = $(item).attr("height");
            var ar = h / w * 100;
            ar = ar.toFixed(2);
            $(item).css("position", "absolute");
            $(item).css("top", "0");
            $(item).css("left", "0");
            $(item).css("width", "100%");
            $(item).css("height", "100%");
            $(item).css("max-width", w + "px");
            $(item).css("max-height", h + "px");
            $(item).wrap('<div style="max-width:' + w + 'px" />');
            $(item).wrap('<div style="padding-bottom:' + ar + '%" />');
        }
    });
});