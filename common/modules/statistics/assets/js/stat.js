$('document').ready(function () {
    func = function () {
        $.ajax({
            url: "/statistics/ajax/get",
            dataType: 'json',
            success: function (data) {
                $('#stat_done_vk').text(data['stat_done_vk']);
                $('#stat_subscriber_vk').text(data['stat_subscriber_vk']);
                $('#stat_like_vk').text(data['stat_like_vk']);
                $('#stat_repost_vk').text(data['stat_repost_vk']);
            }
        });

    };

    intervalID = window.setInterval(func, 20000)
});

















