$(document).ready(function() {
    jQuery.validator.addMethod("password_val", function (value) {
        if (/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Please enter a valid password");
    $("#administrator_form").validate({
        rules: {
          firstname: "required",
          lastname: "required",
          email: {
            required: true,
            email: true
          },
          password: {
            password_val: true,
            required: true,
            minlength: 8,
            maxlength: 32
          },
          password_check: {
              required: true,
              equalTo: "#password"
          },
        },
        messages: {
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long",
            maxlength: "Your password cannot be longer than 32 characters"
          },
          password_check: {
            required: "Please confirm your password",
            equalTo: "Passwords must match!"
          }
        }, 
         // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
          form.submit();
        }
      });
})