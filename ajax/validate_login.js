$(function(){
    $("#entry").click(function() {
        $.ajax({
            type: "GET",
            url: "index.php?page=login",
            dataType: "html",
            success: function(data) {
                $("#loginform").html(data);
            },
            error: function(xhr) {
                alert(xhr.status);
            }     
        });
        $(this).hide();
    });
});