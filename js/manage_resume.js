$(document).ready(function() {
    
    //---------------------Title editing----------------------
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

    //---------------------Introduction editing----------------------
    $("#edit_intro").click(function() {
        $(this).attr("disabled", true);
        
        $old_intro = document.getElementById("intro");
        $old_intro_text = $old_intro.innerHTML;
        $old_intro.innerHTML = "";
      
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
      
        $intro_form.appendChild($textarea);
        $intro_form.appendChild($submit_new_intro);
        $intro_div.appendChild($intro_form);
      
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
    

    //---------------------Education editing----------------------
    $("#edit_education").click(function() {
        $(this).attr("disabled", true);
        
        var $education_div = document.getElementById("education");
        var $education_table = document.getElementById("education_table");
        var $education_body = document.getElementById("education_body");
       
        var $education_form = document.createElement("form");
        $education_form.setAttribute("id", "education_form");

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
       
        for(var i = 0; i < $education_body.rows.length; i++) {
            var $id0 = "education_id" + i;
            var $id1 = "education_start_year" + i;
            var $id2 = "education_end_year" + i;
            var $id3 = "education_title" + i;
            var $id4 = "education_country" + i;
            var $id5 = "education_city" + i;
            education = [];

            education["id"] = document.getElementById($id0).innerHTML;
            $start_year = document.getElementById($id1).innerHTML;
            $end_year = document.getElementById($id2).innerHTML;
            $title = document.getElementById($id3).innerHTML;
            titles[i] = $title;
            $education_country = document.getElementById($id4).innerHTML;
            $education_city = document.getElementById($id5).innerHTML;

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

            $new_start_year.setAttribute("type", "number");
            $new_start_year.setAttribute("id", $sy_id);
            $new_start_year.setAttribute("placeholder", "Start year");
            $new_start_year.value = $start_year;
            
            $new_end_year.setAttribute("type", "number");
            $new_end_year.setAttribute("id", $ey_id);
            $new_end_year.setAttribute("placeholder", "End year")
            $new_end_year.value = $end_year;
            
            $new_title.setAttribute("type", "text");
            $new_title.setAttribute("id", $title_id);
            $new_title.setAttribute("placeholder", "Education")
            $new_title.setAttribute("size", "30");
            $new_title.value = $title;
            
            $new_country.setAttribute("type", "text");
            $new_country.setAttribute("id", $country_id);
            $new_country.setAttribute("placeholder", "Country")
            $new_country.value = $education_country;
            
            $new_city.setAttribute("type", "text");
            $new_city.setAttribute("id", $city_id);
            $new_city.setAttribute("placeholder", "City")
            $new_city.value = $education_city;

            var $delete_education = document.createElement("button");
            $delete_education_id = "delete_education_"+i;
            $delete_education.setAttribute("id", $delete_education_id);
            $delete_education.setAttribute("type", "button");
            $delete_education.innerText = "Delete";
            $delete_education.onclick = function() {
                if(window.confirm("Are you sure you want to delete this education?")) {
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {delete_education : education["id"]},
                        dataType: "json",
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            }

            $education_form.appendChild($new_start_year);
            $education_form.appendChild($new_end_year);
            $education_form.appendChild($new_title);
            $education_form.appendChild($new_country);
            $education_form.appendChild($new_city);
            $education_form.appendChild($delete_education);
            $break = document.createElement("br");
            $education_form.appendChild($break);
        } 
        $education_table.remove();

        $education_div.appendChild($education_form);
        
       
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
                    var education_data = [];
                    for(var i = 0; i < $education_body.rows.length; i++) {
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
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
               }
            })
            
           
        }
        $education_form.appendChild($submit_new_education);
     
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

    //---------------------Work experience editing----------------------

    $("#edit_work_experience").click(function() {
        $(this).attr("disabled", true);
        var $work_div = document.getElementById("work_experience");
        var $work_table = document.getElementById("work_table");
        var $work_form = document.createElement("form");

        var old_work = [];
        var new_work = [];

        for(var i = 1; i <= $work_table.rows.length/2; i++) {
            work = {};
            
            var $work_id = "work_id"+i;
            var $work_start_month = "work_start_month"+i;
            var $work_start_year  = "work_start_year"+i;
            var $work_end_month  = "work_end_month"+i;
            var $work_end_year  = "work_end_year"+i;
            var $work_title  = "work_title"+i;
            var $work_city  = "work_city"+i;
            var $work_country  = "work_country"+i;
            var $work_description  = "work_description"+i;
            
            work["id"] = document.getElementById($work_id).innerHTML;
            work["start_month"] = document.getElementById($work_start_month).innerHTML;
            work["start_year"] = document.getElementById($work_start_year).innerHTML;
            work["end_month"] = document.getElementById($work_end_month).innerHTML;
            work["end_year"] = document.getElementById($work_end_year).innerHTML;
            work["title"] = document.getElementById($work_title).innerHTML;
            work["city"] = document.getElementById($work_city).innerHTML;
            work["country"] = document.getElementById($work_country).innerHTML;
            work["description"] = document.getElementById($work_description).innerHTML;
            old_work.push(work);  
            
            var $new_work_sm = document.createElement("input");
            var $new_work_sm_id = "new_work_sm"+i;
            $new_work_sm.setAttribute("type", "number");
            $new_work_sm.setAttribute("id", $new_work_sm_id);
            $new_work_sm.setAttribute("placeholder", "Start month");
            $new_work_sm.value = work["start_month"];

            var $new_work_sy = document.createElement("input");
            var $new_work_sy_id = "new_work_sy"+i;
            $new_work_sy.setAttribute("type", "number");
            $new_work_sy.setAttribute("id", $new_work_sy_id);
            $new_work_sy.setAttribute("placeholder", "Start year");
            $new_work_sy.value = work["start_year"];

            var $new_work_em = document.createElement("input");
            var $new_work_em_id = "new_work_em"+i;
            $new_work_em.setAttribute("type", "number");
            $new_work_em.setAttribute("id", $new_work_em_id);
            $new_work_em.setAttribute("placeholder", "End month");
            $new_work_em.value = work["end_month"];

            var $new_work_ey = document.createElement("input");
            var $new_work_ey_id = "new_work_ey"+i;
            $new_work_ey.setAttribute("type", "number");
            $new_work_ey.setAttribute("id", $new_work_ey_id);
            $new_work_ey.setAttribute("placeholder", "End year");
            $new_work_ey.value = work["end_year"];

            var $new_work_title = document.createElement("input");
            var $new_work_title_id = "new_work_title"+i;
            $new_work_title.setAttribute("type", "text");
            $new_work_title.setAttribute("id", $new_work_title_id);
            $new_work_title.setAttribute("placeholder", "Start year");
            $new_work_title.value = work["title"]; 

            var $new_work_city = document.createElement("input");
            var $new_work_city_id = "new_work_city"+i;
            $new_work_city.setAttribute("type", "text");
            $new_work_city.setAttribute("id", $new_work_city_id);
            $new_work_city.setAttribute("placeholder", "City");
            $new_work_city.value = work["city"];

            var $new_work_country = document.createElement("input");
            var $new_work_country_id = "new_work_country"+i;
            $new_work_country.setAttribute("type", "text");
            $new_work_country.setAttribute("id", $new_work_country_id);
            $new_work_country.setAttribute("placeholder", "Country");
            $new_work_country.value = work["country"];

            var $new_work_description = document.createElement("textarea");
            var $new_work_description_id = "new_work_description"+i;
            $new_work_description.setAttribute("form", "work_form");
            $new_work_description.setAttribute("id", $new_work_description_id);
            $new_work_description.setAttribute("placeholder", "Description");
            $new_work_description.setAttribute("cols", "50");
            $new_work_description.setAttribute("rows", "10");
            $new_work_description.value = work["description"];

            var $delete_work = document.createElement("button");
            $delete_work_id = "delete_work_"+i;
            $delete_work.setAttribute("id", $delete_work_id);
            $delete_work.setAttribute("type", "button");
            $delete_work.innerText = "Delete";
            $delete_work.onclick = function() {
                if(window.confirm("Are you sure you want to delete this work?")) {
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {delete_work : work["id"]},
                        dataType: "json",
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            }
                        
            $break = document.createElement("br");
           
            $work_form.appendChild($new_work_sm);
            $work_form.appendChild($new_work_sy);
            $work_form.appendChild($new_work_em);
            $work_form.appendChild($new_work_ey);
            $work_form.appendChild($new_work_title);
            $work_form.appendChild($new_work_city);
            $work_form.appendChild($new_work_country);
            $work_form.appendChild($new_work_description);
            $work_form.appendChild($delete_work);
            $work_form.appendChild($break);
        }

        $work_table.remove();
        $work_div.appendChild($work_form);
      
        var $submit_new_work = document.createElement("input");
        $submit_new_work.setAttribute("type", "submit");
        $submit_new_work.setAttribute("id", "submit_new_work");
        $submit_new_work.setAttribute("value", "Save");
        $work_form.appendChild($submit_new_work);

        $submit_new_work.onclick = function() {
          
            $($work_form).validate({
                rules: {
                    title: "required",
                    country: "required",
                    city: "required"
                },
                submitHandler: function() {
                    for(var i = 1; i <= $work_table.rows.length/2; i++) {
                        work = {};

                        var $new_work_sm_id = "new_work_sm"+i;
                        var $new_work_sy_id = "new_work_sy"+i;
                        var $new_work_em_id = "new_work_em"+i;
                        var $new_work_ey_id = "new_work_ey"+i;
                        var $new_work_title_id = "new_work_title"+i;
                        var $new_work_city_id = "new_work_city"+i;
                        var $new_work_country_id = "new_work_country"+i;
                        var $new_work_description_id = "new_work_description"+i;
                       
                        work["id"] = old_work[i-1]["id"];
                        work["start_month"] = document.getElementById($new_work_sm_id).value;
                        work["start_year"] = document.getElementById($new_work_sy_id).value;
                        work["end_month"] = document.getElementById($new_work_em_id).value;
                        work["end_year"] = document.getElementById($new_work_ey_id).value;
                        work["title"] = document.getElementById($new_work_title_id).value;
                        work["city"] = document.getElementById($new_work_city_id).value;
                        work["country"] = document.getElementById($new_work_country_id).value;
                        work["description"] = document.getElementById($new_work_description_id).value;
                        new_work.push(work);
                    }

                                       
                   $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {work : new_work},
                        dataType: "json",
                        success: function(response) {
                            $("#edit_work_experience").attr("disabled", false);
                            $work_form.remove();
                            $cancel_work_edit.remove();
                            $work_div.appendChild($work_table);
                            for(var i = 1; i <= $work_table.rows.length/2; i++) {    

                                var $work_id = "work_id"+i;
                                var $work_start_month = "work_start_month"+i;
                                var $work_start_year  = "work_start_year"+i;
                                var $work_end_month  = "work_end_month"+i;
                                var $work_end_year  = "work_end_year"+i;
                                var $work_title  = "work_title"+i;
                                var $work_city  = "work_city"+i;
                                var $work_country  = "work_country"+i;
                                var $work_description  = "work_description"+i;
                                document.getElementById($work_id).innerHTML = new_work[i-1]["id"];
                                document.getElementById($work_start_month).innerHTML = new_work[i-1]["start_month"];
                                document.getElementById($work_start_year).innerHTML = new_work[i-1]["start_year"];
                                document.getElementById($work_end_year).innerHTML = new_work[i-1]["end_year"];
                                document.getElementById($work_end_month).innerHTML = new_work[i-1]["end_month"];
                                document.getElementById($work_title).innerHTML = new_work[i-1]["title"];
                                document.getElementById($work_city).innerHTML = new_work[i-1]["city"];
                                document.getElementById($work_country).innerHTML = new_work[i-1]["country"];
                                document.getElementById($work_description).innerHTML = new_work[i-1]["description"];
                            }
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
               }
            })

        } 
        var $cancel_work_edit = document.createElement("button");
        $cancel_work_edit.setAttribute("type", "button");
        $cancel_work_edit.setAttribute("id", "cancel_work_edit");
        $cancel_work_edit.innerText = "Cancel";
        $work_div.appendChild($cancel_work_edit);
        $cancel_work_edit.onclick = function cancel_work_edit() {
            $work_form.remove();
            $work_div.appendChild($work_table);
            $("#edit_work_experience").attr("disabled", false);
            $(this).remove();
        }
    })

    //---------------------Skills editing----------------------
    $("#edit_skills").click(function() {
        $(this).attr("disabled", true);
        var $skill_div = document.getElementById("skills");
        var $skill_table = document.getElementById("skill_table");
        var $skill_body = document.getElementById("skill_body");
        var $skill_form = document.createElement("form");

        var old_skills = [];
        var new_skills = [];
   
        for(var i = 0; i < $skill_body.rows.length; i++) {
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

            var $delete_skill = document.createElement("button");
            $delete_skill_id = "delete_skill_"+i;
            $delete_skill.setAttribute("id", $delete_skill_id);
            $delete_skill.setAttribute("type", "button");
            $delete_skill.innerText = "Delete";
            $delete_skill.onclick = function() {
                if(window.confirm("Are you sure you want to delete this skill?")) {
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {delete_skill : skill["id"]},
                        dataType: "json",
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            }
            
            $break = document.createElement("br");
           
            $skill_form.appendChild($new_skill_name);
            $skill_form.appendChild($new_skill_level);
            $skill_form.appendChild($delete_skill);
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
                    for(var i = 0; i < $skill_body.rows.length; i++) {
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
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
               }
            })

        }  
        var $cancel_skill_edit = document.createElement("button");
        $cancel_skill_edit.setAttribute("type", "button");
        $cancel_skill_edit.setAttribute("id", "cancel_skill_edit");
        $cancel_skill_edit.innerText = "Cancel";
        $skill_div.appendChild($cancel_skill_edit);
        $cancel_skill_edit.onclick = function cancel_skill_edit() {
            $skill_form.remove();
            $skill_div.appendChild($skill_table);
            $("#edit_skills").attr("disabled", false);
            $(this).remove();
        }
    })

    //---------------------Languages editing----------------------
    $("#edit_languages").click(function() {
        $(this).attr("disabled", true);
        var $language_div = document.getElementById("languages");
        var $language_table = document.getElementById("language_table");
        var $language_body = document.getElementById("language_body");
        var $language_form = document.createElement("form");

        var old_languages = [];
        var new_languages = [];
   
        for(var i = 0; i < $language_body.rows.length; i++) {
            language = {};
            
            var $language_id = "language_id"+i;
            var $language_name = "language_name"+i;
            var $language_level = "language_level"+i;
            language["id"] = document.getElementById($language_id).innerHTML;
            language["name"] = document.getElementById($language_name).innerHTML;
            language["level"] = document.getElementById($language_level).innerHTML;
            old_languages.push(language);
            

            var $new_language_name = document.createElement("input");
            var $new_language_name_id = "new_language_name"+i;
            $new_language_name.setAttribute("type", "text");
            $new_language_name.setAttribute("id", $new_language_name_id);
            $new_language_name.setAttribute("placeholder", "language");
            $new_language_name.value = language["name"];

            var $new_language_level = document.createElement("input");
            var $new_language_level_id = "new_language_level"+i;
            $new_language_level.setAttribute("type", "number");
            $new_language_level.setAttribute("id", $new_language_level_id);
            $new_language_level.setAttribute("placeholder", "Level");
            $new_language_level.value = language["level"];

            var $delete_language = document.createElement("button");
            $delete_language_id = "delete_language_"+i;
            $delete_language.setAttribute("id", $delete_language_id);
            $delete_language.setAttribute("type", "button");
            $delete_language.innerText = "Delete";
            $delete_language.onclick = function() {
                if(window.confirm("Are you sure you want to delete this language?")) {
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {delete_language : language["id"]},
                        dataType: "json",
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            }
            
            $break = document.createElement("br");
           
            $language_form.appendChild($new_language_name);
            $language_form.appendChild($new_language_level);
            $language_form.appendChild($delete_language);
            $language_form.appendChild($break);
        }

        $language_table.remove();
        $language_div.appendChild($language_form);

        var $submit_new_languages = document.createElement("input");
        $submit_new_languages.setAttribute("type", "submit");
        $submit_new_languages.setAttribute("id", "submit_new_languages");
        $submit_new_languages.setAttribute("value", "Save");
        $language_form.appendChild($submit_new_languages);
        $submit_new_languages.onclick = function() {
           
            $($language_form).validate({
                rules: {
                    name: "required",
                    level: "required",
                },
                submitHandler: function() {
                    for(var i = 0; i < $language_body.rows.length; i++) {
                        language = {};

                        var $new_language_name_id = "new_language_name"+i;
                        var $new_language_level_id = "new_language_level"+i;
                        
                        language["id"] = old_languages[i]["id"];
                        language["name"] = document.getElementById($new_language_name_id).value;
                        language["level"] = document.getElementById($new_language_level_id).value;
                        new_languages.push(language);
                    }
                    
                   $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {languages : new_languages},
                        dataType: "json",
                        success: function(response) {
                           location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
               }
            })

        }  
        var $cancel_language_edit = document.createElement("button");
        $cancel_language_edit.setAttribute("type", "button");
        $cancel_language_edit.setAttribute("id", "cancel_language_edit");
        $cancel_language_edit.innerText = "Cancel";
        $language_div.appendChild($cancel_language_edit);
        $cancel_language_edit.onclick = function cancel_language_edit() {
            $language_form.remove();
            $language_div.appendChild($language_table);
            $("#edit_languages").attr("disabled", false);
            $(this).remove();
        }
    })

    //---------------------Keywords editing----------------------

    $("#edit_keywords").click(function() {
        $(this).attr("disabled", true);
        var $keyword_div = document.getElementById("keywords");
        var $keyword_table = document.getElementById("keyword_table");
        var $keyword_form = document.createElement("form");
        var $keyword_body = document.getElementById("keyword_body");

        var old_keywords = [];
        var new_keywords = [];
    
        for(var i = 0; i < $keyword_body.rows.length; i++) {
            keyword = {};
            
            var $keyword_id = "keyword_id"+i;
            var $keyword_category = "keyword_category"+i;
            var $keyword_word = "keyword_word"+i;
            keyword["id"] = document.getElementById($keyword_id).innerHTML;
            keyword["category"] = document.getElementById($keyword_category).innerHTML;
            keyword["word"] = document.getElementById($keyword_word).innerHTML;
            old_keywords.push(keyword);
            
            var $new_keyword_category = document.createElement("input");
            var $new_keyword_category_id = "new_keyword_category"+i;
            $new_keyword_category.setAttribute("type", "text");
            $new_keyword_category.setAttribute("id", $new_keyword_category_id);
            $new_keyword_category.setAttribute("placeholder", "Category");
            $new_keyword_category.value = keyword["category"];

            var $new_keyword_word = document.createElement("input");
            var $new_keyword_word_id = "new_keyword_word"+i;
            $new_keyword_word.setAttribute("type", "text");
            $new_keyword_word.setAttribute("id", $new_keyword_word_id);
            $new_keyword_word.setAttribute("placeholder", "Word");
            $new_keyword_word.value = keyword["word"];
          
            var $delete_keyword = document.createElement("button");
            $delete_keyword_id = "delete_keyword_"+i;
            $delete_keyword.setAttribute("id", $delete_keyword_id);
            $delete_keyword.setAttribute("type", "button");
            $delete_keyword.innerText = "Delete";
            $delete_keyword.onclick = function() {
                if(window.confirm("Are you sure you want to delete this keyword?")) {
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {delete_keyword : keyword["id"]},
                        dataType: "json",
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            }

            $break = document.createElement("br");
           
            $keyword_form.appendChild($new_keyword_category);
            $keyword_form.appendChild($new_keyword_word);
            $keyword_form.appendChild($delete_keyword);
            $keyword_form.appendChild($break);
        }

        $keyword_table.remove();
        $keyword_div.appendChild($keyword_form);

        var $submit_new_keywords = document.createElement("input");
        $submit_new_keywords.setAttribute("type", "submit");
        $submit_new_keywords.setAttribute("id", "submit_new_keywords");
        $submit_new_keywords.setAttribute("value", "Save");
        $keyword_form.appendChild($submit_new_keywords);
        $submit_new_keywords.onclick = function() {
           
            $($keyword_form).validate({
                rules: {
                    category: "required",
                    word: "required",
                },
                submitHandler: function() {
                    for(var i = 0; i < $keyword_body.rows.length; i++) {
                        keyword = {};

                        var $new_keyword_category_id = "new_keyword_category"+i;
                        var $new_keyword_word_id = "new_keyword_word"+i;
                        
                        keyword["id"] = old_keywords[i]["id"];
                        keyword["category"] = document.getElementById($new_keyword_category_id).value;
                        keyword["word"] = document.getElementById($new_keyword_word_id).value;
                        new_keywords.push(keyword);
                    }
                    
                   $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        data: {keywords : new_keywords},
                        dataType: "json",
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
               }
            })

        }  
        var $cancel_keyword_edit = document.createElement("button");
        $cancel_keyword_edit.setAttribute("type", "button");
        $cancel_keyword_edit.setAttribute("id", "cancel_keyword_edit");
        $cancel_keyword_edit.innerText = "Cancel";
        $keyword_div.appendChild($cancel_keyword_edit);
        $cancel_keyword_edit.onclick = function cancel_keyword_edit() {
            $keyword_form.remove();
            $keyword_div.appendChild($keyword_table);
            $("#edit_keywords").attr("disabled", false);
            $(this).remove();
        }
    })


    //---------------------Education adding----------------------

    $("#add_education").click(function() {
        $(this).attr("disabled", true);
        var $add_education_form = document.createElement("form");
        var $submit_add_education = document.createElement("input");
        $add_education_form.setAttribute("id", "add_education_form");
                
        var $education_div = document.getElementById("education");
    
        var $sy_id = "add_sy";
        var $ey_id = "add_ey";
        var $title_id = "add_title";
        var $country_id = "add_country";
        var $city_id = "add_city";

        var $add_start_year = document.createElement("input");
        var $add_end_year = document.createElement("input");
        var $add_title = document.createElement("input");
        var $add_country = document.createElement("input");
        var $add_city = document.createElement("input");

        $add_start_year.setAttribute("type", "number");
        $add_start_year.setAttribute("id", $sy_id);
        $add_start_year.setAttribute("placeholder", "Start year");

        $add_end_year.setAttribute("type", "number");
        $add_end_year.setAttribute("id", $ey_id);
        $add_end_year.setAttribute("placeholder", "End year")

        $add_title.setAttribute("type", "text");
        $add_title.setAttribute("id", $title_id);
        $add_title.setAttribute("placeholder", "Education")
        $add_title.setAttribute("size", "30");
        
        $add_country.setAttribute("type", "text");
        $add_country.setAttribute("id", $country_id);
        $add_country.setAttribute("placeholder", "Country")
        
        $add_city.setAttribute("type", "text");
        $add_city.setAttribute("id", $city_id);
        $add_city.setAttribute("placeholder", "City")

        $submit_add_education.setAttribute("type", "submit");
        $submit_add_education.setAttribute("id", "submit_add_education");
        $submit_add_education.innerText = "Submit";
        $submit_add_education.onclick = function() {

            $($add_education_form).validate({
                rules: {
                    title: "required",
                    country: "required",
                    city: "required",
                },
                submitHandler: function() {
                    var new_education = [];
                    education = {};
                    var $sy_id = "add_sy";
                    var $ey_id = "add_ey";
                    var $title_id = "add_title";
                    var $country_id = "add_country";
                    var $city_id = "add_city";

                    education["start_year"] = document.getElementById($sy_id).value;
                    education["end_year"] = document.getElementById($ey_id).value;
                    education["title"] = document.getElementById($title_id).value;
                    education["country"] = document.getElementById($country_id).value;
                    education["city"] = document.getElementById($city_id).value;
                    new_education.push(education)                    
                    
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        dataType: "json",
                        data: {add_education : new_education},
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            })
            
        }

        var $cancel_add_row = document.createElement("button");
        $cancel_add_row_id = "cancel_add_row";
        $cancel_add_row.innerText = "Remove";
        $cancel_add_row.setAttribute("id", $cancel_add_row_id);
        $cancel_add_row.onclick = function() {
            $add_education_form.remove();
            $("#add_education").attr("disabled", false);
            $(this).remove();
        }

        $break = document.createElement("br");

        $add_education_form.appendChild($add_start_year);
        $add_education_form.appendChild($add_end_year);
        $add_education_form.appendChild($add_title);
        $add_education_form.appendChild($add_country);
        $add_education_form.appendChild($add_city);
        $add_education_form.appendChild($cancel_add_row);
        $add_education_form.appendChild($break);
        
        $education_div.appendChild($add_education_form);
        $add_education_form.appendChild($submit_add_education);
    })


    //---------------------Work experience adding----------------------

     $("#add_work").click(function() {
        $(this).attr("disabled", true);
        var $add_work_form = document.createElement("form");
        var $submit_add_work = document.createElement("input");
        $add_work_form.setAttribute("id", "add_work_form");
                
        var $work_div = document.getElementById("work_experience");
    
        var $sm_id = "add_sm_work";
        var $sy_id = "add_sy_work";
        var $em_id = "add_em_work";
        var $ey_id = "add_ey_work";
        var $title_id = "add_title_work";
        var $country_id = "add_country_work";
        var $city_id = "add_city_work";
        var $desc_id = "add_description_id";

        var $add_start_year = document.createElement("input");
        var $add_end_year = document.createElement("input");
        var $add_start_month = document.createElement("input");
        var $add_end_month = document.createElement("input");
        var $add_title = document.createElement("input");
        var $add_country = document.createElement("input");
        var $add_city = document.createElement("input");
        var $add_description = document.createElement("textarea");
        var $submit_add_work = document.createElement("input");

        $add_description.setAttribute("form", "add_work_form");
        $add_description.setAttribute("id", $desc_id);
        $add_description.setAttribute("placeholder", "Description");

        $add_start_month.setAttribute("type", "number");
        $add_start_month.setAttribute("id", $sm_id);
        $add_start_month.setAttribute("placeholder", "Start month");

        $add_end_month.setAttribute("type", "number");
        $add_end_month.setAttribute("id", $em_id);
        $add_end_month.setAttribute("placeholder", "End month");

        $add_start_year.setAttribute("type", "number");
        $add_start_year.setAttribute("id", $sy_id);
        $add_start_year.setAttribute("placeholder", "Start year");

        $add_end_year.setAttribute("type", "number");
        $add_end_year.setAttribute("id", $ey_id);
        $add_end_year.setAttribute("placeholder", "End year")

        $add_title.setAttribute("type", "text");
        $add_title.setAttribute("id", $title_id);
        $add_title.setAttribute("placeholder", "Work experience")
        $add_title.setAttribute("size", "30");
        
        $add_country.setAttribute("type", "text");
        $add_country.setAttribute("id", $country_id);
        $add_country.setAttribute("placeholder", "Country")
        
        $add_city.setAttribute("type", "text");
        $add_city.setAttribute("id", $city_id);
        $add_city.setAttribute("placeholder", "City")

        $submit_add_work.setAttribute("type", "submit");
        $submit_add_work.setAttribute("id", "submit_add_work");
        $submit_add_work.innerText = "Submit";
        $submit_add_work.onclick = function() {

            $($add_work_form).validate({
                rules: {
                    title: "required",
                    country: "required",
                    city: "required",
                },
                submitHandler: function() {
                    var new_work= [];
                    work = {};

                    var $sm_id = "add_sm_work";
                    var $sy_id = "add_sy_work";
                    var $em_id = "add_em_work";
                    var $ey_id = "add_ey_work";
                    var $title_id = "add_title_work";
                    var $country_id = "add_country_work";
                    var $city_id = "add_city_work";
                    var $desc_id = "add_description_id";

                    work["start_year"] = document.getElementById($sy_id).value;
                    work["start_month"] = document.getElementById($sm_id).value;
                    work["end_month"] = document.getElementById($em_id).value;
                    work["end_year"] = document.getElementById($ey_id).value;
                    work["title"] = document.getElementById($title_id).value;
                    work["country"] = document.getElementById($country_id).value;
                    work["city"] = document.getElementById($city_id).value;
                    work["description"] = document.getElementById($desc_id).value;
                    new_work.push(work)                    
                    

                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        dataType: "json",
                        data: {add_work : new_work},
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            })
            
        }

        var $cancel_add_row = document.createElement("button");
        $cancel_add_row_id = "cancel_add_row";
        $cancel_add_row.innerText = "Remove";
        $cancel_add_row.setAttribute("id", $cancel_add_row_id);
        $cancel_add_row.onclick = function() {
            $add_work_form.remove();
            $("#add_work").attr("disabled", false);
            $(this).remove();
        }

        $break = document.createElement("br");

        $add_work_form.appendChild($add_start_year);
        $add_work_form.appendChild($add_end_year);
        $add_work_form.appendChild($add_start_month);
        $add_work_form.appendChild($add_end_month);
        $add_work_form.appendChild($add_title);
        $add_work_form.appendChild($add_country);
        $add_work_form.appendChild($add_city);
        $add_work_form.appendChild($add_description);
        $add_work_form.appendChild($submit_add_work);      
     
        $add_work_form.appendChild($cancel_add_row);
        $add_work_form.appendChild($break);
        
        $work_div.appendChild($add_work_form);
    })

    //---------------------Skills adding----------------------

    $("#add_skill").click(function() {
        $(this).attr("disabled", true);
        var $add_skill_form = document.createElement("form");
        var $submit_add_skill = document.createElement("input");
        $add_skill_form.setAttribute("id", "add_skill_form");
                
        var $skill_div = document.getElementById("skills");
    
        var $name_id = "add_name_skill";
        var $level_id = "add_level_skill";    

        var $add_name = document.createElement("input");
        var $add_level = document.createElement("input");

        $add_name.setAttribute("type", "text");
        $add_name.setAttribute("id", $name_id);
        $add_name.setAttribute("placeholder", "Skill");

        $add_level.setAttribute("type", "number");
        $add_level.setAttribute("id", $level_id);
        $add_level.setAttribute("placeholder", "Level");


        $submit_add_skill.setAttribute("type", "submit");
        $submit_add_skill.setAttribute("id", "submit_add_skill");
        $submit_add_skill.innerText = "Submit";
        $submit_add_skill.onclick = function() {

            $($add_skill_form).validate({
                rules: {
                    name: "required",
                    level: "required",
                },
                submitHandler: function() {
                    var new_skill = [];
                    skill = {};

                    var $name_id = "add_name_skill";
                    var $level_id = "add_level_skill";

                    skill["name"] = document.getElementById($name_id).value;
                    skill["level"] = document.getElementById($level_id).value;

                    new_skill.push(skill)                    
                    
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        dataType: "json",
                        data: {add_skill : new_skill},
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            })
            
        }

        var $cancel_add_row = document.createElement("button");
        $cancel_add_row_id = "cancel_add_row";
        $cancel_add_row.innerText = "Remove";
        $cancel_add_row.setAttribute("id", $cancel_add_row_id);
        $cancel_add_row.onclick = function() {
            $add_skill_form.remove();
            $("#add_skill").attr("disabled", false);
            $(this).remove();
        }

        $break = document.createElement("br");

        $add_skill_form.appendChild($add_name);
        $add_skill_form.appendChild($add_level);
        $add_skill_form.appendChild($submit_add_skill);      
     
        $add_skill_form.appendChild($cancel_add_row);
        $add_skill_form.appendChild($break);
        
        $skill_div.appendChild($add_skill_form);

    })
    

    //---------------------Language adding----------------------

    $("#add_language").click(function() {
        $(this).attr("disabled", true);
        var $add_language_form = document.createElement("form");
        var $submit_add_language = document.createElement("input");
        $add_language_form.setAttribute("id", "add_language_form");
                
        var $language_div = document.getElementById("languages");
    
        var $name_id = "add_name_language";
        var $level_id = "add_level_language";    

        var $add_name = document.createElement("input");
        var $add_level = document.createElement("input");

        $add_name.setAttribute("type", "text");
        $add_name.setAttribute("id", $name_id);
        $add_name.setAttribute("placeholder", "Language");

        $add_level.setAttribute("type", "number");
        $add_level.setAttribute("id", $level_id);
        $add_level.setAttribute("placeholder", "Level");


        $submit_add_language.setAttribute("type", "submit");
        $submit_add_language.setAttribute("id", "submit_add_language");
        $submit_add_language.innerText = "Submit";
        $submit_add_language.onclick = function() {

            $($add_language_form).validate({
                rules: {
                    name: "required",
                    level: "required",
                },
                submitHandler: function() {
                    var new_language = [];
                    language = {};

                    var $name_id = "add_name_language";
                    var $level_id = "add_level_language";

                    language["name"] = document.getElementById($name_id).value;
                    language["level"] = document.getElementById($level_id).value;

                    new_language.push(language)                    
                    
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        dataType: "json",
                        data: {add_language : new_language},
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            })
            
        }

        var $cancel_add_row = document.createElement("button");
        $cancel_add_row_id = "cancel_add_row";
        $cancel_add_row.innerText = "Remove";
        $cancel_add_row.setAttribute("id", $cancel_add_row_id);
        $cancel_add_row.onclick = function() {
            $add_language_form.remove();
            $("#add_language").attr("disabled", false);
            $(this).remove();
        }

        $break = document.createElement("br");

        $add_language_form.appendChild($add_name);
        $add_language_form.appendChild($add_level);
        $add_language_form.appendChild($submit_add_language);      
     
        $add_language_form.appendChild($cancel_add_row);
        $add_language_form.appendChild($break);
        
        $language_div.appendChild($add_language_form);

    })

    //---------------------Keyword adding----------------------

    $("#add_keyword").click(function() {
        $(this).attr("disabled", true);
        var $add_keyword_form = document.createElement("form");
        var $submit_add_keyword = document.createElement("input");
        $add_keyword_form.setAttribute("id", "add_keyword_form");
                
        var $keyword_div = document.getElementById("keywords");
    
        var $category_id = "add_category_keyword";
        var $word_id = "add_word_keyword";    

        var $add_category = document.createElement("input");
        var $add_word = document.createElement("input");

        $add_category.setAttribute("type", "text");
        $add_category.setAttribute("id", $category_id);
        $add_category.setAttribute("placeholder", "Category");

        $add_word.setAttribute("type", "text");
        $add_word.setAttribute("id", $word_id);
        $add_word.setAttribute("placeholder", "Word");


        $submit_add_keyword.setAttribute("type", "submit");
        $submit_add_keyword.setAttribute("id", "submit_add_keyword");
        $submit_add_keyword.innerText = "Submit";
        $submit_add_keyword.onclick = function() {

            $($add_keyword_form).validate({
                rules: {
                    name: "required",
                    level: "required",
                },
                submitHandler: function() {
                    var new_keyword = [];
                    keyword = {};

                    var $category_id = "add_category_keyword";
                    var $word_id = "add_word_keyword";

                    keyword["category"] = document.getElementById($category_id).value;
                    keyword["word"] = document.getElementById($word_id).value;

                    new_keyword.push(keyword)                    
                    
                    $.ajax({
                        type: "POST",
                        url: "include/edit_resume.inc.php",
                        dataType: "json",
                        data: {add_keyword : new_keyword},
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    })
                }
            })
            
        }

        var $cancel_add_row = document.createElement("button");
        $cancel_add_row_id = "cancel_add_row";
        $cancel_add_row.innerText = "Remove";
        $cancel_add_row.setAttribute("id", $cancel_add_row_id);
        $cancel_add_row.onclick = function() {
            $add_keyword_form.remove();
            $("#add_keyword").attr("disabled", false);
            $(this).remove();
        }

        $break = document.createElement("br");

        $add_keyword_form.appendChild($add_category);
        $add_keyword_form.appendChild($add_word);
        $add_keyword_form.appendChild($submit_add_keyword);      
     
        $add_keyword_form.appendChild($cancel_add_row);
        $add_keyword_form.appendChild($break);
        
        $keyword_div.appendChild($add_keyword_form);
    })

})