$(document).ready(function(){
    $("#edit_profile").click(function() {
        $(this).attr("disabled", true);
        
        var type;
        $.ajax ({
            async: false,
            type: "POST",
            url: "include/get_user_type.inc.php",
            success: function(data) {
                type = data;
            },
            error: function(data) {
                alert("An error occured");
            }
        })

        function checkEmpty(variable) {
            if (typeof variable === undefined) {
                variable = null;
            }
        }

        if(type == 'student') {
            var fname = $("#fname").html();
            var lname =  $("#lname").html();
            var oib =  $("#oib").html();
            var age =  $("#age").html();
            var university =  $("#university").html();
            checkEmpty(fname);
            checkEmpty(lname);
            checkEmpty(oib);
            checkEmpty(age);
            checkEmpty(university);
        } else if(type == 'company') {
            var cname = $("#cname").html();
            var field = $("#field").html();
            var website = $("#website").html();
            var description = $("#description").html();
            checkEmpty(cname);
            checkEmpty(field);
            checkEmpty(website);
            checkEmpty(description);
        }
        var email = $("#email").html();
        var phone = $("#phone").html();
        var city = $("#city").html();
        var address = $("#address").html();
        var postal =  $("#postal").html();
        checkEmpty(postal);
        checkEmpty(email);
        checkEmpty(phone);
        checkEmpty(city);
        checkEmpty(address);

        var old_html = $("#info_div").html();
        $("#info_div").html("");

        $("<form></form>")
            .attr("id", "info_form")
            .attr("name", "info_form")
            .attr("method", "post")
            .attr("action", "include/edit_profile.inc.php")
            .appendTo("#info_div")
        if(type == 'student') {

            $("<label>Firstname: </label>")
                .appendTo("#info_form")
            $("<input type='text'></input>")
                .attr("name", "fname")
                .attr("id", "fname")
                .attr("value", fname)
                .attr("placeholder", "First Name")
                .appendTo("#info_form")
            $("<label>Lastname: </label>")
                .appendTo("#info_form")
            $("<input type='text'></input>")
                .attr("name", "lname")
                .attr("id", "lname")
                .attr("value", lname)
                .attr("placeholder", "Last Name")
                .appendTo("#info_form")
            $("<label>TIN: </label>")
                .appendTo("#info_form")
            $("<input type='number'></input>")
                .attr("name", "oib")
                .attr("id", "oib")
                .attr("value", oib)
                .attr("placeholder", "TIN")
                .appendTo("#info_form")
            $("<label>Age: </label>")
                .appendTo("#info_form")
            $("<input type='number'></input>")
                .attr("name", "age")
                .attr("id", "age")
                .attr("value", age)
                .attr("placeholder", "Age")
                .appendTo("#info_form")
            $("<label>University: </label>")
                .appendTo("#info_form")
            $("<input type='text'></input>")
                .attr("name", "university")
                .attr("id", "university")
                .attr("value", university)
                .attr("placeholder", "University")
                .appendTo("#info_form")
        } else {
            $("<label>Company Name: </label>")
                .appendTo("#info_form")
            $("<input type='text'></input>")
                .attr("name", "cname")
                .attr("id", "cname")
                .attr("value", cname)
                .attr("placeholder", "Company Name")
                .appendTo("#info_form")
            $("<label>Filed of Work: </label>")
                .appendTo("#info_form")
            $("<input type='text'></input>")
                .attr("name", "field")
                .attr("id", "field")
                .attr("value", field)
                .attr("placeholder", "Field of Work")
                .appendTo("#info_form")
            $("<label>Website: </label>")
                .appendTo("#info_form")
            $("<input type='text'></input>")
                .attr("name", "website")
                .attr("id", "website")
                .attr("value", website)
                .attr("placeholder", "Website")
                .appendTo("#info_form")
            $("<label>Company Description: </label>")
                .appendTo("#info_form")
            $("<textarea>"+description+"</textarea>")
                .attr("name", "description_new")
                .attr("id", "description_new")
                .attr("form", "info_form")
                .attr("cols", "50")
                .attr("rows", "10")
                .attr("value", description)
                .attr("placeholder", "Company Description")
                .appendTo("#info_form")
        }
        $("<label>Email: </label>")
            .appendTo("#info_form")
        $("<input type='email'></input>")
            .attr("name", "email")
            .attr("id", "email")
            .attr("value", email)
            .attr("placeholder", "Email")
            .appendTo("#info_form")
        $("<label>Phone Number: </label>")
            .appendTo("#info_form")
        $("<input type='text'></input>")
            .attr("name", "phone")
            .attr("id", "phone")
            .attr("value", phone)
            .attr("placeholder", "Phone Number")
            .appendTo("#info_form")
        $("<label>City: </label>")
            .appendTo("#info_form")
        $("<input type='text'></input>")
            .attr("name", "city")
            .attr("id", "city")
            .attr("value", city)
            .attr("placeholder", "City")
            .appendTo("#info_form")
        $("<label>Address: </label>")
            .appendTo("#info_form")
        $("<input type='text'></input>")
            .attr("name", "address")
            .attr("id", "address")
            .attr("value", address)
            .attr("placeholder", "Address")
            .appendTo("#info_form")
        $("<label>Postal Code: </label>")
            .appendTo("#info_form")
        $("<input type='number'></input>")
            .attr("name", "postal")
            .attr("id", "postal")
            .attr("value", postal)
            .attr("placeholder", "Postal Code")
            .appendTo("#info_form")
        $("</br>")
            .appendTo("#info_form")
        $("<input type='submit'></input>")
            .attr("id", "edit_submit")
            .attr("value", "Save")
            .appendTo("#info_form")
        $("<button type='button'>Cancel</button>")
            .attr("id", "cancel_edit")
            .on("click", function() {
                $("#info_div").html(old_html);
                $("#edit_profile").attr("disabled", false);
                $(this).remove();
            })
            .appendTo("#info_form")
        
    });
});