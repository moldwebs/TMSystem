$(function() {
    $(document).on('click', '.saveJumbotron', function() {
        $(current_element).parent().children('.jumbotron').children('h1').html($(this).closest('.modal').find('.title').val());
        $(current_element).parent().children('.jumbotron').children('.description').html($(this).closest('.modal').find('.description').val());
        $(current_element).parent().children('.jumbotron').children('.link').children().attr('href', $(this).closest('.modal').find('.link').val());
        $(this).closest('.modal').modal('hide')
    })
});

function load_jumbotron(el) {
    $('#bootstrapJumbotron').find('.title').val($(el).closest('.webBuilder_wrapper').find('.jumbotron').children('h1').html().replace(new RegExp('	', 'g'), ''));
    $('#bootstrapJumbotron').find('.description').val($(el).closest('.webBuilder_wrapper').find('.jumbotron').children('.description').html().replace(new RegExp('	', 'g'), '').replace(new RegExp("\n", 'g'), ''));
    $('#bootstrapJumbotron').find('.link').val($(el).closest('.webBuilder_wrapper').find('.jumbotron').children('.link').children().attr('href'))
};