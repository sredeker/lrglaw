// Variable to hold request
var request;

// Bind to the submit event of our form
$("#contact-form").submit(function(ev){

    // Abort any pending request
    if (request) {
        request.abort();
    }
    $('#form-message').html('');

    // setup some local variables
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();


    // Disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);


    // Fire off the request to /form.php
    request = $.ajax({
        url: "assets/php/contact.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log("Hooray, it worked!", response, textStatus, jqXHR);
        $('#form-message').html('Thanks! Your message has been sent.');
        $inputs.val("");
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error("The following error occurred: " + textStatus, jqXHR, errorThrown);
        $('#form-message').html('Sorry! An error occurred, please try again.');
    });

    // Callback handler that will be called regardless if the request failed or succeeded
    request.always(function () {
        $inputs.prop("disabled", false);
    });

    // Prevent default posting of form
    ev.preventDefault();
});
