var current_class = '';
$(function() {
    $(document).on('click', '.saveAlert', function() {
        $(current_element).parent().children('.alert').removeClass(current_class).addClass($(this).closest('.modal').find('.style').val()).html($(this).closest('.modal').find('.text').val());
        $(this).closest('.modal').modal('hide')
    })
});

function load_alerts(el) {
    var alert_class = '';
    if ($(el).closest('.webBuilder_wrapper').find('.alert').hasClass('alert-success')) {
        alert_class = 'alert-success'
    } else if ($(el).closest('.webBuilder_wrapper').find('.alert').hasClass('alert-info')) {
        alert_class = 'alert-info'
    } else if ($(el).closest('.webBuilder_wrapper').find('.alert').hasClass('alert-warning')) {
        alert_class = 'alert-warning'
    } else if ($(el).closest('.webBuilder_wrapper').find('.alert').hasClass('alert-danger')) {
        alert_class = 'alert-danger'
    }
    current_class = alert_class;
    $('#bootstrapAlert').find('.style').val(alert_class);
    $('#bootstrapAlert').find('.text').val($(el).closest('.webBuilder_wrapper').find('.alert').html().replace(new RegExp('	', 'g'), '').replace(new RegExp("\n", 'g'), ''))
};