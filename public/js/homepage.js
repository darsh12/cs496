function toggleCurrentTab(tab) {
    $(".nav nav-tabs tab_style li").removeClass('current');
    $(tab).addClass('current');
}