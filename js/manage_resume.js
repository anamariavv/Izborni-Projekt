$(document).ready(function() {
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
   $("#edit_intro").click(function() {


   })
})