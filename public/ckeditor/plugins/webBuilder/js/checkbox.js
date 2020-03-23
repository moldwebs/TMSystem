$(function() {
    $(document).on('click', '.saveCheckbox', function() {
        $(current_element).parent().children('.btn-group').attr('class', 'btn-group').addClass($(this).closest('.modal').find('.size').val());
        var items = $(this).closest('.modal').find('tbody').children();
        var buttons = '';
        for (var i = 0; i < items.length; i++) {
            buttons += '<label class="btn ' + $(this).closest('.modal').find('.style').val() + ($(items[i]).find('.active').val() == 'active' ? ' active' : '') + '"><input type="checkbox" name="option" value="' + $(items[i]).find('.title').val() + '"' + ($(items[i]).find('.active').val() == 'active' ? ' checked' : '') + ' />' + $(items[i]).find('.title').val() + '</label>'
        }
        $(current_element).parent().find('.btn-group').html(buttons);
        $(this).closest('.modal').modal('hide')
    })
});

function load_checkbox(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').find('.btn-group').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + $(items[i]).text().replace(new RegExp('	', 'g'), '') + '" /></td> 				<td> 					<select class="form-control active"> 						<option value="">No</option> 						<option value="active"' + ($(items[i]).hasClass('active') ? ' selected' : '') + '>Yes</option> 					</select> 				</td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapCheckbox').find('tbody').html('').append(structure);
    var style = size = '';
    if ($(el).closest('.webBuilder_wrapper').find('.btn-group').children().first().hasClass('btn-default')) {
        style = 'btn-default'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn-group').children().first().hasClass('btn-danger')) {
        style = 'btn-danger'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn-group').children().first().hasClass('btn-info')) {
        style = 'btn-info'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn-group').children().first().hasClass('btn-primary')) {
        style = 'btn-primary'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn-group').children().first().hasClass('btn-success')) {
        style = 'btn-success'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn-group').children().first().hasClass('btn-warning')) {
        style = 'btn-warning'
    }
    $('#bootstrapCheckbox').find('.style').val(style);
    if ($(el).closest('.webBuilder_wrapper').find('.btn-group').hasClass('btn-group-xs')) {
        size = 'btn-group-xs'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn-group').hasClass('btn-group-sm')) {
        size = 'btn-group-sm'
    } else if ($(el).closest('.webBuilder_wrapper').find('.btn-group').hasClass('btn-group-lg')) {
        size = 'btn-group-lg'
    }
    $('#bootstrapCheckbox').find('.size').val(size);
    initiateSortableTable()
};