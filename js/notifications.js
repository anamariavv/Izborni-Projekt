$(document).ready(function() {
    var user_data = [];
    var user = {};
    var $bell = document.getElementById("notifications");
    var $bell_div = document.getElementById("notification_div");
    var $user_data = document.getElementById("notif_id").value;
    var $user_type = document.getElementById("notif_id_type").value;

    user["identification"] = $user_data;
    user["type"] = $user_type;
    user_data.push(user);

    var notifications = [];

    function get_notifications(notifications) {
        $.ajax({
            type: "POST",
            url: "include/get_notifications.inc.php",
            data: {data: user_data},
            dataType: "json",
            success: function(response) {
                if(response.length == 0) {
                    var $new_option = document.createElement("span");
                    var $option_text = document.createElement("p");
                    $option_text.innerText = "No new notifications";
                    $new_option.appendChild($option_text);
                    $bell_div.appendChild($new_option);   
                    $bell_div.setAttribute("style", "display: none;");   
                }
                for(i = 0; i < response.length; i++) {
                    notifications.push(response[i]);
                    var $new_option = document.createElement("span");
                    var $option_text = document.createElement("p");
                    $new_option.setAttribute("id", response[i]["id"]);
                    $option_text.innerText = response[i]["notif_text"];
                    $new_option.appendChild($option_text);
                    $bell_div.appendChild($new_option);   
                    $bell_div.setAttribute("style", "display: none;");     
                }
            },
            error: function(response) {
                console.log(response.error);
            }
        })
    }; 
   
    get_notifications(notifications);

    $bell.onclick = function() {
        $.ajax({
            type: "POST",
            url: "include/get_notifications.inc.php",
            data: {read: notifications},
            dataType: "json",
            error: function(response) {
                console.log(response.error);
            }
        })
       $("#notification_div").toggle();
    }

})