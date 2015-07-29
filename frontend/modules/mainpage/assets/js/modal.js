$('body').on('click', '.warning', function () {

    $(".modal-layout-nologin").fadeIn();
    $(".modal-window-nologin").fadeIn();

    return false;
});

$("body").on('click', '.close-modal-nologin', function () {
    $(".modal-layout-nologin").fadeOut();
    $(".modal-window-nologin").fadeOut();
});

$("body").on('click', '.modal-layout-nologin', function () {
    $('.close-modal-nologin').click();
});


















