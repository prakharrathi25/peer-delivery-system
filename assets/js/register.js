// Function to check whether the passwords match
$(document).ready(function() {

    // Call the image that has been uplaoded
    let $uploadfile = $('#register .upload-profile-image input[type="file"]');

    $uploadfile.change(function() {
        readURL(this);
    });

    $("#reg-form").submit(function(e) {

    // Create the variables
    let $password = $('#password');
    let $confirm = $('#confirmPass');
    let $error = $('#confirmError');

    // Check if passwords match
    if ($password.val() === $confirm.val()) {
        return true;

    } else {
        $error.text("Passwords don't match");
        e.preventDefault();
    }

    });
});


// Function to display the image

function readURL(input) {
    if(input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $("#register .upload-profile-image .img").attr("src", e.target.result);
            $("#register .upload-profile-image .camera-icon").css({display: "none"});
        }

        reader.readAsDataURL(input.files[0]);
    }
}
