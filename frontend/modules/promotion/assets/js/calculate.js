$('body').on('change', '.members_count_like', function () {
    var members_count_like = $(this).val();
    var price_per_one_task_like = $('.price_per_one_task_like').val();

    $('.sum_like').val(members_count_like * price_per_one_task_like);
});

$('body').on('change', '.members_count_repost', function () {
    var members_count_repost = $(this).val();
    var price_per_one_task_repost = $('.price_per_one_task_repost').val();

    $('.sum_repost').val(members_count_repost * price_per_one_task_repost);
});

$('body').on('change', '.members_count_comment', function () {
    var members_count_comment = $(this).val();
    var price_per_one_task_comment = $('.price_per_one_task_comment').val();

    $('.sum_comment').val(members_count_comment * price_per_one_task_comment);
});