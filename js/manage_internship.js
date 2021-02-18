$(document).ready(function(){
    $("#delete_internship").click(function() {
        if(confirm("Are you sure you want to delete this internship?")) {
            //when deleting internship->notify all candidates and then remove them from applied list (insert notifications table into database)
        }
    })
    $("#close_internship").click(function() {
        //when closing internship->notify eliminated candidates and remove them from applied list
    })
    $("#show_candidates").click(function() {
        //display all candidates as links
    })
    $("#edit_internship").click(function() {
        //switch from table to form
        $(this).attr("disabled", true);

        var $div_element = document.getElementById("information_div");
        var $old_html = $div_element.innerHTML;
       
        //get information from table to variables
        var $old_id = $("#id").html();
        var $position = $("#position").html();
        var $city = $("#city").html();
        var $description = $("#description").html();
        var $requirements = $("#requirements").html();
        var $salary = $("#salary").html();
        var $deadline = $("#deadline").html();
        
        $div_element.innerHTML = "";

        
        //create form
        var $new_form = document.createElement("form");
        $new_form.setAttribute("id", "edit_internship_form");
       
        var $new_input_1 = document.createElement("input");
        var $new_input_2 = document.createElement("input");
        var $new_input_3 = document.createElement("textarea");
        var $new_input_4 = document.createElement("input");
        var $new_input_5 = document.createElement("textarea");
        var $new_input_6 = document.createElement("input");
        var $new_input_7 = document.createElement("input");
        var $new_input_8 = document.createElement("input");

        $new_input_1.setAttribute("id", "id_new");
        $new_input_1.setAttribute("name", "id");
        $new_input_1.setAttribute("value", $old_id);
        $new_input_1.setAttribute("type", "text");
        $new_input_2.setAttribute("id", "position_new");
        $new_input_2.setAttribute("name", "position");
        $new_input_2.setAttribute("value", $position);
        $new_input_2.setAttribute("type", "text");
        $new_input_3.setAttribute("id", "description_new");
        $new_input_3.setAttribute("name", "description");
        $new_input_3.innerHTML = $description;
        $new_input_3.setAttribute("form", "new_internship_form");
        $new_input_4.setAttribute("id", "city_new");
        $new_input_4.setAttribute("name", "city");
        $new_input_4.setAttribute("value", $city);
        $new_input_4.setAttribute("type", "text");
        $new_input_5.setAttribute("id", "requirements_new");
        $new_input_5.setAttribute("name", "requirements");
        $new_input_5.innerHTML = $requirements;
        $new_input_5.setAttribute("form", "new_internship_form");
        $new_input_6.setAttribute("id", "salary_new");
        $new_input_6.setAttribute("name", "salary");
        $new_input_6.setAttribute("value", $salary);
        $new_input_6.setAttribute("type", "number");
        $new_input_7.setAttribute("id", "deadline_new");
        $new_input_7.setAttribute("name", "deadline");
        $new_input_7.setAttribute("value", $deadline);
        $new_input_7.setAttribute("type", "date");
        

        //get new data
        var $data_array = {
            old_id: JSON.stringify($old_id),
            id: JSON.stringify($("#id_new").val()),
            position: JSON.stringify($("#position_new").val()),
            city: JSON.stringify($("#city_new").val()),
            desc: JSON.stringify($("#description_new").val()),
            req: JSON.stringify($("#requirements_new").val()),
            salary: JSON.stringify($("#salary_new").val()),
            deadline: JSON.stringify($("#deadline_new").val())
        }

        //modify submit button
        $new_input_8.setAttribute("type", "submit");
        $new_input_8.setAttribute("id", "edit_submit");
        $new_input_8.onclick = function() {
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
                submitHandler: function() {
                    $.ajax({
                        type: "POST",
                        url: "include/edit_internship.inc.php",
                        dataType: "json",
                        data: $data_array,
                        success: function(data) {
                            $("#edit_internship").attr("disabled", false);
                            $new_form.remove();
                            $div_element.innerHTML = $old_html;
                            $(this).remove();
                        },
                        error: function(data) {
                            alert("An error occured: " + data);
                        }
                    })
                }
            })
        }

        $new_form.appendChild($new_input_1);
        $new_form.appendChild($new_input_2);
        $new_form.appendChild($new_input_3);
        $new_form.appendChild($new_input_4);
        $new_form.appendChild($new_input_5);
        $new_form.appendChild($new_input_6);
        $new_form.appendChild($new_input_7);
        $new_form.appendChild($new_input_8);

        $div_element.appendChild($new_form);
        


        //create cancel button
        var $new_cancel_button = document.createElement("button");
        $new_cancel_button.setAttribute("id", "cancel_edit_internship");
        $new_cancel_button.innerText = "Cancel Edit";
        $div_element.appendChild($new_cancel_button);
        $new_cancel_button.onclick = function delete_form() {
            $("#edit_internship").attr("disabled", false);
            $new_form.remove();
            $div_element.innerHTML = $old_html;
            $(this).remove();
        }
        

    })
});