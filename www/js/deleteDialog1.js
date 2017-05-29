
    $(document).ready(function () {
        $("a[data-confirm]").live("click", function (e) {
 
            if(!confirm($(this).attr("data-confirm"))) {
                e.preventDefault();
                e.stopImmediatePropagation();
                return false;
            }
        });


    });



