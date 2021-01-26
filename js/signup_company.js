$(document).ready(function() {
    jQuery.validator.addMethod("password_val", function (value) {
        if (/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Please enter a valid password");
    $("form[name='c_signupform']").validate({
      rules: {
        cname: "required",
        city: "required",
        address: "required",
        postal: {
            required: true,
            digits: true
        },
        phone: {
            required: true,
            digits: true
        },
        email: {
          required: true,
          email: true
        },
        field: "required",
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
      messages: {
        postal: {
            required: "Please enter a valid postal code"
        },
        phone: {
            required: "Please enter a valid phone number",
        },
        pwd1: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long",
            maxlength: "Your password cannot be longer than 32 characters"
        },
        pwd2: {
            required: "Please confirm your password",
            equalTo: "Passwords must match!"
        },
      }, 
      submitHandler: function(form) {
        form.submit();
      }
    });
  });