function showPlayerPopup(element)
{
   var name = $(element).attr('data-name');

   var requestButton = $("#requestButton");

    // Fill dynamic Modal content
    requestButton.attr("onclick", "beginRequest(this);");
    requestButton.html("Choose Decks to Battle");
    requestButton.attr("data-dismiss", "");

    requestButton.attr("data-name", name);

    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/popup',
        type: "POST",
        data: {
            name: name
        },
        // Successful Retrieval
        success:function(data)
        {
            $(".modal-body").html(data);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

function beginRequest(element) {

    var requestButton = $("#requestButton");

    var name = $(element).attr('data-name');

    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/deck_setup',
        type: "POST",
        data: {
            name: name
        },
        // Successful Retrieval
        success:function(data)
        {
            $(".modal-body").html(data);
            // Fill dynamic Modal content
            requestButton.attr("onclick", "sendRequest(this);");
            requestButton.attr("data-dismiss", "modal");
            requestButton.html("Confirm Decks and Send Battle Request");
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

function sendRequest(element) {

    var name = $(element).attr('data-name');

    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/request',
        type: "POST",
        data: {
            name: name
        },
        // Successful Retrieval
        success:function(data)
        {
            $(".player_list").append(data);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}

