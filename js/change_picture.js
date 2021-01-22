$(document).ready(function() {
    //finish up, disable button once clicked etc.
    $("#change_picture").click(function(){ 
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
            .appendTo("#picture_form");
    });
    $("#delete_picture").click(function(){   
        //confirm deletion by alert and then proceed
        //send to same script as change picture
    });
});