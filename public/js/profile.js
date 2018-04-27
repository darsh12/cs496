// Show preview of image selected to upload
$("#user_avatar_image_path").change(showUploadPreview);

function showUploadPreview() {

    var imageURL = window.URL.createObjectURL(document.getElementById("user_avatar_image_path").files[0]);
    console.log("Image:" + imageURL);
    $("#profile_pic").attr("src", imageURL);
    $("#upload_error").attr("style", "display: none");
}

function getHistoryTabContent() {

}