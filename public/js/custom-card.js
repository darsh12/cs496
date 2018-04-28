require('../css/custom-card.scss');

$(document).ready(function() {
    $('input[type=range]').on('input', function () {
        $(this).parent().parent().children().last().children().first().text($(this).val());
    });

    $('.confirmAccept').on('click', function() {
        if(confirmAccept()) {
            $.ajax({
                url: $(this).data('url'),
                method: 'POST',
                error: function () {
                    location.reload();
                },
            }).done(function () {
                setTimeout(function () {
                    location.reload();
                }, 500)
            });
        }
    });

    $('.confirmRemove').on('click', function() {
        console.log($(this).data('url'));
        if(confirmRemove()) {
            $.ajax({
                url: $(this).data('url'),
                method: 'POST',
                error: function () {
                    location.reload();
                },
            }).done(function () {
                setTimeout(function () {
                    location.reload();
                }, 500)
            });
        }
    });

    $('.confirmUpVote').on('click', function() {
        if(confirmUpVote()) {
            $.ajax({
                url: $(this).data('url'),
                method: 'POST',
                error: function () {
                    location.reload();
                },
            }).done(function () {
                setTimeout(function () {
                    location.reload();
                }, 500)
            });
        }
    });

    $('.confirmDownVote').on('click', function() {
        if(confirmDownVote()) {
            $.ajax({
                url: $(this).data('url'),
                method: 'POST',
                error: function () {
                    location.reload();
                },
            }).done(function () {
                setTimeout(function () {
                    location.reload();
                }, 500)
            });
        }
    });

    $('.confirmAdd').on('click', function() {
        if(confirmAdd()) {
            $.ajax({
                url: $(this).data('url'),
                method: 'POST',
                error: function () {
                    location.reload();
                },
            }).done(function () {
                setTimeout(function () {
                    location.reload();
                }, 500)
            });
        }
    });
});

function confirmAccept() {
    return confirm('Are you sure you want to accept this custom card');
}

function confirmRemove() {
    return confirm('Are you sure you want to remove this custom card');
}

function confirmUpVote() {
    return confirm('Are you sure you want to up vote this custom card');
}

function confirmDownVote() {
    return confirm('Are you sure you want to down vote this custom card');
}

function confirmAdd() {
    return confirm('Are you sure you want to add this custom card');
}

