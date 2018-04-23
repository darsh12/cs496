// Show preview of image selected to upload
function showUploadPreview() {

    var imageURL = window.URL.createObjectURL(document.getElementById("img_input").files[0]);

    $("#profile_pic").attr("src", imageURL);
    $("#upload_error").attr("style", "display: none");
}

// Set file upload form submit handler and perform AJAX call to update database
function initializeSubmitListener() {

    $("#img_form").submit(function(e) {

        e.preventDefault();

        // Client-side upload verification
        if(document.getElementById("img_input").files.length <= 0) {
            $("#upload_error").attr("style", "display: block");
            $("#upload_error").html("No file selected for upload.");
            return;
        }

        // Check if file extension is correct - UNSTABLE FOR NOW
        // var fileName = document.getElementById("img_input").files[0].name;
        // var fileExt = fileName.split('.').pop();
        // if(fileExt !== "png" || fileExt !== "jpg") {
        //     $("#upload_error").attr("style", "display: block");
        //     $("#upload_error").html("File is not an image.");
        //     return;
        // }

        $.ajax({
            url: "my_profile/avatar_upload",
            type: "POST",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("body").append(data)
            }
        });

    });

}