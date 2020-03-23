$(function() {
    $(document).on('click', '.saveButton', function() {
        var button = $(current_element).parent().children('.btn');
        $(button).removeAttr('class').addClass('btn');
        $(button).addClass($(this).closest('.modal').find('.style').val());
        $(button).addClass($(this).closest('.modal').find('.size').val());
        $(button).addClass($(this).closest('.modal').find('.block').val());
        $(button).addClass($(this).closest('.modal').find('.active').val());
        $(button).prop('disabled', $(this).closest('.modal').find('.enabled').val() == 'disabled' ? true : false);
        $(button).html($(this).closest('.modal').find('.text').val());
        if ($(this).closest('.modal').find('.link').val() != '') {
            $(button).attr({
                onClick: "location.href='" + $(this).closest('.modal').find('.link').val() + "'",
                'data-href': $(this).closest('.modal').find('.link').val()
            })
        } else {
            $(button).removeAttr('onClick').attr('data-href', '')
        }
        $(this).closest('.modal').modal('hide')
    })
});

function load_buttons(el) {
    var style = size = block = active = disabled = '';
    if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-default')) {
        style = 'btn-default'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-danger')) {
        style = 'btn-danger'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-info')) {
        style = 'btn-info'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-primary')) {
        style = 'btn-primary'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-success')) {
        style = 'btn-success'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-warning')) {
        style = 'btn-warning'
    }
    $('#bootstrapButtons').find('.style').val(style);
    if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-xs')) {
        size = 'btn-xs'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-sm')) {
        size = 'btn-sm'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-lg')) {
        size = 'btn-lg'
    }
    $('#bootstrapButtons').find('.size').val(size);
    if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-block')) {
        $('#bootstrapButtons').find('.block').val('btn-block')
    }
    if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('active')) {
        $('#bootstrapButtons').find('.active').val('active')
    }
    if ($(el).closest('.webBuilder_wrapper').find('.btn').prop('disabled')) {
        $('#bootstrapButtons').find('.enabled').val('disabled')
    }
    $('#bootstrapButtons').find('.text').val($(el).closest('.webBuilder_wrapper').find('.btn').html().replace(new RegExp('	', 'g'), ''));
    $('#bootstrapButtons').find('.link').val($(el).closest('.webBuilder_wrapper').find('.btn').attr('data-href'))
};