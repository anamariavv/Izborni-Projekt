$(document).ready(function() {
    $("[name='approve']").click(function() {
        var $comment_id = this.id;
        
        $.ajax({
            type: "post",
            url: "include/approve_comments.inc.php",
            data: {approve : $comment_id},
            dataType: "json",
            success: function() {
                location.reload();
            }, 
            error: function(response) {
                console.log(response.error);
            }
        })
    })
    $("[name='reject']").click(function() {
        var $comment_id = this.id;
        
        $.ajax({
            type: "post",
            url: "include/approve_comments.inc.php",
            data: {reject : $comment_id},
            dataType: "json",
            success: function() {
                location.reload();
            }, 
            error: function(response) {
                console.log(response.error);
            }
        })
    })
})