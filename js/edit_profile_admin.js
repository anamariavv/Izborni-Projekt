$(document).ready(function() {
    //get old values
    $("#edit_profile").click(function() {
        $(this).attr("disabled", true);
        var $div = document.getElementById("info_div");
        var $old_table = document.getElementById("information");
        var $fname = document.getElementById("fname").innerHTML;
        var $lname = document.getElementById("lname").innerHTML;
        var $email = document.getElementById("email").innerHTML;
        
        var $new_form = document.createElement("form");
        $new_form.setAttribute("id", "new_info_form");

        var $new_firstname = document.createElement("input");
        $new_firstname.setAttribute("type", "text");
        $new_firstname.setAttribute("name", "firstname");
        $new_firstname.setAttribute("id", "firstname");
        $new_firstname.setAttribute("value", $fname);

        var $new_lastname = document.createElement("input");
        $new_lastname.setAttribute("type", "text");
        $new_lastname.setAttribute("name", "lastname");
        $new_lastname.setAttribute("id", "lastname");
        $new_lastname.setAttribute("value", $lname);

        var $new_email = document.createElement("input");
        $new_email.setAttribute("type", "email");
        $new_email.setAttribute("name", "email");
        $new_email.setAttribute("id", "email");
        $new_email.setAttribute("value", $email);
        
        var $save_edit = document.createElement("input");
        $save_edit.setAttribute("type", "submit");
        $save_edit.setAttribute("value", "Save");
        $save_edit.setAttribute("id", "save_edit");
        $save_edit.onclick = function() {
            
            var data_array = [];
            data = {};
            data["firstname"] = $new_firstname.value;
            data["lastname"] = $new_lastname.value;
            data["email"] = $new_email.value;
            data_array.push(data);

            $("#new_info_form").validate({
                rules: {
                    firstname : "required",
                    lastname : "required",
                    email : {
                        required : true,
                        email : true
                    }
                },
                messages: {
                    firstname : {
                        required : "Please enter your first name"
                    },
                    lastname : {
                        required : "Please enter your last name"
                    },
                    email : {
                        required : "This field is required",
                        email : "Please enter a valid email address",
                    }
                }, 
                submitHandler: function(e) {
                    $.ajax({
                        type: "post",
                        url: "include/edit_profile_admin.inc.php",
                        data: {profile_data : data_array},
                        dataType: "json",
                        success: function() {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }                 
                    })
                }
        
            })
        }

        $div1 = document.createElement("div");
        $div1.className += " profile_admin_form_div";
        $text1 = document.createElement("label");
        $text1.innerText = "Firstname:";
        $div1.appendChild($text1);
        $div1.appendChild($new_firstname);
        $div2 = document.createElement("div");
        $div2.className += " profile_admin_form_div";
        $text2 = document.createElement("label");
        $text2.innerText = "Lastname:";
        $div2.appendChild($text2);
        $div2.appendChild($new_lastname);
        $div3 = document.createElement("div");
        $div3.className += " profile_admin_form_div";
        $text3 = document.createElement("label");
        $text3.innerText = "Email:";
        $div3.appendChild($text3);
        $div3.appendChild($new_email);

        $break = document.createElement("br");

        $old_table.remove();
        $new_form.appendChild($div1);
        $new_form.appendChild($div2);
        $new_form.appendChild($div3);
        $new_form.appendChild($break);
        $new_form.appendChild($save_edit);
        $div.appendChild($new_form);

        var $cancel_edit = document.createElement("button");
        $cancel_edit.setAttribute("type", "button");
        $cancel_edit.innerText = "Cancel";
        $cancel_edit.setAttribute("id", "cancel_edit");
        $cancel_edit.onclick = function() {
            $("#edit_profile").attr("disabled", false);
            $(this).remove();
            $new_form.remove();
            $div.appendChild($old_table);
        }        

        $new_form.appendChild($cancel_edit);
    });
    
})