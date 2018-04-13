 require('../css/card-catalog.scss');

$(document).ready(function() {
    var cards = getCardArr();
    var elementSortBar = document.getElementById('sort-bar');

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

    $('#descBtn').click(function() {
        if(elementSortBar.className) {
            var prevSort = elementSortBar.className;

            switch(prevSort) {
                case 'name':
                    sortByNameDesc(cards);
                    break;
                case 'rating':
                    sortByRatingDesc(cards);
                    break;
                case 'type':
                    sortByTypeDesc(cards);
                    break;
                case 'class':
                    sortByClassDesc(cards);
                    break;
                case 'hitpoints':
                    sortByHitPointsDesc(cards);
                    break;
                case 'attack':
                    sortByAttackDesc(cards);
                    break;
                case 'defense':
                    sortByDefenseDesc(cards);
                    break;
                case 'speed':
                    sortBySpeedDesc(cards);
                    break;
                case 'luck':
                    sortByLuckDesc(cards);
                    break;
                case 'agility':
                    sortByAgilityDesc(cards);
            }

            setNewSortedView(cards);
        }
    });

    $('#ascBtn').click(function() {
        if(elementSortBar.className) {
            var prevSort = elementSortBar.className;

            switch(prevSort) {
                case 'name':
                    sortByNameAsc(cards);
                    break;
                case 'rating':
                    sortByRatingAsc(cards);
                    break;
                case 'type':
                    sortByTypeAsc(cards);
                    break;
                case 'class':
                    sortByClassAsc(cards);
                    break;
                case 'hitpoints':
                    sortByHitPointsAsc(cards);
                    break;
                case 'attack':
                    sortByAttackAsc(cards);
                    break;
                case 'defense':
                    sortByDefenseAsc(cards);
                    break;
                case 'speed':
                    sortBySpeedAsc(cards);
                    break;
                case 'luck':
                    sortByLuckAsc(cards);
                    break;
                case 'agility':
                    sortByAgilityAsc(cards);
            }

            setNewSortedView(cards);
        }
    });

    function getCardArr() {
        var cardsDict = [];

        var cardName = document.getElementsByClassName('cardName');
        var cardImg = document.getElementsByClassName('cardImage');
        var cardRating = document.getElementsByClassName('cardRating');
        var cardType = document.getElementsByClassName('cardType');
        var cardClass = document.getElementsByClassName('cardClass');
        var cardHitPoints = document.getElementsByClassName('cardHitPoints');
        var cardAttack = document.getElementsByClassName('cardAttack');
        var cardDefense = document.getElementsByClassName('cardDefense');
        var cardSpeed = document.getElementsByClassName('cardSpeed');
        var cardLuck = document.getElementsByClassName('cardLuck');
        var cardAgility = document.getElementsByClassName('cardAgility');

        for(var i = 0; i < cardName.length; i++) {
            cardsDict[i] = [];
            cardsDict[i].push({name : cardName[i].innerHTML});
            cardsDict[i].push({img : cardImg[i].src});
            cardsDict[i].push({rating : cardRating[i].innerHTML});
            cardsDict[i].push({type : cardType[i].innerHTML});
            cardsDict[i].push({class : cardClass[i].innerHTML});
            cardsDict[i].push({hitPoints : cardHitPoints[i].innerHTML});
            cardsDict[i].push({attack : cardAttack[i].innerHTML});
            cardsDict[i].push({defense : cardDefense[i].innerHTML});
            cardsDict[i].push({speed : cardSpeed[i].innerHTML});
            cardsDict[i].push({luck : cardLuck[i].innerHTML});
            cardsDict[i].push({agility : cardAgility[i].innerHTML});
        }

        return cardsDict;
    }

    function setNewSortedView(cards) {
        var cardName = document.getElementsByClassName('cardName');
        var cardImg = document.getElementsByClassName('cardImage');
        var cardRating = document.getElementsByClassName('cardRating');
        var cardType = document.getElementsByClassName('cardType');
        var cardClass = document.getElementsByClassName('cardClass');
        var cardHitPoints = document.getElementsByClassName('cardHitPoints');
        var cardAttack = document.getElementsByClassName('cardAttack');
        var cardDefense = document.getElementsByClassName('cardDefense');
        var cardSpeed = document.getElementsByClassName('cardSpeed');
        var cardLuck = document.getElementsByClassName('cardLuck');
        var cardAgility = document.getElementsByClassName('cardAgility');

        for(var i = 0; i < cards.length; i++) {
            cardName[i].innerHTML = cards[i][0].name;
            cardImg[i].src = cards[i][1].img;
            cardRating[i].innerHTML = cards[i][2].rating;
            cardType[i].innerHTML = cards[i][3].type;
            cardClass[i].innerHTML = cards[i][4].class;
            cardHitPoints[i].innerHTML = cards[i][5].hitPoints;
            cardAttack[i].innerHTML = cards[i][6].attack;
            cardDefense[i].innerHTML = cards[i][7].defense;
            cardSpeed[i].innerHTML = cards[i][8].speed;
            cardLuck[i].innerHTML = cards[i][9].luck;
            cardAgility[i].innerHTML = cards[i][10].agility;
        }
    }

    function sortByNameDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('name');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            var x = b[0].name.toLowerCase(), y = a[0].name.toLowerCase();

            if(x === y)
            {
                a[2].rating - b[2].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByNameAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('name');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

            if(x === y)
            {
                a[2].rating - b[2].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByTypeDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('type');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            var x = b[3].type.toLowerCase(), y = a[3].type.toLowerCase();

            if(x === y)
            {
                a[2].rating - b[2].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByTypeAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('type');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            var x = a[3].type.toLowerCase(), y = b[3].type.toLowerCase();

            if(x === y)
            {
                a[2].rating - b[2].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByClassDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('class');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            var x = b[4].class.toLowerCase(), y = a[4].class.toLowerCase();

            if(x === y)
            {
                a[2].rating - b[2].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByClassAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('class');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            var x = a[4].class.toLowerCase(), y = b[4].class.toLowerCase();

            if(x === y)
            {
                a[2].rating - b[2].rating
            }
            return x < y ? -1 : x > y ? 1 : 0;
        });

        return cards;
    }

    function sortByRatingDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('rating');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[2].rating === b[2].rating)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[2].rating - a[2].rating
        });

        return cards;
    }

    function sortByRatingAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('rating');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[2].rating === b[2].rating)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[2].rating - b[2].rating
        });

        return cards;
    }

    function sortByHitPointsDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('hitpoints');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[5].hitPoints === b[5].hitPoints)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[5].hitPoints - a[5].hitPoints
        });

        return cards;
    }

    function sortByHitPointsAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('hitpoints');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[5].hitPoints === b[5].hitPoints)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[5].hitPoints - b[5].hitPoints
        });

        return cards;
    }

    function sortByAttackDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('attack');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[6].attack === b[6].attack)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[6].attack - a[6].attack
        });

        return cards;
    }

    function sortByAttackAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('attack');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[6].attack === b[6].attack)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[6].attack - b[6].attack
        });

        return cards;
    }

    function sortByDefenseDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('defense');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[7].defense === b[7].defense)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[7].defense - a[7].defense
        });

        return cards;
    }

    function sortByDefenseAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('defense');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[7].defense === b[7].defense)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[7].defense - b[7].defense
        });

        return cards;
    }

    function sortBySpeedDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('speed');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[8].speed === b[8].speed)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[8].speed - a[8].speed
        });

        return cards;
    }

    function sortBySpeedAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('speed');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[8].speed === b[8].speed)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[8].speed - b[8].speed
        });

        return cards;
    }

    function sortByLuckDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('luck');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[9].luck === b[9].luck)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[9].luck - a[9].luck
        });

        return cards;
    }

    function sortByLuckAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('luck');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[9].luck === b[9].luck)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[9].luck - b[9].luck
        });

        return cards;
    }

    function sortByAgilityDesc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('agility');
        $('#descBtn').hide();
        $('#ascBtn').show();

        cards.sort(function(a, b){
            if(a[10].agility === b[10].agility)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return b[10].agility - a[10].agility
        });

        return cards;
    }

    function sortByAgilityAsc(cards) {
        elementSortBar.classList.remove(elementSortBar.classList[0]);
        elementSortBar.classList.add('agility');
        $('#ascBtn').hide();
        $('#descBtn').show();

        cards.sort(function(a, b){
            if(a[10].agility === b[10].agility)
            {
                var x = a[0].name.toLowerCase(), y = b[0].name.toLowerCase();

                return x < y ? -1 : x > y ? 1 : 0;
            }
            return a[10].agility - b[10].agility
        });

        return cards;
    }
});