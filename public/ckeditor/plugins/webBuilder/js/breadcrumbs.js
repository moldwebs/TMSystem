$(function() {
    $(document).on('click', '.saveBreadcrumb', function() {
        var items = $(this).closest('.modal').find('tbody').children();
        var breadcrumbs = '';
        for (var i = 0; i < items.length; i++) {
            if (i < items.length - 1) {
                breadcrumbs += '<li><a href="' + $(items[i]).find('.link').val() + '">' + $(items[i]).find('.title').val() + '</a></li>'
            } else {
                breadcrumbs += '<li class="active">' + $(items[i]).find('.title').val() + '</li>'
            }
        }
        $(current_element).parent().children('.breadcrumb').html(breadcrumbs);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '.addNewItemBreadcrumb', function() {
        $('#bootstrapBreadcrumbs').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><input type="text" class="form-control link" /></td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_breadcrumbs(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').children('.breadcrumb').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + ($(items[i]).find('a').html() != undefined ? $(items[i]).find('a').html().replace(new RegExp('	', 'g'), '') : $(items[i]).html().replace(new RegExp('	', 'g'), '')) + '" /></td> 				<td><input type="text" class="form-control link" value="' + ($(items[i]).find('a').html() != undefined ? $(items[i]).find('a').attr('href') : '') + '" /></td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapBreadcrumbs').find('tbody').html('').append(structure);
    initiateSortableTable()
};