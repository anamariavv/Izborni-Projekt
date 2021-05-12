  
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
                    $option_text.innerText = "No notifications";
                    $new_option.appendChild($option_text);
                    $bell_div.appendChild($new_option);   
                    $bell_div.setAttribute("style", "display: none;");   
                } else {
                    var unread = 0;
                    
                    for(i = 0; i < response.length; i++) {
                        if(response[i]["status"] === "unread") {
                            unread += 1;
                        }
                        notifications.push(response[i]);
                        var $new_option = document.createElement("span");
                        if(response[i]["status"] === "unread") {
                           $new_option.classList = "unread";
                        } else {
                            $new_option.classList = "read";
                        }
                        var $option_text = document.createElement("p");
                        $new_option.setAttribute("id", response[i]["id"]);
                        $new_option.setAttribute("name", "notification_element");
                        $new_option.onclick = function () {
                            $target = this.id;
                            $.ajax({
                                type: "POST",
                                url: "include/get_notifications.inc.php",
                                data: {read: $target},
                                dataType: "json",
                                success: function(response) {
                                    document.getElementById($target).removeAttribute("class");
                                    document.getElementById($target).setAttribute("class", "read");
                                },
                                error: function(response) {
                                    console.log(response.error);
                                }
                            })
                        }
                        $option_text.innerText = response[i]["notif_text"];
                        $new_option.appendChild($option_text);
                        $bell_div.appendChild($new_option);   
                        $bell_div.setAttribute("style", "display: none;");   
                    }

                    if(unread > 0) {
                        var $alert_div = document.getElementById("notification_alert");
                        $alert_div.classList += "_visible";
                        $alert_div.onclick = function () {
                            $alert_div.classList = "notification_alert";
                        }
                    }
                }
            },
            error: function(response) {
                console.log(response);
            }
        })
    }; 
   
    get_notifications(notifications);
    



    $bell.onclick = function() {
       $("#notification_div").toggle();
    }

})