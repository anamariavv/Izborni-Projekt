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
        $education_table = document.getElementById("education_table");
        $education_table.remove();
        //turn table into form with exisitng rows as inputs and submit button
        
        //'add' button -> adds new education inputs
        //cancel button
    })
})