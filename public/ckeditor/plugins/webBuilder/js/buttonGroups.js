$(function() {
    $(document).on('click', '.saveButtonGroup', function() {
        var button = $(current_element).parent().find('div[class^=btn-group]');
        $(button).removeAttr('class').addClass($(this).closest('.modal').find('.variation').val());
        $(button).addClass($(this).closest('.modal').find('.size').val());
        var items = $(this).closest('.modal').find('tbody').children();
        var buttons = '';
        for (var i = 0; i < items.length; i++) {
            buttons += ' 				<button type="button" class="btn ' + $(this).closest('.modal').find('.style').val() + '" onClick="location.href=\'' + $(items[i]).find('.link').val() + '\'" data-href="' + $(items[i]).find('.link').val() + '">' + $(items[i]).find('.title').val() + '</button> 			'
        }
        $(current_element).parent().find('div[class^=btn-group]').html(buttons);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '.addNewGroup', function() {
        $('#bootstrapGroups').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><input type="text" class="form-control link" /></td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_buttonGroups(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + $(items[i]).html().replace(new RegExp('	', 'g'), '') + '" /></td> 				<td><input type="text" class="form-control link" value="' + ($(items[i]).attr('data-href') ? $(items[i]).attr('data-href') : '#') + '" /></td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapGroups').find('tbody').html('').append(structure);
    var style = size = '';
    if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').children().first().hasClass('btn-default')) {
        style = 'btn-default'
    } else if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').children().first().hasClass('btn-danger')) {
        style = 'btn-danger'
    } else if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').children().first().hasClass('btn-info')) {
        style = 'btn-info'
    } else if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').children().first().hasClass('btn-primary')) {
        style = 'btn-primary'
    } else if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').children().first().hasClass('btn-success')) {
        style = 'btn-success'
    } else if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').children().first().hasClass('btn-warning')) {
        style = 'btn-warning'
    }
    $('#bootstrapGroups').find('.style').val(style);
    if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').hasClass('btn-group-xs')) {
        size = 'btn-group-xs'
    } else if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').hasClass('btn-group-sm')) {
        size = 'btn-group-sm'
    } else if ($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').hasClass('btn-group-lg')) {
        size = 'btn-group-lg'
    }
    $('#bootstrapGroups').find('.size').val(size);
    $('#bootstrapGroups').find('.variation').val($(el).closest('.webBuilder_wrapper').find('div[class^=btn-group]').attr('class'));
    initiateSortableTable()
};