/**
 * TOOLS PANEL
 * */
$('.tools[data-widget="collapse"]').on('click', function () {
    $(this).parents('.ui.top')
        .next('.ui.body')
        .slideToggle(300);
});

$('.tools[data-widget="remove"]').on('click', function () {
    $(this).parents('.ui.top')
        .hide()
        .next('.ui.body')
        .hide();
});
