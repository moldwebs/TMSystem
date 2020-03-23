$(function() {
    $(document).on('click', '.saveListGroup', function() {
        var items = $(this).closest('.modal').find('tbody').children();
        var lists = '';
        for (var i = 0; i < items.length; i++) {
            lists += ' 				<li class="list-group-item ' + $(items[i]).find('.style').val() + ' ' + $(items[i]).find('.active').val() + '"> 					' + ($(items[i]).find('.badge').val() != '' ? '<span class="badge">' + $(items[i]).find('.badges').val() + '</span>' : '') + ' 					' + ($(items[i]).find('.content').val() != '' ? '<h4 class="list-group-item-heading">' + $(items[i]).find('.title').val() + '</h4>' : '<div class="list-group-item-heading">' + $(items[i]).find('.title').val() + '</div>') + ' 					' + ($(items[i]).find('.content').val() != '' ? '<div class="list-group-item-text">' + $(items[i]).find('.content').val() + '</div>' : '') + ' 				</li> 			'
        }
        $(current_element).parent().children('.list-group').html(lists);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '.addNewListGroup', function() {
        $('#bootstrapListGroup').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><textarea class="form-control content minimum" onclick="open_ckeditor(this)"></textarea></td> 			<td><input type="text" class="form-control badges text-center" /></td> 			<td> 				<select class="form-control style"> 					<option value="">Default</option> 					<option value="list-group-item-danger">Danger</option> 					<option value="list-group-item-info">Info</option> 					<option value="list-group-item-success">Success</option> 					<option value="list-group-item-warning">Warning</option> 				</select> 			</td> 			<td> 				<select class="form-control active"> 					<option value="">No</option> 					<option value="active">Yes</option> 				</select> 			</td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_listGroup(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').children('.list-group').children();
    for (var i = 0; i < items.length; i++) {
        var style = '';
        if ($(items[i]).hasClass('list-group-item-danger')) {
            style = 'list-group-item-danger'
        } else if ($(items[i]).hasClass('list-group-item-info')) {
            style = 'list-group-item-info'
        } else if ($(items[i]).hasClass('list-group-item-success')) {
            style = 'list-group-item-success'
        } else if ($(items[i]).hasClass('list-group-item-warning')) {
            style = 'list-group-item-warning'
        }
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + $(items[i]).find('.list-group-item-heading').html().replace(new RegExp('	', 'g'), '') + '" /></td> 				<td><textarea class="form-control content minimum" onclick="open_ckeditor(this)">' + ($(items[i]).find('.list-group-item-text').size() > 0 ? $(items[i]).find('.list-group-item-text').html().replace(new RegExp('	', 'g'), '').replace(new RegExp("\n", 'g'), '') : '') + '</textarea></td> 				<td><input type="text" class="form-control badges text-center" value="' + $(items[i]).find('.badge').html().replace(new RegExp('	', 'g'), '') + '" /></td> 				<td> 					<select class="form-control style"> 						<option value="">Default</option> 						<option value="list-group-item-danger"' + (style == 'list-group-item-danger' ? ' selected' : '') + '>Danger</option> 						<option value="list-group-item-info"' + (style == 'list-group-item-info' ? ' selected' : '') + '>Info</option> 						<option value="list-group-item-success"' + (style == 'list-group-item-success' ? ' selected' : '') + '>Success</option> 						<option value="list-group-item-warning"' + (style == 'list-group-item-warning' ? ' selected' : '') + '>Warning</option> 					</select> 				</td> 				<td> 					<select class="form-control active"> 						<option value="">No</option> 						<option value="active"' + ($(items[i]).hasClass('active') ? ' selected' : '') + '>Yes</option> 					</select> 				</td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapListGroup').find('tbody').html('').append(structure);
    initiateSortableTable()
};