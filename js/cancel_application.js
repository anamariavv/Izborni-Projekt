$(document).ready(function() {
    $("[name='cancel']").click(function() {
        var cancel_data = [];
        var item = {};
        item["internship"] = this.id;
          
        if(window.confirm("Are you sure you want to cancel your application for this internship?")) {
            if((item["explanation"] = prompt("Please provide an explanation for cancelling")) != null) {
                cancel_data.push(item);
                $.ajax({
                    type: "POST",
                    url: "include/acceptance.inc.php",
                    data: {cancel : cancel_data},
                    dataType: "json",
                    success: function() {
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response.error);
                    }
                })
            }
        }
    })
})