$(document).ready(function() {
    $("button").click(function() {
        //get id of button pressed
        var button_id = this.id;

        //check if if the id starts with 'edit'
        if(button_id.includes("edit")) {
            //append a cancel button to the td in the table

            //get the id of the td with the value currently in it
            var cell_id = button_id.substr(5, button_id.length);
            alert(cell_id);

            /*create a form inside that td where the information is
            with the corresponding input type and send an ajax request*/            

        }
        
        //get the type of user
       var type;
       $.ajax({
            async: false,
            type: "POST",
            url: "include/get_usertype.inc.php",
            cache: false,
            dataType: "json",
            data: {type: "type"},
            success: function(data) {
                type = data;
            },
            error: function(data) {
                alert("Javascript error");
            }
        });
  
        

    });
});