$(".delete_prop").submit(function(e) {
    e.preventDefault();
    $(this).find('input[name=submit]').val('處理中');
    $(this).find('input[name=submit]').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: "index.php?action=delete_prop",
        data: {
                prop: $(this).find('#prop').val(),
              },
                
        success: function(data) {
            $("body").html(data);
        },
        error: function(xhr) {
            console.log(xhr);
        }     
    });
});