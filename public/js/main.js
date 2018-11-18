
$(document).ready(function() {
   
    var text_max = 500;
    $('#textarea_feedback').html('<small>( ' +text_max + ' characters remaining)</small>');

    $('#review_text').keyup(function() {
        var text_length = $('#review_text').val().length;
        var text_remaining = text_max - text_length;
        if(text_remaining != 0){
            $('#textarea_feedback').html('<small>( ' +text_remaining + ' characters left)</small>');
        } else {
            $('#textarea_feedback').html('<small class="text-danger">( ' +text_remaining + ' characters left)</small>');
        } 
    });
});


