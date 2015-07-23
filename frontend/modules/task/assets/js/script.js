$('#like-form').on('change', function() {
    var price_per_one = $('.price_per_one_task').val();
    var members_count = $('.members_count').val();

    $('.sum').val(price_per_one * members_count);
});