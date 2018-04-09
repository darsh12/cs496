// Automatically click current sub-tab of current tab to retrieve content
window.onload = function() {
    console.log("loaded");
    $(".sub_tab.current").click();
};

// TODO: I think we should keep this dynamic if we're doing a lot of ajax retrievals (ex. dynamic URL, containerId)
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

    var tabName = $(button).attr("data-url");

    $.ajax({
        // Using dynamic urls for now, may change if not secure enough
        url: "/"+tabName,
        // Successful Retrieval
        success:function(data)
        {
            $("#dynamic_container").html(data);
            $(button).addClass("current");
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}