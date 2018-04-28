// Initialize popovers for stats page
// $(function () {
//     $('button[data-toggle="popover"]').popover()
// });
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

// Appends rendered twig to container with given ID
function getDynamicTwigContent(button, containerId, url) {

    $.ajax({
        // Using dynamic urls for now, may change if not secure enough
        url: url,
        // Successful Retrieval
        success:function(data)
        {
            $("#"+containerId).append(data);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}


// AJAX function for tabs
function getDynamicTabContent(button) {
    
    // Temp way to remove notification popups
    $(".notify_container").remove();

    var tabName = $(button).attr("data-url");

    $.ajax({
        url: "/"+tabName,
        // Successful Retrieval
        success:function(data)
        {
            $("#dynamic_container").html(data);
            $(".sub_tab.current").removeClass("current");
            $(button).addClass("current");

            // Set onsubmit handler for avatar image upload form
            initializeSubmitListener();
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}

// Close Notification popup
function closeNotification(element) {
    $(element).slideUp("fast", function() {
        $(element).remove();
    });
}