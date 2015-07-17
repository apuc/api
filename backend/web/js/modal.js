$('body').on('click', '.view-action-btn', function () {
    var url = $(this).attr('href');
    $.ajax({
        type: 'POST',
        url: url,
        success: function (response) {
            $("#modal-window .content").html(response);
            $(".modal-layout").fadeIn();
            $("#modal-window").fadeIn();
        }
    });
    return false;
});

$("body").on('click', '.close-modal', function () {
    $(".modal-layout").fadeOut();
    $("#modal-window").fadeOut();
});

$("body").on('click', '.modal-layout', function () {
    $('.close-modal').click();
});

$('body').on('submit', '#modal-feedback', function () {

    var post = $('#modal-feedback').serialize();

    $.ajax({
        type: 'POST',
        url: '/secure/feedback/ajax/send-mail',
        data: post,
        success: function (response) {
            if (response)
                location.reload();
            else
                alert('You shell not pass!!! © Gandalf the Grey')
        }
    });


    return false;
});
















