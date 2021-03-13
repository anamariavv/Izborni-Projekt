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
        $(this).attr("disabled", true);

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
                            $("#edit_internship").attr("disabled", false);
                            $new_form.remove();
                            $new_table = document.createElement("table");
                            $new_table.setAttribute("id", "information_table");
                            $tr1 = document.createElement("tr");
                            $th1 = document.createElement("th");
                            $th1.setAttribute("colspan", "9");
                            $th1.innerText = "Internship information";
                            $tr2 = document.createElement("tr");
                            $th2 = document.createElement("th");
                            $th2.innerText = "ID";
                            $th3 = document.createElement("th");
                            $th3.innerText = "Date Created";
                            $th4 = document.createElement("th");
                            $th4.innerText = "Position";
                            $th5 = document.createElement("th");
                            $th5.innerText = "Work Description";
                            $th6 = document.createElement("th");
                            $th6.innerText = "City";
                            $th7 = document.createElement("th");
                            $th7.innerText = "Requirements";
                            $th8 = document.createElement("th");
                            $th8.innerText = "Status";
                            $th9 = document.createElement("th");
                            $th9.innerText = "Monthly Salary (Gross Pay)";
                            $th10 = document.createElement("th");
                            $th10.innerText = "Application Deadline";
                            $tr3 = document.createElement("tr");
                            $td1 = document.createElement("td");
                            $td1.setAttribute("id", "id");
                            $td1.innerText = data_array["id"];
                            $td2 = document.createElement("td");
                            $td2.setAttribute("id", "created");
                            $td2.innerText = $created;
                            $td3 = document.createElement("td");
                            $td3.setAttribute("id", "position");
                            $td3.innerText = data_array["position"];
                            $td4 = document.createElement("td");
                            $td4.setAttribute("id", "description");
                            $td4.innerText = data_array["desc"];
                            $td5 = document.createElement("td");
                            $td5.setAttribute("id", "city");
                            $td5.innerText = data_array["city"];
                            $td6 = document.createElement("td");
                            $td6.setAttribute("id", "requirements");
                            $td6.innerText = data_array["req"];
                            $td7 = document.createElement("td");
                            $td7.setAttribute("id", "status");
                            $td7.innerText = $status;
                            $td8 = document.createElement("td");
                            $td8.setAttribute("id", "salary");
                            $td8.innerText = data_array["salary"];
                            $td9 = document.createElement("td");
                            $td9.setAttribute("id", "deadline");
                            $td9.innerText = data_array["deadline"];
                            $new_table.appendChild($tr1);
                            $tr1.appendChild($th1);
                            $new_table.appendChild($tr2);
                            $tr2.appendChild($th2);
                            $tr2.appendChild($th3);
                            $tr2.appendChild($th4);
                            $tr2.appendChild($th5);
                            $tr2.appendChild($th6);
                            $tr2.appendChild($th7);
                            $tr2.appendChild($th8);
                            $tr2.appendChild($th9);
                            $tr2.appendChild($th10);
                            $tr3 = document.createElement("tr");
                            $tr3.appendChild($td1);
                            $tr3.appendChild($td2);
                            $tr3.appendChild($td3);
                            $tr3.appendChild($td4);
                            $tr3.appendChild($td5);
                            $tr3.appendChild($td6);
                            $tr3.appendChild($td7);
                            $tr3.appendChild($td8);
                            $tr3.appendChild($td9);
                            $new_table.appendChild($tr3);

                            $div_element.appendChild($new_table);
                            
                            $("#cancel_edit_internship").remove();
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