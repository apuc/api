$('.members_count').on('change', function () {
    var price_per_one_task = $('.price_per_one_task').val();
    var members_count = $('.members_count').val();

    $('.sum').val(price_per_one_task * members_count);
});

$('body').on('click', '.repeat', function () {
    return confirm('Вы подтверждаете повторную выдачу задания? (Сумма будет списана повторно.)');
});