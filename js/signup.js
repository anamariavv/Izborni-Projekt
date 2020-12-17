$(document).ready(function() {
    jQuery.validator.addMethod("password_val", function (value, element) {
        if (/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Please enter a valid password");
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='signupform']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        firstname: "required",
        lastname: "required",
        oib: {
          required: true,
          digits: true
        },
        age : {
          required: true,
          digits: true
        },
        email: {
          required: true,
          email: true
        },
        city: "required",
        university: "required",
        pwd1: {
          password_val: true,
          required: true,
          minlength: 8,
          maxlength: 32
        },
        pwd2: {
            required: true,
            equalTo: "#pwd1"
        },
      },
      // Specify validation error messages
      messages: {
        oib: {
          required: "Please enter a valid OIB"
        },
        age: {
          required: "Please enter a valid age"
        },
        pwd1: {
          required: "Please provide a password",
          minlength: "Your password must be at least 8 characters long",
          maxlength: "Your password cannot be longer than 32 characters"
        },
        pwd2: {
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
  });
