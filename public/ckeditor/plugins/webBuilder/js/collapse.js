$(function() {
    $(document).on('click', '.saveCollapse', function() {
        var d = new Date();
        var id = d.getTime();
        var items = $(this).closest('.modal').find('tbody').children();
        var collapse = '';
        for (var i = 0; i < items.length; i++) {
            collapse += ' 				<div class="panel ' + $(this).closest('.modal').find('.style').val() + '"> 					<div class="panel-heading" role="tab" id="heading' + id + '_' + i + '"> 						<div class="panel-title"> 							<a class="collapsed" data-toggle="collapse" data-parent="#collapse' + id + '" data-target="#collapse' + id + '_' + i + '" aria-expanded="false" aria-controls="collapse' + id + '_' + i + '" href="javascript:void(0)">' + $(items[i]).find('.title').val() + '</a> 						</div> 					</div> 					<div id="collapse' + id + '_' + i + '" class="panel-collapse collapse ' + (i == 0 ? $(this).closest('.modal').find('.expandFirstItem').val() : '') + '" role="tabpanel" aria-labelledby="heading' + id + '_' + i + '"> 						<div class="panel-body">' + $(items[i]).find('.content').val() + '</div> 					</div> 				</div> 			'
        }
        $(current_element).parent().children('.panel-group').attr('id', 'collapse' + id).html(collapse);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '.addNewCollapse', function() {
        $('#bootstrapCollapse').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><textarea class="form-control content" onclick="open_ckeditor(this)"></textarea></td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_collapse(el) {
    if ($(el).closest('.webBuilder_wrapper').children('.panel-group').children().first().find('.panel-body').parent().hasClass('in')) {
        $('#bootstrapCollapse').find('.expandFirstItem').val('in')
    }
    var style = '';
    if ($(el).closest('.webBuilder_wrapper').children('.panel-group').children().first().hasClass('panel-default')) {
        style = 'panel-default'
    } else if ($(el).closest('.webBuilder_wrapper').children('.panel-group').children().first().hasClass('panel-danger')) {
        style = 'panel-danger'
    } else if ($(el).closest('.webBuilder_wrapper').children('.panel-group').children().first().hasClass('panel-info')) {
        style = 'panel-info'
    } else if ($(el).closest('.webBuilder_wrapper').children('.panel-group').children().first().hasClass('panel-primary')) {
        style = 'panel-primary'
    } else if ($(el).closest('.webBuilder_wrapper').children('.panel-group').children().first().hasClass('panel-success')) {
        style = 'panel-success'
    } else if ($(el).closest('.webBuilder_wrapper').children('.panel-group').children().first().hasClass('panel-warning')) {
        style = 'panel-warning'
    }
    $('#bootstrapCollapse').find('.style').val(style);
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').children('.panel-group').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + $(items[i]).find('.panel-title').children('a').html().replace(new RegExp('	', 'g'), '') + '" /></td> 				<td><textarea class="form-control content" onclick="open_ckeditor(this)">' + $(items[i]).find('.panel-body').html().replace(new RegExp('	', 'g'), '').replace(new RegExp("\n", 'g'), '') + '</textarea></td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapCollapse').find('tbody').html('').append(structure);
    initiateSortableTable()
};