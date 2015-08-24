$('body').on('click', '.view-rejected-modal', function () {
    rejected_url = $(this).attr('href');

    $(".modal-layout-rejected").fadeIn();
    $("#modal-window-rejected").fadeIn();

    return false;
});

$("body").on('click', '.close-modal-rejected', function () {
    $(".modal-layout-rejected").fadeOut();
    $("#modal-window-rejected").fadeOut();
});

$("body").on('click', '.modal-layout-rejected', function () {
    $('.close-modal-rejected').click();
});

$("body").on('change', '#payment', function () {
    var money = $('#rejected-money').val();

    $('#ik_am').val(money);
    return false;
});

$('body').on('submit', '#modal-form-rejected', function () {
    var text = $('#rejected-text').val();
    $.ajax({
        type: 'POST',
        data: 'text=' + text,
        url: rejected_url,
        success: function (response) {
            if (response > 0) {
                $("#modal-window .content").html(response);
                $(".modal-layout-rejected").fadeOut();
                $("#modal-window-rejected").fadeOut();
                window.location.reload();
            }
        }
    });

    return false;
});

















