$(function() {
    $(document).on('click', '.saveNav', function() {
        $(current_element).parent().children('.nav').attr('class', 'nav');
        $(current_element).parent().children('.nav').addClass($(this).closest('.modal').find('.style').val());
        $(current_element).parent().children('.nav').addClass($(this).closest('.modal').find('.justified').val());
        if ($(this).closest('.modal').find('.style').val() == 'nav-pills') {
            $(current_element).parent().children('.nav').addClass($(this).closest('.modal').find('.stacked').val())
        } else {
            $(current_element).parent().children('.nav').removeClass('nav-stacked')
        }
        if ($(this).closest('.modal').find('.stacked').val() == 'nav-stacked') {
            $(current_element).parent().children('.nav').removeClass('nav-justified')
        }
        var items = $(this).closest('.modal').find('tbody').children();
        var navs = '';
        for (var i = 0; i < items.length; i++) {
            navs += ' 				<li role="presentation"' + ($(items[i]).find('.active').val() == 'active' ? ' class="active"' : '') + '> 					<a href="' + $(items[i]).find('.link').val() + '">' + $(items[i]).find('.title').val() + '</a> 				</li> 			'
        }
        $(current_element).parent().find('.nav').html(navs);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('change', '#bootstrapNavs .stacked', function() {
        if ($(this).val() == 'nav-stacked') {
            $(this).closest('.modal').find('.justified').closest('.form-group').addClass('hidden')
        } else {
            $(this).closest('.modal').find('.justified').closest('.form-group').removeClass('hidden')
        }
    });
    $(document).on('change', '#bootstrapNavs .style', function() {
        if ($(this).val() == 'nav-pills') {
            $(this).closest('.modal').find('.stacked').closest('.form-group').removeClass('hidden')
        } else {
            $(this).closest('.modal').find('.justified').closest('.form-group').removeClass('hidden');
            $(this).closest('.modal').find('.stacked').closest('.form-group').addClass('hidden')
        }
    });
    $(document).on('change', '#bootstrapNavs .active', function() {
        if ($(this).val() == 'active') {
            $(this).closest('tr').siblings().find('.active').val('')
        }
    });
    $(document).on('click', '.addNewNav', function() {
        $('#bootstrapNavs').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><input type="text" class="form-control link" /></td> 			<td> 				<select class="form-control active"> 					<option value="">No</option> 					<option value="active">Yes</option> 				</select> 			</td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_navs(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').find('.nav').children().children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + ($(items[i]).html()).replace(new RegExp('	', 'g'), '') + '" /></td> 				<td><input type="text" class="form-control link" value="' + ($(items[i]).attr('href') ? $(items[i]).attr('href') : '#') + '" /></td> 				<td> 					<select class="form-control active"> 						<option value="">No</option> 						<option value="active"' + ($(items[i]).parent().hasClass('active') ? ' selected' : '') + '>Yes</option> 					</select> 				</td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapNavs').find('tbody').html('').append(structure);
    $('#bootstrapNavs').find('.style').val($(el).closest('.webBuilder_wrapper').children('.nav').hasClass('nav-pills') ? 'nav-pills' : 'nav-tabs');
    $('#bootstrapNavs').find('.stacked').val($(el).closest('.webBuilder_wrapper').children('.nav').hasClass('nav-stacked') ? 'nav-stacked' : '');
    $('#bootstrapNavs').find('.justified').val($(el).closest('.webBuilder_wrapper').children('.nav').hasClass('nav-justified') ? 'nav-justified' : '');
    initiateSortableTable()
};