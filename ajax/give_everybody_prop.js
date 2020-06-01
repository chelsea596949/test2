$("#give_everybody_prop").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "index.php?action=giveprops",
        data: {CSRFName: $("#CSRFName").val(),
               CSRFToken: $("#CSRFToken").val()},
        success: function(data) {
            $("body").html(data);
        },
        error: function(xhr) {
            console.log(xhr);
        }     
    });
});
$("#give_sb_prop").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "index.php?action=givesbprops",
        data: {
                CSRFName: $("#CSRFName").val(),
                CSRFToken: $("#CSRFToken").val(),
                member: $("#member").val(),
                props: $("#props").val(),
                quantity: $("#quantity").val(),
              },
                
        success: function(data) {
            $("body").html(data);
        },
        error: function(xhr) {
            console.log(xhr);
        }     
    });
});