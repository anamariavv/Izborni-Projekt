$(document).ready(function() {
  $("form[name='new_comment_form']").validate({
      rules: {
        comment_text: "required"          
      },
      messages: {
        comment_text: {
          required: "Please enter a comment!"
        }
      }, 
      submitHandler: function(form) {
        form.submit();
      }
  });


  $("[name='delete_comment']").click(function() {
    $comment = this.value;
    $comment_id = document.getElementById($comment).value;
    if(window.confirm("Are you sure you want to delete your comment?")) {
      $.ajax({
        type: "post",
        url: "include/forum.inc.php",
        data: {delete_comment : $comment_id},
        dataType: "json",
        success: function() {
          location.reload();
        }, 
        error: function(response) {
          console.log(response.data);
        }
      })
    }
  })

  $("[name='edit_comment']").click(function() {
    var $edit_button = $(this);
    var $comment_id = this.value
    $(this).attr("disabled", true);
    $div_id = "text_"+ $comment_id;
    var $comment_div = document.getElementById($div_id);
    var $comment_text = document.getElementById($div_id).innerText;

    var $new_form = document.createElement("form");
    $new_form.setAttribute("id", "new_form");
    var $textarea = document.createElement("textarea");
    $textarea.setAttribute("form", "new_form");
    $textarea.setAttribute("cols", "100");
    $textarea.setAttribute("rows", "8");
    $textarea.setAttribute("id", "new_comment_text");
    $textarea.value = $comment_text;
    
    var $save_edit = document.createElement("input");
    $save_edit.setAttribute("type", "submit");
    $save_edit.setAttribute("id", "save_edit");
    $save_edit.setAttribute("value", "Save");
    $save_edit.onclick = function() {
      var comment_info = [];
      item = {};
      item["comment_id"] = $comment_id;
      item["comment_text"] = $textarea.value;
      comment_info.push(item);

      $($new_form).validate({
        rules: {
          new_comment_text: "required"          
        },
        messages: {
          comment_text: {
            required: "Please enter a comment!"
          }
        }, 
        submitHandler: function(form) {
          $.ajax({
            type: "post",
            url: "include/forum.inc.php",
            data: {edit_comment : comment_info},
            dataType: "json",
            success: function() {
              location.reload();
            }, 
            error: function(response) {
              console.log(response.data);
            }
        })
        }
    });
    }

    $comment_div.innerHTML = "";
    $new_form.appendChild($textarea);
    $new_form.appendChild($save_edit);
    $comment_div.appendChild($new_form);

    var $cancel_edit = document.createElement("button");
    $cancel_edit.setAttribute("type", "button");
    $cancel_edit.setAttribute("id", "cancel_edit");
    $cancel_edit.innerText = "Cancel editing";
    $cancel_edit.onclick = function() {
      $edit_button.attr("disabled", false);
      $new_form.remove();
      $comment_div.innerHTML = $comment_text;
    }
    $comment_div.appendChild($cancel_edit);

  })

  
  

})