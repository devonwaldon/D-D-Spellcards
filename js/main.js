/*global jQuery */

(function( $ ){

  $(document).ready(function(){

    // Fit title text to width
    $(".title h1").fitText();

    // File input styling
    $('input[type="file"]').each(function(){
      $(this).on('change', function(){
        var label = $(this).next('label');
        var filename = $('input[type=file]').val().split('\\').pop();

        if (filename === '') {
          filename = 'Choose File';
        }
        label.text(filename);

      });
    });

  });

})( jQuery );