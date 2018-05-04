// Show popup of card info when clicking card item in deck
function showCardPopup(element, type) {

    var cardID = $(element).attr('data-value');

    $(element).append("<label id='load_msg'>&nbsp;&nbsp;Loading...</label>");

    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/card_popup',
        type: "POST",
        data: {
            cardID: cardID,
            type: type
        },
        // Successful Retrieval
        success:function(data)
        {
            //TODO: append card popup to proper position
            // TODO: change styling of deck items for onclick (add dialog icon)
            $("#load_msg").remove();
            $("body").append(data);
            $(".card_popup").slideDown(600);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}


function showPlayerPopup(element)
{
   var name = $(element).attr('data-name');
   var requestButton = $("#requestButton");
   requestButton.html("Loading...");

    // Hide Decline button, remove its data attr and onclick
    var declineButton = $("#declineButton");
    declineButton.attr("style", "display: none");
    declineButton.attr("data-request", "");
    declineButton.attr("onclick", "");


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

            if(!$('#charDeck .js-deck-item').is(':visible') || !$('#utilDeck .js-deck-item').is(':visible')) {
                alert('Must have at least one character deck and one utility deck built before attempting a battle');
                window.location.href = "/user/decks";
            }

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

function showReceivedPopup(element)
{
    var name = $(element).attr('data-name');
    var requestid = $(element).attr('data-name2');

    var requestButton = $("#requestButton");
    requestButton.html("Loading...");

    var declineButton = $("#declineButton");


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

            // Transform Request button into Accept button
            requestButton.attr("onclick", "acceptBattle(this);");
            requestButton.html("Accept");
            requestButton.attr("data-name2", requestid);
            requestButton.attr("data-name", name);

            // Show Decline button, set its data attr and onclick
            declineButton.attr("style", "display: block");
            declineButton.attr("data-request", requestid);
            declineButton.attr("onclick", "declineBattle(this)");
            declineButton.html("Decline");

        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

// Close modal on return and delete battle request records server side
function declineBattle(element) {

    $(element).html("Loading...");
    $(element).attr("onclick", "");

    var requestButton = $("#requestButton");
    requestButton.attr("onclick", "");

    var requestID = $(element).attr("data-request");

    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/decline',
        type: "POST",
        data: {
            requestID: requestID
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

var acceptedBattleRequestID;
var acceptedBattleAttackerName;
var acceptedBattleUtilID;

// Change view of screen to let defender choose util cards, eventually peek at attacker's if applicable
function acceptBattle(element) {

    acceptedBattleRequestID = $(element).attr("data-name2");
    acceptedBattleAttackerName = $(element).attr("data-name");

    $("#dynamic_container").html("Loading Deck Selection...");

    $('#playerModal').modal('hide')
    $(".modal-backdrop.show").remove();

    var requestButton = $("#requestButton");
    requestButton.html("Loading...");

    $.ajax({

        url: '/battle/defender_util_setup',
        type: "POST",
        // Successful Retrieval
        success:function(data)
        {
            $("#dynamic_container").html(data);
            $(".row").slideDown();
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

function confirmUtil(element) {

    acceptedBattleUtilID = $(".card.js-deck-item.util_deck_current").attr("data-id");
    if(acceptedBattleUtilID == null) {

        $("#request_error").html("Choose a utility deck before confirming.")
        return;
    }
    $(element).html("Confirming...");

    $.ajax({

        url: '/battle/defender_char_setup',
        type: "POST",
        data: {
            defUtilDeck: acceptedBattleUtilID,
            request: acceptedBattleRequestID
        },
        // Successful Retrieval
        success:function(data)
        {
            $("#dynamic_container").html(data);
            $(".row").slideDown();


            // Set onclick handlers for collapse
            $(".character").click(collapseCard);
            $(".utility").click(collapseCard);

            decollapseAllCards();
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

// Sends data to insert Battle Record
function startBattle(element){

    var attName = acceptedBattleAttackerName;
    var requestid = acceptedBattleRequestID;

    var defCharDeckID = $(".card.js-deck-item.char_deck_current").attr("data-id");
    var defUtilDeckID = acceptedBattleUtilID;

    if(defCharDeckID == null) {

        $("#request_error").html("Choose a character deck before starting.")
        return;
    }

    $(element).html("Starting...");

    $.ajax({

        url: '/battle/start',
        type: "POST",
        data: {
            attName: attName,
            requestID: requestid,
            defCharDeckID: defCharDeckID,
            defUtilDeckID: defUtilDeckID
        },
        // Successful Retrieval
        success:function(data)
        {
            $("#dynamic_container").html(data);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}

function showBattleResults(element){


    var requestid = $(element).attr("data-name2");

    $(element).append("<label>Loading...</label>");

    $.ajax({

        url: '/battle/results',
        type: "POST",
        data: {
            requestID: requestid
        },
        // Successful Retrieval
        success:function(data)
        {
            $("#dynamic_container").html(data);
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });
}

function sendRequest(element) {

    var requestButton = $("#requestButton");
    requestButton.attr("onclick", "");
    requestButton.html("Loading...");

    var defName = $(element).attr('data-name');
    var attCharDeckID = $(".card.js-deck-item.char_deck_current").attr("data-id");
    var attUtilDeckID = $(".card.js-deck-item.util_deck_current").attr("data-id");


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

function selectCharDeck(element) {
    $(".char_deck_current").removeClass("char_deck_current");
    $(element).addClass("char_deck_current");
}

function selectUtilDeck(element) {
    $(".util_deck_current").removeClass("util_deck_current");
    $(element).addClass("util_deck_current");
}


function showLeaderboardPopup(element)
{
    var name = $(element).attr('data-name');
    $(".modal-body").html("Loading...");
    $("#request_error").html("");


    $.ajax({

        // Using dynamic urls for now, may change if not secure enough
        url: '/battle/leaderboard-popup',
        type: "POST",
        data: {
            name: name
        },
        // Successful Retrieval
        success:function(data)
        {
            $(".modal-body").html(data);
            // Fill dynamic Modal content
        },
        // Failed Retrieval
        error: function(data)
        {
        }
    });

}

function requestTabs(tabName) {
    var i;
    var x = document.getElementsByClassName("request_tab_content");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(tabName).style.display = "block";

}

function requestTabCurrent(element){
    $(".request_tab_current").removeClass("request_tab_current");
    $(element).addClass("request_tab_current");
}

