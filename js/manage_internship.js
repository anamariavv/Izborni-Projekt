$(document).ready(function() {
    $("#delete_internship").click(function() {
        if(window.confirm("Are you sure you want to delete this internship? It will be removed completely and it won't appear in the archive")) {
            var students = [];
            var item = {};
            
            var $applicant_list = document.getElementById("applicants");
            if($applicant_list.rows.length == 0) {
                item["status"] = "empty";
                item["internship"] = document.getElementById("id").innerHTML;
                students.push(item);
            }
            for(var i = 0; i < $applicant_list.rows.length; i++) {
                var item = {};
                var $row = $applicant_list.rows[i];
                item["oib"] = $row.firstElementChild.innerHTML;
                item["internship"] = document.getElementById("id").innerHTML;
                students.push(item); 
            }

            $.ajax({
                type: "POST",
                url: "include/edit_internship.inc.php",
                data: {delete : students},
                dataType: "json",
                success: function() {
                    window.location = "internships.php";
                },
                error: function(response) {
                    console.log(response.error);
                }
            })
            
        }
    })
    $("#close_internship").click(function() {
        if(window.confirm("Are you sure you want to close the internship? This will automatically reject all pending applications")) {
            var students = [];
            var item = {};
            var $applicant_list = document.getElementById("applicants");
            if($applicant_list.rows.length == 0) {
                item["status"] = "empty";
                item["internship"] = document.getElementById("id").innerHTML;
                students.push(item);
            }
            for(var i = 0; i < $applicant_list.rows.length; i++) {
                var item = {};
                var $row = $applicant_list.rows[i];
                item["oib"] = $row.firstElementChild.innerHTML;
                item["internship"] = document.getElementById("id").innerHTML;
                students.push(item); 
            }

            $.ajax({
                type: "POST",
                url: "include/edit_internship.inc.php",
                data: {close : students},
                dataType: "json",
                success: function() {
                    window.location = "internships.php";
                },
                error: function(response) {
                    console.log(response.error);
                }
            })
            
        }
    })

    $("[name='reject']").click(function() {
        var rejection_data = [];
        item = {};
        item["internship"] = document.getElementById("id").innerHTML;
        item["oib"] = this.id;

        if(window.confirm("Are you sure you want to reject the student?")) {
            if((item["reason"] = prompt("Please provide a rejection reason for the student")) != null) {
                rejection_data.push(item)

                $.ajax({
                    type: "POST",
                    url: "include/acceptance.inc.php",
                    data: {reject : rejection_data},
                    dataType: "json",
                    success: function() {
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response.error);
                    }
                })
            }
        }

    })

    $("[name='accept']").click(function() {
        var acceptance_data = [];
        item = {};
        item["internship"] = document.getElementById("id").innerHTML;
        item["oib"] = this.id;
        acceptance_data.push(item)

        if(window.confirm("Are you sure you want to accept this student?")) {
            $.ajax({
                type: "POST",
                url: "include/acceptance.inc.php",
                data: {accept : acceptance_data},
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
    
    $("#edit_internship").click(function() {
        //switch from table to form
        
        var $edit_button_old = document.getElementById('edit_internship');
        var $close_button_old = document.getElementById('close_internship');
        var $delete_button_old = document.getElementById('delete_internship');
        $edit_button_old.remove();
        $close_button_old.remove();
        $delete_button_old.remove();

        var $div_element = document.getElementById("information_div");
        var $old_html = $div_element.innerHTML;
       
        //get information from table to variables
        var $old_id = $("#id").html();
        var $status =  $("#status").html();
        var $created = $("#created").html();
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
        $new_form.className += ' edit_form';
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
                    var data_array = new Object();
                    data_array["old_id"] = $old_id;
                    data_array["id"] = $("#id_new").val();
                    data_array["city"] = $("#city_new").val();
                    data_array["desc"] = $("#description_new").val();
                    data_array["req"] = $("#requirements_new").val();
                    data_array["salary"] = $("#salary_new").val();
                    data_array["deadline"] = $("#deadline_new").val();
                    data_array["position"] = $("#position_new").val();                    

                    $.ajax({
                        type: "POST",
                        url: "include/edit_internship.inc.php",
                        dataType: "json",
                        data: JSON.parse(JSON.stringify(data_array)),
                        success: function(data) {
                            location.reload();
                        },
                        error: function(data) {
                            alert("An error occured: " + data);
                        }
                    })
                }
            })
        }

        $break = document.createElement("br");
        var $text1 = document.createElement("div");
        $text1.className = ' input_div';
        var $text1_label = document.createElement('label');
        $text1_label.innerText = "Internship ID: ";
        $text1.appendChild($text1_label);
        $text1.appendChild($new_input_1)

        var $text2_label = document.createElement('label');
        $text2_label.innerText = "Position: ";
        $text1.appendChild($text2_label);
        $text1.appendChild($new_input_2);

        var $text2 = document.createElement("div");
        $text2.className = ' input_div';
        var $text3_label = document.createElement('label');
        $text3_label.innerText = "Job description: ";
        $text2.appendChild($text3_label);
        $text2.appendChild($new_input_3)

        var $text4_label = document.createElement('label');
        $text4_label.innerText = "City: ";
        $text2.appendChild($text4_label);
        $text2.appendChild($new_input_4);

        var $text3 = document.createElement("div");
        $text3.className = ' input_div';
        var $text5_label = document.createElement('label');
        $text5_label.innerText = "Requirements: ";
        $text3.appendChild($text5_label);
        $text3.appendChild($new_input_5)
        var $text6_label = document.createElement('label');
        $text6_label.innerText = "Salary: ";
        $text3.appendChild($text6_label);
        $text3.appendChild($new_input_6)

        var $text4 = document.createElement("div");
        $text4.className = ' input_div';
        var $text7_label = document.createElement('label');
        $text7_label.innerText = "Deadline: ";
        $text4.appendChild($text7_label);
        $text4.appendChild($new_input_7)
    
        $new_form.appendChild($text1);
        $new_form.appendChild($text2);
        $new_form.appendChild($text3);
        $new_form.appendChild($text4);
        $new_form.appendChild($break);
        $new_form.appendChild($new_input_8);

        $div_element.appendChild($new_form);
        
        //create cancel button
        var $new_cancel_button = document.createElement("button");
        $new_cancel_button.setAttribute("id", "cancel_edit_internship");
        $new_cancel_button.innerText = "Cancel Edit";
        $new_cancel_button.className = " cancel_edit";
        $new_form.appendChild($new_cancel_button);
        $new_cancel_button.onclick = function delete_form() {
            $new_form.remove();
            $div_element.innerHTML = $old_html;
            document.getElementById('internship_button_div').appendChild($edit_button_old);
            $("#edit_internship").attr("disabled", false);
            document.getElementById('internship_button_div').appendChild($close_button_old);
            document.getElementById('internship_button_div').appendChild($delete_button_old);
            $(this).remove();
        }
        

    })
});