$(document).ready(function() {
    $("#messageform").validate({
        rules: {
            message_text: "required",
        }, 
         // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
          form.submit();
        }
      });
})