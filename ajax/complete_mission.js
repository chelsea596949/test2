$(".complete_mission").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "index.php?action=complete_mission",
        data: {
                done: $(this).find('#done').val(),
              },
                
        success: function(data) {
            $("body").html(data);
        },
        error: function(xhr) {
            console.log(xhr);
        }     
    });
});