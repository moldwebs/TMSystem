$(function() {
    $(document).on('click', '.saveTab', function() {
        var d = new Date();
        var id = d.getTime();
        var items = $(this).closest('.modal').find('tbody').children();
        var nav = content = '';
        for (var i = 0; i < items.length; i++) {
            nav += ' 				<li role="presentation"' + (i == 0 ? ' class="active"' : '') + '> 					<a href="#tab' + id + '_' + i + '" aria-controls="tab' + id + '_' + i + '" role="tab" data-toggle="tab">' + $(items[i]).find('.title').val() + '</a> 				</li> 			';
            content += '<div role="tabpanel" class="tab-pane' + (i == 0 ? ' active' : '') + '" id="tab' + id + '_' + i + '">' + $(items[i]).find('.content').val() + '</div>'
        }
        $(current_element).parent().find('ul.nav.nav-tabs').html(nav).parent().attr('id', 'collapse' + id);
        $(current_element).parent().find('.tab-content').html(content);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '.addNewTab', function() {
        $('#bootstrapTab').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><textarea class="form-control content" onclick="open_ckeditor(this)"></textarea></td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_tab(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').find('ul.nav.nav-tabs').children();
    var content = $(el).closest('.webBuilder_wrapper').find('.tab-content').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + $(items[i]).children('a').html().replace(new RegExp('	', 'g'), '') + '" /></td> 				<td><textarea class="form-control content" onclick="open_ckeditor(this)">' + $(content[i]).html().replace(new RegExp('	', 'g'), '').replace(new RegExp("\n", 'g'), '') + '</textarea></td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapTab').find('tbody').html('').append(structure);
    initiateSortableTable()
};