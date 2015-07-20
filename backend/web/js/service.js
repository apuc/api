$('#likeForm').on('change', function () {
    var minimum_likes_per_task = $('.minimum_likes_per_task').val();
    var minimum_tasks = $('.minimum_tasks').val();

    console.log(minimum_likes_per_task * minimum_tasks);

    $('.minimum_all_likes').val(minimum_likes_per_task * minimum_tasks);

    var minimum_all_likes = $('.minimum_all_likes').val();

    var price_per_like = $('.price_per_like').val();
    $('.minimum_price_per_task').val(price_per_like * minimum_all_likes);
});