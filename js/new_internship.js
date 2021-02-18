$(document).ready(function(){
    $("#new_internship").click(function() {
        $(this).attr("disabled", true);

        //create the form
        var $div_element = document.getElementById("create_new");
        var $new_form = document.createElement("form");
        $new_form.setAttribute("id", "new_internship_form");

        //create input elements
        var $new_input_1 = document.createElement("input");
        var $new_input_2 = document.createElement("input");
        var $new_input_3 = document.createElement("textarea");
        var $new_input_4 = document.createElement("input");
        var $new_input_5 = document.createElement("textarea");
        var $new_input_6 = document.createElement("input");
        var $new_input_7 = document.createElement("input");
        var $new_input_8 = document.createElement("input");
        $new_input_1.setAttribute("id", "id");
        $new_input_1.setAttribute("name", "id");
        $new_input_1.setAttribute("placeholder", "Internship ID");
        $new_input_1.setAttribute("type", "text");
        $new_input_2.setAttribute("id", "position");
        $new_input_2.setAttribute("name", "position");
        $new_input_2.setAttribute("placeholder", "Work position name");
        $new_input_2.setAttribute("type", "text");
        $new_input_3.setAttribute("id", "description");
        $new_input_3.setAttribute("name", "description");
        $new_input_3.setAttribute("placeholder", "Work Description");
        $new_input_3.setAttribute("form", "new_internship_form");
        $new_input_4.setAttribute("id", "city");
        $new_input_4.setAttribute("name", "city");
        $new_input_4.setAttribute("placeholder", "City");
        $new_input_4.setAttribute("type", "text");
        $new_input_5.setAttribute("id", "requirements");
        $new_input_5.setAttribute("name", "requirements");
        $new_input_5.setAttribute("placeholder", "Requirements");
        $new_input_5.setAttribute("form", "new_internship_form");
        $new_input_6.setAttribute("id", "salary");
        $new_input_6.setAttribute("name", "salary");
        $new_input_6.setAttribute("placeholder", "Monthly Salary");
        $new_input_6.setAttribute("type", "number");
        $new_input_7.setAttribute("id", "deadline");
        $new_input_7.setAttribute("name", "deadline");
        $new_input_7.setAttribute("type", "date");

        //modify the submit button to validate all fields
        $new_input_8.setAttribute("id", "new_internship_submit");
        $new_input_8.setAttribute("type", "submit");
        $new_input_8.onclick = function(e) {
            $($new_form).validate({
                rules: {
                    id: "required",
                    position: "required",
                    description: "required",
                    city: "required",
                    requirements: "required",
                    salary: "required",
                    deadline: "required"
                },
                messages: {
                    id: {
                        required: "This field is required! Please enter the internship ID as country-year-city-number"
                    },
                    position: {
                        required: "This field is required! Please enter the name of the work position"
                    },
                    description: {
                        required: "This field is required! Please provide a description for the position"
                    },
                    city: {
                        required: "This field is required!"
                    },
                    Requirements: {
                        required: "This field is required!"
                    },
                    salary: {
                        required: "This field is required! Please provide monthly gross pay"
                    },    
                    deadline: {
                        required: "This field is required! Please provide application deadline"
                    }     
                },
                submitHandler: function() {
                    var $data_array = {id : JSON.stringify($("#id").val()), position : JSON.stringify($("#position").val()), desc : JSON.stringify($("#description").val()),
                                        city : JSON.stringify($("#city").val()), requirements : JSON.stringify($("#requirements").val()), salary : JSON.stringify($("#salary").val()), deadline : JSON.stringify($("#deadline").val())};
                   $.ajax({
                        type: "POST",
                        url: "include/add_internship.inc.php",
                        dataType: "json",
                        data: $data_array,
                        success: function() {
                            alert("Internship created successfully!");
                            $("#new_internship_form").remove();
                            $("#cancel_new_internship").remove();
                            $("#new_internship").attr("disabled", false);
                        },
                        error: function(data) {
                            alert("An error occured: " + data);
                        }
                   })
                }
           })
        }

        //append input to form
        $new_form.appendChild($new_input_1);
        $new_form.appendChild($new_input_2);
        $new_form.appendChild($new_input_3);
        $new_form.appendChild($new_input_4);
        $new_form.appendChild($new_input_5);
        $new_form.appendChild($new_input_6);
        $new_form.appendChild($new_input_7);
        $new_form.appendChild($new_input_8);

        //append form to div
        $div_element.appendChild($new_form);

        //create cancel button and append to div
        var $new_cancel = document.createElement("button");
        $div_element.appendChild($new_cancel);
        $new_cancel.setAttribute("id", "cancel_new_internship");
        $new_cancel.innerText = "Cancel";
        $new_cancel.onclick = function delete_form() {
            $new_form.remove();
            $("#new_internship").attr("disabled", false);
            $(this).remove();
        }  
                
    })
})