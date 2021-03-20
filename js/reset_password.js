$(document).ready(function() {
    $("#regen_password_button").click(function() {
        location.reload();
    })

    $("#passwordform").submit(function(e) {
        if(!window.confirm("Are you sure you want to reset the password for the user?")) {
            e.preventDefault();
        }
    })  
})