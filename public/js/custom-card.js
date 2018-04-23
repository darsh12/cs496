require('../css/custom-card.scss');

$(document).ready(function() {
    $('input[type=range]').on('input', function () {
        $(this).parent().parent().children().last().children().first().text($(this).val());
    });
});