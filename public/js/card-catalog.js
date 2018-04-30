require('../css/card-catalog.scss');

$(document).ready(function() {
    var cards = getCardArr();
    var elementSortBar = document.getElementById('sort-bar');

    // by default, the controller shows the cards in rating descending order
    // need to hide descending btn and show just the ascending button
    $('#descBtn').hide();
    $('#ascBtn').show();

    // each card attribute button will apply the specified sort function by descending order
    // and perform the view function to change the order of the cards on the page by the sort
    $('#nameBtn').click(function() {
        sortByNameDesc(cards);
        setNewSortedView(cards);
    });

    $('#ratingBtn').click(function() {
        sortByRatingDesc(cards);
        setNewSortedView(cards);
    });

    $('#typeBtn').click(function() {
        sortByTypeDesc(cards);
        setNewSortedView(cards);
    });

    $('#classBtn').click(function() {
        sortByClassDesc(cards);
        setNewSortedView(cards);
    });

    $('#hpBtn').click(function() {
        sortByHitPointsDesc(cards);
        setNewSortedView(cards);
    });

    $('#attBtn').click(function() {
        sortByAttackDesc(cards);
        setNewSortedView(cards);
    });

    $('#defBtn').click(function() {
        sortByDefenseDesc(cards);
        setNewSortedView(cards);
    });

    $('#spdBtn').click(function() {
        sortBySpeedDesc(cards);
        setNewSortedView(cards);
    });

    $('#lckBtn').click(function() {
        sortByLuckDesc(cards);
        setNewSortedView(cards);
    });

    $('#agiBtn').click(function() {
        sortByAgilityDesc(cards);
        setNewSortedView(cards);
    });

    // the descending and ascending functions are grabbing the previous sort from a class name of the element sort bar
    // based on the class name, the descending or ascending function will pick the specified sort and perform the opposite order
    $('#descBtn').click(function() {
        if(elementSortBar.className) {
            var prevSort = elementSortBar.className;

            switch(prevSort) {
                case 'sortName':
                    sortByNameDesc(cards);
                    break;
                case 'sortRating':
                    sortByRatingDesc(cards);
                    break;
                case 'sortType':
                    sortByTypeDesc(cards);
                    break;
                case 'sortClass':
                    sortByClassDesc(cards);
                    break;
                case 'sortHitpoints':
                    sortByHitPointsDesc(cards);
                    break;
                case 'sortAttack':
                    sortByAttackDesc(cards);
                    break;
                case 'sortDefense':
                    sortByDefenseDesc(cards);
                    break;
                case 'sortSpeed':
                    sortBySpeedDesc(cards);
                    break;
                case 'sortLuck':
                    sortByLuckDesc(cards);
                    break;
                case 'sortAgility':
                    sortByAgilityDesc(cards);
            }

            setNewSortedView(cards);
        }
    });

    $('#ascBtn').click(function() {
        if(elementSortBar.className) {
            var prevSort = elementSortBar.className;

            switch(prevSort) {
                case 'sortName':
                    sortByNameAsc(cards);
                    break;
                case 'sortRating':
                    sortByRatingAsc(cards);
                    break;
                case 'sortType':
                    sortByTypeAsc(cards);
                    break;
                case 'sortClass':
                    sortByClassAsc(cards);
                    break;
                case 'sortHitpoints':
                    sortByHitPointsAsc(cards);
                    break;
                case 'sortAttack':
                    sortByAttackAsc(cards);
                    break;
                case 'sortDefense':
                    sortByDefenseAsc(cards);
                    break;
                case 'sortSpeed':
                    sortBySpeedAsc(cards);
                    break;
                case 'sortLuck':
                    sortByLuckAsc(cards);
                    break;
                case 'sortAgility':
                    sortByAgilityAsc(cards);
            }

            setNewSortedView(cards);
        }
    });

    // initializing a javascript array of structs by collecting all specified values within a card attribute class
    function getCardArr() {
        var cardsDict = [];

        var cardTier = document.getElementsByClassName('character');
        var cardName = document.getElementsByClassName('char_name');
        var cardImg = document.getElementsByClassName('char_img');
        var cardType = document.getElementsByClassName('char_type');
        var cardClass = document.getElementsByClassName('char_class');
        var cardRating = document.getElementsByClassName('char_rating');
        var cardHitPoints = document.getElementsByClassName('hitpoints');
        var cardAttack = document.getElementsByClassName('attack');
        var cardDefense = document.getElementsByClassName('defense');
        var cardLuck = document.getElementsByClassName('luck');
        var cardAgility = document.getElementsByClassName('agility');
        var cardSpeed = document.getElementsByClassName('speed');
        var cardPrice = document.getElementsByClassName('price');
        var cardId = document.getElementsByClassName('character');
        var buyId = document.getElementsByClassName('js-card-buy');

        for(var i = 0; i < cardName.length; i++) {
            cardsDict[i] = [];
            cardsDict[i].push({tier : cardTier[i].childNodes[1].classList[1]});
            cardsDict[i].push({name : cardName[i].innerHTML});
            cardsDict[i].push({img : cardImg[i].src});
            cardsDict[i].push({type : cardType[i].innerHTML});
            cardsDict[i].push({class : cardClass[i].innerHTML});
            cardsDict[i].push({rating : cardRating[i].innerHTML});
            cardsDict[i].push({hitPoints : cardHitPoints[i].innerHTML});
            cardsDict[i].push({attack : cardAttack[i].innerHTML});
            cardsDict[i].push({defense : cardDefense[i].innerHTML});
            cardsDict[i].push({luck : cardLuck[i].innerHTML});
            cardsDict[i].push({agility : cardAgility[i].innerHTML});
            cardsDict[i].push({speed : cardSpeed[i].innerHTML});
            cardsDict[i].push({price : cardPrice[i].innerHTML});
            cardsDict[i].push({id : cardId[i].classList[1]});
            cardsDict[i].push({buyId : buyId[i].getAttribute('data-url')});
        }

        return cardsDict;
    }

    // rearranging the dom document card views based on the specified sort
    function setNewSortedView(cards) {
        var cardTier = document.getElementsByClassName('character');
        var cardName = document.getElementsByClassName('char_name');
        var cardImg = document.getElementsByClassName('char_img');
        var cardType = document.getElementsByClassName('char_type');
        var cardClass = document.getElementsByClassName('char_class');
        var cardRating = document.getElementsByClassName('char_rating');
        var cardHitPoints = document.getElementsByClassName('hitpoints');
        var cardAttack = document.getElementsByClassName('attack');
        var cardDefense = document.getElementsByClassName('defense');
        var cardLuck = document.getElementsByClassName('luck');
        var cardAgility = document.getElementsByClassName('agility');
        var cardSpeed = document.getElementsByClassName('speed');
        var cardPrice = document.getElementsByClassName('price');
        var cardId = document.getElementsByClassName('character');
        var buyId = document.getElementsByClassName('js-card-buy');

        for(var i = 0; i < cards.length; i++) {
            var tierClassName = cardTier[i].childNodes[1].classList[1];
            cardTier[i].childNodes[1].classList.remove(tierClassName);
            cardTier[i].childNodes[1].classList.add(cards[i][0].tier);
            cardName[i].innerHTML = cards[i][1].name;
            cardImg[i].src = cards[i][2].img;
            cardType[i].innerHTML = cards[i][3].type;
            cardClass[i].innerHTML = cards[i][4].class;
            cardRating[i].innerHTML = cards[i][5].rating;
            cardHitPoints[i].innerHTML = cards[i][6].hitPoints;
            cardAttack[i].innerHTML = cards[i][7].attack;
            cardDefense[i].innerHTML = cards[i][8].defense;
            cardLuck[i].innerHTML = cards[i][9].luck;
            cardAgility[i].innerHTML = cards[i][10].agility;
            cardSpeed[i].innerHTML = cards[i][11].speed;
            cardPrice[i].innerHTML = cards[i][12].price;
            var idClassName = cardId[i].classList[1];
            cardId[i].classList.remove(idClassName);
            cardId[i].classList.add(cards[i][13].id);
            buyId[i].setAttribute('data-url', '/inventory/buy/' + cards[i][13].id + '/char');
        }
    }

    // each sort function removes and places a new class for the sort bar element to define what will be the previous sort
    // then the sort function is applied with either the letter sort followed by the integer sort or vice versa
    // if letter sort is secondary sort, always performed by ascending order (A-Z)
    // if integer sort is secondary sort, always performed by descending order (99-0)
    function sortByNameDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortName');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            var x = b[1].name.toLowerCase(), y = a[1].name.toLowerCase();

            if(x === y)
            {
                a[5].rating - b[5].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByNameAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortName');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

            if(x === y)
            {
                a[5].rating - b[5].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByTypeDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortType');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            var x = b[3].type.toLowerCase(), y = a[3].type.toLowerCase();

            if(x === y)
            {
                a[5].rating - b[5].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByTypeAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortType');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            var x = a[3].type.toLowerCase(), y = b[3].type.toLowerCase();

            if(x === y)
            {
                a[5].rating - b[5].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByClassDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortClass');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            var x = b[4].class.toLowerCase(), y = a[4].class.toLowerCase();

            if(x === y)
            {
                a[5].rating - b[5].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByClassAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortClass');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            var x = a[4].class.toLowerCase(), y = b[4].class.toLowerCase();

            if(x === y)
            {
                a[5].rating - b[5].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByRatingDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortRating');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[5].rating === b[5].rating)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[5].rating - a[5].rating
        });

        return cards;
    }

    function sortByRatingAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortRating');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[5].rating === b[5].rating)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[5].rating - b[5].rating
        });

        return cards;
    }

    function sortByHitPointsDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortHitpoints');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[6].hitPoints === b[6].hitPoints)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[6].hitPoints - a[6].hitPoints
        });

        return cards;
    }

    function sortByHitPointsAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortHitpoints');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[6].hitPoints === b[6].hitPoints)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[6].hitPoints - b[6].hitPoints
        });

        return cards;
    }

    function sortByAttackDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortAttack');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[7].attack === b[7].attack)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[7].attack - a[7].attack
        });

        return cards;
    }

    function sortByAttackAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortAttack');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[7].attack === b[7].attack)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[7].attack - b[7].attack
        });

        return cards;
    }

    function sortByDefenseDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortDefense');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[8].defense === b[8].defense)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[8].defense - a[8].defense
        });

        return cards;
    }

    function sortByDefenseAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortDefense');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[8].defense === b[8].defense)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[8].defense - b[8].defense
        });

        return cards;
    }

    function sortByLuckDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortLuck');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[9].luck === b[9].luck)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[9].luck - a[9].luck
        });

        return cards;
    }

    function sortByLuckAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortLuck');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[9].luck === b[9].luck)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[9].luck - b[9].luck
        });

        return cards;
    }

    function sortByAgilityDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortAgility');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[10].agility === b[10].agility)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[10].agility - a[10].agility
        });

        return cards;
    }

    function sortByAgilityAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortAgility');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[10].agility === b[10].agility)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[10].agility - b[10].agility
        });

        return cards;
    }

    function sortBySpeedDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortSpeed');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[11].speed === b[11].speed)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[11].speed - a[11].speed
        });

        return cards;
    }

    function sortBySpeedAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('sortSpeed');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[11].speed === b[11].speed)
            {
                var x = a[1].name.toLowerCase(), y = b[1].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[11].speed - b[11].speed
        });

        return cards;
    }
});