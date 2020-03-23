$(function() {
    $(document).on('click', '.saveWell', function() {
        $(current_element).parent().children('.well').attr('class', $(this).closest('.modal').find('.size').val()).html($(this).closest('.modal').find('.content').val());
        $(this).closest('.modal').modal('hide')
    })
});

function load_well(el) {
    $('#bootstrapWell').find('.size').val($(el).closest('.webBuilder_wrapper').children('.well').attr('class'));
    $('#bootstrapWell').find('.content').html($(el).closest('.webBuilder_wrapper').children('.well').html().replace(new RegExp('	', 'g'), '').replace(new RegExp("\n", 'g'), ''))
};