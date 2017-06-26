$(function () {
    $(".detail-toggle").hide();

    $("td.detail-control").click(function () {
        $(this).parent().next("tr.detail-toggle").slideToggle(0);

        if($(this).parent().hasClass("shown")) {
            $(this).parent().removeClass("shown");
        } else {
            $(this).parent().addClass("shown");
        }
    });

});

