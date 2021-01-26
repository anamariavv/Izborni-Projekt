$(document).ready(function() {
    $("#change_picture").click(function(){ 
        $(this).attr("disabled", true)
        $("<form id='picture_form'></form>")
            .attr("enctype", "multipart/form-data")
            .attr("action", "include/change_picture.inc.php")
            .attr("method", "post")
            .appendTo("#picture_div")    
        $("<input type='file'>")
            .attr("id", "picture")
            .attr("name", "picture")
            .attr("accept", ".jpg,.png,.jpeg")
            .appendTo("#picture_form");
        $("<input type='submit'><br>")
            .attr("id", "picture_submit")
            .on("click", function(e) {
                var file = document.getElementById("picture");
                if(file.files[0].size > 2097152) {
                    alert("Selected image is too big. Please select an image smaller than 2MB");
                    e.preventDefault();
                }
            })
            .appendTo("#picture_form")
        $("<button type='button'>Cancel</button>")    
            .attr("id", "cancel_picture_change")
            .on("click", function() {
                $("#picture_form").remove();
                $("#change_picture").attr("disabled", false)
            })
            .appendTo("#picture_form")
    });
    $("#delete_link").click(function(){   
        if(confirm("Are you sure you want to remove your picture?")) {
            window.location.href = 'include/change_picture.inc.php?delete=true';
        }
    });
});