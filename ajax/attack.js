$(".attack").submit(function(e) {
    e.preventDefault();
    $(this).find('input[name=submit]').disabled=true;
    $.ajax({
        type: "POST",
        url: "index.php?action=attack",
        data: {
                decide: $(this).find('#decide').val(),
                monster_id: $(this).find('#monster_id').val(),
              },      
        success: function(data) {
            $("body").html(data);
        },
        error: function(xhr) {
            console.log(xhr);
        }     
    });
});