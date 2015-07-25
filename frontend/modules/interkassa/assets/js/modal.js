$('body').on('click', '#view-interkassa-modal', function () {
    var url = $(this).attr('href');

    $(".modal-layout-interkassa").fadeIn();
    $("#modal-window-interkassa").fadeIn();

    return false;
});

$("body").on('click', '.close-modal', function () {
    $(".modal-layout-interkassa").fadeOut();
    $("#modal-window-interkassa").fadeOut();
});

$("body").on('click', '.modal-layout-interkassa', function () {
    $('.close-modal-interkassa').click();
});

$("body").on('change', '#payment', function () {
    var money = $('#interkassa-money').val();

    $('#ik_am').val(money);
    return false;
});


















