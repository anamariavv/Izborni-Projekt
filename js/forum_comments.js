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

  
  

})