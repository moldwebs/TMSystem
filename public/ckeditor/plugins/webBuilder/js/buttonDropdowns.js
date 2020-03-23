$(function() {
    $(document).on('click', '.saveButtonDropdown', function() {
        var button = $(current_element).parent().find('.btn');
        $(button).removeAttr('class').addClass('btn');
        $(button).addClass($(this).closest('.modal').find('.style').val());
        $(button).addClass($(this).closest('.modal').find('.size').val());
        $(button).addClass($(this).closest('.modal').find('.block').val());
        $(button).addClass($(this).closest('.modal').find('.active').val());
        $(button).prop('disabled', $(this).closest('.modal').find('.enabled').val() == 'disabled' ? true : false);
        $(button).html($(this).closest('.modal').find('.text').val() + ' <span class="caret"></span>');
        $(current_element).parent().find('.dropdown').attr('class', 'dropdown ' + $(this).closest('.modal').find('.direction').val());
        var items = $(this).closest('.modal').find('tbody').children();
        var dropdowns = '';
        for (var i = 0; i < items.length; i++) {
            dropdowns += '<li><a href="' + $(items[i]).find('.link').val() + '">' + $(items[i]).find('.title').val() + '</a></li>'
        }
        $(current_element).parent().find('.dropdown').children('.dropdown-menu').html(dropdowns);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '.addNewButtonDropdown', function() {
        $('#bootstrapButtonDropdowns').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><input type="text" class="form-control link" /></td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_buttonDropdowns(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').find('.dropdown').children('.dropdown-menu').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + ($(items[i]).find('a').html() != undefined ? ($(items[i]).find('a').html()).replace(new RegExp('	', 'g'), '') : ($(items[i]).html()).replace(new RegExp('	', 'g'), '')) + '" /></td> 				<td><input type="text" class="form-control link" value="' + ($(items[i]).find('a').html() != undefined ? $(items[i]).find('a').attr('href') : '') + '" /></td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapButtonDropdowns').find('tbody').html('').append(structure);
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
    $('#bootstrapButtonDropdowns').find('.style').val(style);
    if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-xs')) {
        size = 'btn-xs'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-sm')) {
        size = 'btn-sm'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-lg')) {
        size = 'btn-lg'
    }
    $('#bootstrapButtonDropdowns').find('.size').val(size);
    if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('btn-block')) {
        $('#bootstrapButtonDropdowns').find('.block').val('btn-block')
    }
    if ($(el).closest('.webBuilder_wrapper').find('.btn').hasClass('active')) {
        $('#bootstrapButtonDropdowns').find('.active').val('active')
    }
    if ($(el).closest('.webBuilder_wrapper').find('.btn').prop('disabled')) {
        $('#bootstrapButtonDropdowns').find('.enabled').val('disabled')
    }
    $('#bootstrapButtonDropdowns').find('.direction').val($(el).closest('.webBuilder_wrapper').find('.dropdown').hasClass('dropdown') ? 'dropdown' : 'dropup');
    $('#bootstrapButtonDropdowns').find('.text').val(($(el).closest('.webBuilder_wrapper').find('.btn').html()).replace(' <span class="caret"></span>', '').replace(new RegExp('	', 'g'), ''));
    initiateSortableTable()
};