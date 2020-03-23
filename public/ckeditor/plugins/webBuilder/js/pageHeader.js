$(function() {
    $(document).on('click', '.savePageHeader', function() {
        $(current_element).parent().children('.page-header').html('<h1>' + $(this).closest('.modal').find('.header').val() + ' <small>' + $(this).closest('.modal').find('.subtext').val() + '</small></h1>');
        $(this).closest('.modal').modal('hide')
    })
});

function load_pageHeader(el) {
    $('#bootstrapPageHeader').find('.subtext').val($(el).closest('.webBuilder_wrapper').find('small').html().replace(new RegExp('	', 'g'), ''));
    var header = $(el).closest('.webBuilder_wrapper').find('h1');
    $(header).find('small').remove();
    $('#bootstrapPageHeader').find('.header').val($(header).html().replace(new RegExp('	', 'g'), ''))
};