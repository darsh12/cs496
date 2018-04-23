function showPlayerPopup(element)
{
   var name = $(element).attr('data-name');
   var requestButton = $("#requestButton");
   requestButton.html("Loading...");
    $(".modal-body").html("");
    $("#request_error").html("");


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
            // Fill dynamic Modal content
            requestButton.attr("onclick", "beginRequest(this);");
            requestButton.html("Choose Decks to Battle");
            // requestButton.attr("data-dismiss", "");

            requestButton.attr("data-name", name);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

function beginRequest(element) {

    var requestButton = $("#requestButton");
    requestButton.html("Loading...");

    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/deck_setup',
        type: "POST",
        // Successful Retrieval
        success:function(data)
        {
            $(".modal-body").html(data);
            // Fill dynamic Modal content
            requestButton.attr("onclick", "sendRequest(this);");
            // requestButton.attr("data-dismiss", "modal");
            requestButton.html("Confirm Decks and Send Battle Request");
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

function selectCharDeck(element) {
    $(".char_deck_current").removeClass("char_deck_current");
    $(element).addClass("char_deck_current");
}

function selectUtilDeck(element) {
    $(".util_deck_current").removeClass("util_deck_current");
    $(element).addClass("util_deck_current");
}

function sendRequest(element) {

    var requestButton = $("#requestButton");
    requestButton.attr("onclick", "");
    requestButton.html("Loading...");

    var defName = $(element).attr('data-name');
    var attCharDeckID = $(".card.js-deck-item.char_deck_current").attr("data-id");
    var attUtilDeckID = $(".card.js-deck-item.util_deck_current").attr("data-id");


    // TODO: validate decks are chosen before sending request and closing modal
    if(attCharDeckID == null || attUtilDeckID == null) {
        $("#request_error").html("Choose both a character and utility deck before confirming.")
        return;
    }

    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/request',
        type: "POST",
        data: {
            defName: defName,
            attCharDeckID: attCharDeckID,
            attUtilDeckID: attUtilDeckID
        },
        // Successful Retrieval
        success:function(data)
        {
            $('#playerModal').modal('hide')
            $(".modal-backdrop.show").remove();
            $("body").append(data);
            $(".notify_container").slideDown(600);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}

