$(document).ready(function() {
    //Title editing
   $("#edit_title").click(function() {
        $(this).attr("disabled", true);
        var $title_div = document.getElementById("title");
        var $old_title = document.getElementById("h1_title");
        var $title_form = document.createElement("form");
        $title_form.setAttribute("id", "title_form");
        var $input1 = document.createElement("input");
        var $input2 = document.createElement("input");
        $input1.setAttribute("id", "new_title_text");
        $input1.setAttribute("type", "text");
        $input1.setAttribute("value", $old_title.innerHTML);
        $input2.setAttribute("id", "title_submit");
        $input2.setAttribute("type", "submit");
        $input2.setAttribute("value", "Save");
        $input2.onclick = function save_title(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "include/edit_resume.inc.php",
                data: {title : $input1.value},
                dataType: "json",
                success: function(response) {
                    $old_title.innerHTML = $input1.value;
                    $title_form.remove();
                    $("#cancel_title_edit").remove();
                    $title_div.appendChild($old_title); 
                    $("#edit_title").attr("disabled",false);                  
                },
                error: function(response) {
                    console.log(response.error);
                }
            })
        }
        $cancel_title_edit = document.createElement("button");
        $cancel_title_edit.setAttribute("type", "button");
        $cancel_title_edit.setAttribute("id", "cancel_title_edit");
        $cancel_title_edit.innerHTML = "Cancel";
        $cancel_title_edit.onclick = function cancel_title_edit() {
            $("#edit_title").attr("disabled", false);
            $title_form.remove();
            $title_div.appendChild($old_title);
            $(this).remove();
        }        
        $title_form.append($input1);
        $title_form.append($input2);
        $old_title.remove();
        $title_div.appendChild($title_form);
        $title_div.appendChild($cancel_title_edit);
    })

    //Introduction editing
    $("#edit_intro").click(function() {
        $(this).attr("disabled", true);
        //get old values
        
        $old_intro = document.getElementById("intro");
        $old_intro_text = $old_intro.innerHTML;
        $old_intro.innerHTML = "";
        //create new form with input(textarea) and submit buttons
        var $intro_div = document.getElementById("intro");
        var $intro_form = document.createElement("form");
        $intro_form.setAttribute("id", "intro_form");
        var $textarea = document.createElement("textarea");
        $textarea.setAttribute("id", "new_intro");
        $textarea.setAttribute("form", "intro_form");
        $textarea.setAttribute("cols", "70");
        $textarea.setAttribute("rows", "10");
        $textarea.innerText = $old_intro_text;
        var $submit_new_intro = document.createElement("input");
        $submit_new_intro.setAttribute("type", "submit");
        $submit_new_intro.innerText = "Save";
        $submit_new_intro.onclick = function save_intro(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "include/edit_resume.inc.php",
                data: {intro : $textarea.value},
                dataType: "json",
                success: function(response) {
                    $("#edit_intro").attr("disabled", false);
                    $intro_form.remove();
                    $intro_div.innerHTML = $textarea.value;
                    $(this).remove();         
                },
                error: function(response) {
                    console.log(response.error);
                }
            })
        }
        //append new form to div
        $intro_form.appendChild($textarea);
        $intro_form.appendChild($submit_new_intro);
        $intro_div.appendChild($intro_form);
        //create and append cancel button
        $cancel_intro_edit = document.createElement("button");
        $cancel_intro_edit.setAttribute("type", "button");
        $cancel_intro_edit.setAttribute("id", "cancel_intro_edit");
        $cancel_intro_edit.innerText = "Cancel";
        $intro_div.appendChild($cancel_intro_edit);
        $cancel_intro_edit.onclick = function cancel_intro_edit() {
            $("#edit_intro").attr("disabled", false);
            $intro_form.remove();
            $intro_div.innerHTML = $old_intro_text;
            $(this).remove();
        }
    })

    //education editing
    $("#edit_education").click(function() {
        $(this).attr("disabled", true);
        //save old table in case of cancel
        var $education_div = document.getElementById("education");
        var $education_table = document.getElementById("education_table");
       
        //turn table into form with exisitng rows as inputs and submit button
        var $education_form = document.createElement("form");
        $education_form.setAttribute("id", "education_form");

        var count = 0;
        var $start_year; 
        var $end_year; 
        var $title;
        var $education_country; 
        var $education_city;
        var titles = new Array();

        var $new_start_year = document.createElement("input");
        var $new_end_year = document.createElement("input");
        var $new_title = document.createElement("input");
        var $new_country = document.createElement("input");
        var $new_city = document.createElement("input");
       
        for(var i = 0; i < $education_table.rows.length; i++) {
            //get old values
            var $id1 = "education_start_year" + i;
            var $id2 = "education_end_year" + i;
            var $id3 = "education_title" + i;
            var $id4 = "education_country" + i;
            var $id5 = "education_city" + i;
            $start_year = document.getElementById($id1).innerHTML;
            $end_year = document.getElementById($id2).innerHTML;
            $title = document.getElementById($id3).innerHTML;
            titles[i] = $title;
            $education_country = document.getElementById($id4).innerHTML;
            $education_city = document.getElementById($id5).innerHTML;

            //new elements -  create and add old values to new fields
            var $sy_id = "sy_"+i;
            var $ey_id = "ey_"+i;
            var $title_id = "title_"+i;
            var $country_id = "country_"+i;
            var $city_id = "city_"+i;

            var $new_start_year = document.createElement("input");
            var $new_end_year = document.createElement("input");
            var $new_title = document.createElement("input");
            var $new_country = document.createElement("input");
            var $new_city = document.createElement("input");

            //var $new_start_year = document.createElement("input");
            $new_start_year.setAttribute("type", "number");
            $new_start_year.setAttribute("id", $sy_id);
            $new_start_year.setAttribute("placeholder", "Start year");
            $new_start_year.value = $start_year;
            //var $new_end_year = document.createElement("input");
            $new_end_year.setAttribute("type", "number");
            $new_end_year.setAttribute("id", $ey_id);
            $new_end_year.setAttribute("placeholder", "End year")
            $new_end_year.value = $end_year;
            //var $new_title = document.createElement("input");
            $new_title.setAttribute("type", "text");
            $new_title.setAttribute("id", $title_id);
            $new_title.setAttribute("placeholder", "Education")
            $new_title.setAttribute("size", "30");
            $new_title.value = $title;
            //var $new_country = document.createElement("input");
            $new_country.setAttribute("type", "text");
            $new_country.setAttribute("id", $country_id);
            $new_country.setAttribute("placeholder", "Country")
            $new_country.value = $education_country;
            //var $new_city = document.createElement("input");
            $new_city.setAttribute("type", "text");
            $new_city.setAttribute("id", $city_id);
            $new_city.setAttribute("placeholder", "City")
            $new_city.value = $education_city;

            $education_form.appendChild($new_start_year);
            $education_form.appendChild($new_end_year);
            $education_form.appendChild($new_title);
            $education_form.appendChild($new_country);
            $education_form.appendChild($new_city);
            $break = document.createElement("br");
            $education_form.appendChild($break);
            count++;
        } 
        $education_table.remove();

        $education_div.appendChild($education_form);
        
        //submit button
        var $submit_new_education = document.createElement("input");
        $submit_new_education.setAttribute("type", "submit");
        $submit_new_education.setAttribute("id", "submit_new_education");
        $submit_new_education.setAttribute("value", "Save");
        $submit_new_education.onclick = function(e) {
           
            $($education_form).validate({
                rules: {
                    title: "required",
                    ecountry: "required",
                    city: "required",
                },
                submitHandler: function() {
                    //create array for values
                    var education_data = [];
                    for(var i = 0; i < count; i++) {
                        item = {};
                        var $sy_id = "sy_"+i;
                        var $ey_id = "ey_"+i;
                        var $title_id = "title_"+i;
                        var $country_id = "country_"+i;
                        var $city_id = "city_"+i;
   
                        item["old_title"] = titles[i];
                        item["start_year"] = document.getElementById($sy_id).value;
                        item["end_year"] = document.getElementById($ey_id).value;
                        item["title"] = document.getElementById($title_id).value;
                        item["country"] = document.getElementById($country_id).value;
                        item["city"] = document.getElementById($city_id).value;
                        education_data.push(item);
                    }
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {education : education_data},
                        dataType: "json",
                        success: function(response) {
                            $("#edit_education").attr("disabled", false);
                            $education_form.remove();
                            $("#cancel_education_edit").remove();
                            $education_div.appendChild($education_table);
                            for(var i = 0; i < $education_table.rows.length; i++) {
                                var $id1 = "education_start_year" + i;
                                var $id2 = "education_end_year" + i;
                                var $id3 = "education_title" + i;
                                var $id4 = "education_country" + i;
                                var $id5 = "education_city" + i;

                                document.getElementById($id1).innerHTML = education_data[i]["start_year"];
                                document.getElementById($id2).innerHTML = education_data[i]["end_year"];
                                document.getElementById($id3).innerHTML = education_data[i]["title"];
                                document.getElementById($id4).innerHTML = education_data[i]["country"];
                                document.getElementById($id5).innerHTML =  education_data[i]["city"];
                            }
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
               }
            })
            
           
        }
        $education_form.appendChild($submit_new_education);
     
        //cancel button
        var $cancel_education_edit = document.createElement("button");
        $cancel_education_edit.setAttribute("type", "button");
        $cancel_education_edit.setAttribute("id", "cancel_education_edit");
        $cancel_education_edit.innerText = "Cancel Editing";
        $education_div.appendChild($cancel_education_edit);
        $cancel_education_edit.onclick = function cancel_education_edit() {
            $("#edit_education").attr("disabled", false);
            $education_form.remove();
            $education_div.appendChild($education_table);
            $(this).remove();
        }
        
    })

    //skills
    $("#edit_skills").click(function() {
        $(this).attr("disabled", "true");
        var $skill_div = document.getElementById("skills");
        var $skill_table = document.getElementById("skill_table");
        var $skill_form = document.createElement("form");

        //get old values
        var old_skills = [];
        var new_skills = [];
   
        for(var i = 0; i < $skill_table.rows.length; i++) {
            skill = {};
            
            var $skill_id = "skill_id"+i;
            var $skill_name = "skill_name"+i;
            var $skill_level = "skill_level"+i;
            skill["id"] = document.getElementById($skill_id).innerHTML;
            skill["name"] = document.getElementById($skill_name).innerHTML;
            skill["level"] = document.getElementById($skill_level).innerHTML;
            old_skills.push(skill);
            

            var $new_skill_name = document.createElement("input");
            var $new_skill_name_id = "new_skill_name"+i;
            $new_skill_name.setAttribute("type", "text");
            $new_skill_name.setAttribute("id", $new_skill_name_id);
            $new_skill_name.setAttribute("placeholder", "Skill");
            $new_skill_name.value = skill["name"];

            var $new_skill_level = document.createElement("input");
            var $new_skill_level_id = "new_skill_level"+i;
            $new_skill_level.setAttribute("type", "number");
            $new_skill_level.setAttribute("id", $new_skill_level_id);
            $new_skill_level.setAttribute("placeholder", "Level");
            $new_skill_level.value = skill["level"];
            
            $break = document.createElement("br");
           
            $skill_form.appendChild($new_skill_name);
            $skill_form.appendChild($new_skill_level);
            $skill_form.appendChild($break);
        }

        $skill_table.remove();
        $skill_div.appendChild($skill_form);

        var $submit_new_skills = document.createElement("input");
        $submit_new_skills.setAttribute("type", "submit");
        $submit_new_skills.setAttribute("id", "submit_new_skills");
        $submit_new_skills.setAttribute("value", "Save");
        $skill_form.appendChild($submit_new_skills);
        $submit_new_skills.onclick = function() {
           
            $($skill_form).validate({
                rules: {
                    name: "required",
                    level: "required",
                },
                submitHandler: function() {
                    for(var i = 0; i < $skill_table.rows.length; i++) {
                        skill = {};

                        var $new_skill_name_id = "new_skill_name"+i;
                        var $new_skill_level_id = "new_skill_level"+i;
                        
                        skill["id"] = old_skills[i]["id"];
                        skill["name"] = document.getElementById($new_skill_name_id).value;
                        skill["level"] = document.getElementById($new_skill_level_id).value;
                        new_skills.push(skill);
                    }
                    
                   $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {skills : new_skills},
                        dataType: "json",
                    })
               }
            })

        }  

        

    })

})