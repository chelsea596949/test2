$(".accept_mission").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "index.php?action=accept_mission",
        data: {
                mission: $(this).find('#mission').val(),
              },
                
        success: function(data) {
            $("body").html(data);
        },
        error: function(xhr) {
            console.log(xhr);
        }     
    });
});