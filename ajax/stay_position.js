$(function(){
    $("#change_password").submit(function() {
        location.replace("index.php?page=changepassword");
    });
    $("#change_name").submit(function() {
        location.replace("index.php?page=changename");
    });
    $("#monster").click(function() {
        location.replace("index.php?page=monster");
    });
});