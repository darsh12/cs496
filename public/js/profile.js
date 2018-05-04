// Show preview of image selected to upload
$("#user_avatar_image_path").change(showUploadPreview);

// Collapse Card Content when card is clicked
$(".character").click(collapseCard);
$(".utility").click(collapseCard);

if(window.location.href.includes("history"))
    decollapseAllCards();

function collapseCard() {
    var card = $(this);

    if(card.hasClass("card-collapse"))
        card.removeClass("card-collapse");
    else
        card.addClass("card-collapse");
}

function decollapseAllCards() {
    $(".character").addClass("card-collapse");
    $(".utility").addClass("card-collapse");
}

function showUploadPreview() {

    var imageURL = window.URL.createObjectURL(document.getElementById("user_avatar_image_path").files[0]);
    console.log("Image:" + imageURL);
    $("#profile_pic").attr("src", imageURL);
    $("#upload_error").attr("style", "display: none");
}

function getDynamicHistoryContent(button, containerId, url) {

    $.ajax({
        // Using dynamic urls for now, may change if not secure enough
        url: url,
        // Successful Retrieval
        success:function(data)
        {
            $("#"+containerId).html(data);
            $(".history li").removeClass("current");
            $(button).addClass("current");
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}

// Return battle history macro for history item
function getBattleHistory(item) {
    var battleID = $(item).attr("data-value");

    $.ajax({
        // Using dynamic urls for now, may change if not secure enough
        url: '../history/'+battleID,
        // Successful Retrieval
        success:function(data)
        {
            $(".history_item_content").html("");
            $(item).next(".history_item_content").html(data);
            $(".battle_report").addClass("history");
            $(".battle_report").prev(".history_header").addClass("history");
            $(".col-3").attr("class", "col-2");
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}

function toggleReportExpand(report) {
    if($(report).hasClass("report_expand"))
        $(report).removeClass("report_expand")
    else
        $(report).addClass("report_expand")
}