$(function() {
    $(document).on('click', '.savePanel', function() {
        var panel = $(current_element).parent().children('.panel');
        $(panel).attr('class', '').addClass('panel').addClass($(this).closest('.modal').find('.style').val());
        $(panel).find('.panel-title').html($(this).closest('.modal').find('.title').val());
        $(panel).find('.panel-body').html($(this).closest('.modal').find('.content').val());
        $(this).closest('.modal').modal('hide')
    })
});

function load_panels(el) {
    var style = '';
    if ($(el).closest('.webBuilder_wrapper').find('.panel').hasClass('panel-default')) {
        style = 'panel-default'
    } else if ($(el).closest('.webBuilder_wrapper').find('.panel').hasClass('panel-danger')) {
        style = 'panel-danger'
    } else if ($(el).closest('.webBuilder_wrapper').find('.panel').hasClass('panel-info')) {
        style = 'panel-info'
    } else if ($(el).closest('.webBuilder_wrapper').find('.panel').hasClass('panel-primary')) {
        style = 'panel-primary'
    } else if ($(el).closest('.webBuilder_wrapper').find('.panel').hasClass('panel-success')) {
        style = 'panel-success'
    } else if ($(el).closest('.webBuilder_wrapper').find('.panel').hasClass('panel-warning')) {
        style = 'panel-warning'
    }
    $('#bootstrapPanels').find('.style').val(style);
    $('#bootstrapPanels').find('.title').val($(el).closest('.webBuilder_wrapper').find('.panel-title').html().replace(new RegExp('	', 'g'), ''));
    $('#bootstrapPanels').find('.content').val($(el).closest('.webBuilder_wrapper').find('.panel-body').html().replace(new RegExp('	', 'g'), '').replace(new RegExp("\n", 'g'), ''))
};