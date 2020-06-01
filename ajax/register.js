$(function(){
    $("#register").click(function() {
        $.ajax({
            type: "GET",
            url: "index.php?page=register",
            dataType: "html",
            success: function(data) {
                $("body").html(data);
                location.replace("index.php?page=register");
            },
            error: function(xhr) {
                alert(xhr.status);
            }     
        });
        $("#loginform").hide();
    });
});