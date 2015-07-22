$('#likeForm').on('change', function () {
    var minimum_likes_per_task = $('.minimum_likes_per_task').val();
    var minimum_tasks = $('.minimum_tasks').val();

    $('.minimum_all_likes').val(minimum_likes_per_task * minimum_tasks);

    var price_per_one_task = $('.price_per_one_task').val();
    $('.minimum_price_per_task').val(price_per_one_task * minimum_tasks);
});