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