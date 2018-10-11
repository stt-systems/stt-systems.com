$(document).ready(function() {
    var bMobile;
    function init() {
        bMobile = $(".navbar-toggle").is(":visible");
        var nTimer, oMenus = $("#navbar-collapse .dropdown"), oMenusA = $("#navbar-collapse .dropdown > a"), oSubMenusA = $("#navbar-collapse .dropdown-submenu > a");
        oMenus.off();
        oMenusA.off();
        oSubMenusA.off();
        if (bMobile) {
            oMenus.on({
                "click touchstart": function(e) {
                    e.stopPropagation();
                }
            });
            oMenusA.on({
                "click touchstart": function(e) {
                    oMenusA.parent().removeClass("open");
                    $(this).parent().addClass("open");
                }
            });
            oSubMenusA.on({
                "click touchstart": function(e) {
                    oSubMenusA.parent().removeClass("open");
                    $(this).parent().addClass("open");
                }
            });
        } else {
            oMenus.on({
                mouseenter: function(e) {
                    e.preventDefault();
                    clearTimeout(nTimer);
                    oMenus.removeClass("open");
                    $(this).addClass("open").slideDown();
                },
                mouseleave: function() {
                    nTimer = setTimeout(function() {
                        oMenus.removeClass("open");
                    }, 500);
                }
            });
        }
    }
    $(document).ready(function() {
        init();
    });
    $(window).resize(function() {
        init();
    });
});