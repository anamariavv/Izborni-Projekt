//remove the password change fields after successful password change
$(document).ready(function() {

    $("#change_pass").click(function(){
            $("<form id='passwordform'></form>")
                .appendTo("#passdiv");  
            $("<input type='password'><br>")
                .attr("id", "pwd1")
                .attr("name", "pwd1")
                .attr("placeholder", "Enter Password")
                .appendTo("#passwordform");  
            $("<input type='password'><br>")
                .attr("id", "pwd2")
                .attr("name", "pwd2")
                .attr("placeholder", "Repeat Password")
                .appendTo("#passwordform");
            $("<input type='submit'> value='submit' ")
                .attr("id", "changepasssubmit")
                .attr("name", "changepasssubmit")
                .on("click", function validate_password() {
                    jQuery.validator.addMethod("password_val", function (value) {
                        if (/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/.test(value)) {
                            return true;
                        } else {
                            return false;
                        };
                    }, "Please enter a valid password");
                    $("#passwordform").validate({
                        rules: {
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
                        submitHandler: function(form, e) {
                            e.preventDefault();
                            var password = $("#pwd1").val();
                            $.ajax({
                                type: "POST",
                                url: "include/change_password.inc.php",
                                cache: false,
                                dataType: "json",
                                data: {pass: password},
                                success: function(data) {
                                    $("#passresult").text("Password successfully changed!");
                                },
                                error: function(data) {
                                    $("#passresult").text("An error occured: " + data);
                                }
                            });                           
                        }
                    });                
                },
                )
                .appendTo("#passwordform"); 
            $("<button type='button'>Cancel</button>")
                .attr("id", "cancel")
                .on("click", function() {
                    $("#pwd1").remove();
                    $("#pwd2").remove();
                    $("#changepasssubmit").remove();
                    $("#change_pass").attr("disabled", false); 
                    $("#cancel").remove();
                    $("#passwordform").remove();
                })
                .appendTo("#passwordform");  
            $("#change_pass").attr("disabled", true);   
    });
});
