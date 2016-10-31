/**
 * Description: This JS file contains the code that will control the elements on the
 *              view login log under the admin section.
 */

$.ajax({
    url: "/admin/get-all-login",
    method: "GET",
    success: function(data, status, requestObj) {
        //If there are no errors then a JSON object with a custom message is sent to the client
        console.log(data);

        var loginLogTable = $("#view-login-logs-table").DataTable({
            data: data,
            columns: [
                {data: "name", title: "User"},
                {data: "type", title: "Type"},
                {data: "logged_in_datetime", title: "Logged In"},
                {data: "logged_out_datetime", title: "Logged Out"}
            ],
            order: []
        });
    },
    error: function(requestObj, status, error) {

        console.log(status);
        console.log(error);
        //Laravel returns a 422 error code if there is a validation error
        //If the error is not of type 422 (Unprocessable Entity) then there is some other issue
        //Then print that error code and the default status that is sent from the framework
        if(requestObj.status == 422) {
            var errors = JSON.parse(requestObj.responseText);
            var errorString = "<ul>";
            $.each(errors, function(error) {
                errorString += "<li>" + errors[error] + "</li>";
            });
            errorString += "</ul>";
            $("#view-log-errors").html(errorString);
            $("#view-log-errors").show();
        }
        else {
            console.log(requestObj);

            var errorString = "<li>" + requestObj.status + " : "  + requestObj.statusText + "</li>";
            $("#view-log-errors").html(errorString);
            $("#view-log-errors").show();
        }

    }
});