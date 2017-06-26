
    $(document).ready(function () {
        $("#dialog-confirm").dialog({
            autoOpen: false,
            resizable: false,
                height: "auto",
                width: 400,
                modal: true
        });
    });
    
    
        $(".deleteButton").click(function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr("href");
        var project = $(this).attr("data-message");
        
        $("#dialog-confirm").html('<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Přejete si trvale odstranit projekt<br>'+project+'?');
        $("#dialog-confirm").dialog({
            buttons: {
                    "Odstranit": function () {
                        window.location.href = targetUrl;
                    },
                    "Zrušit": function () {
                        $(this).dialog("close");
                    }
                }
        });
        $("#dialog-confirm").dialog("open");
    });



   
