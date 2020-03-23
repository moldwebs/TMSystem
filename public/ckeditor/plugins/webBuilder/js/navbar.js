$(function() {
    $(document).on('click', '.saveNavbar', function() {
        $(current_element).parent().children('.navbar').attr('class', 'navbar');
        $(current_element).parent().children('.navbar').addClass($(this).closest('.modal').find('.inverted').val());
        $(current_element).parent().children('.navbar').addClass($(this).closest('.modal').find('.position').val());
        $(current_element).parent().children('.navbar').find('.navbar-brand').html($(this).closest('.modal').find('.brand').val());
        var items = $(this).closest('.modal').find('tbody').children();
        var navs = '';
        for (var i = 0; i < items.length; i++) {
            navs += ' 				<li' + ($(items[i]).find('.active').val() == 'active' ? ' class="active"' : '') + '> 					<a href="' + $(items[i]).find('.link').val() + '">' + $(items[i]).find('.title').val() + '</a> 				</li> 			'
        }
        $(current_element).parent().find('.nav').html(navs);
        $(this).closest('.modal').modal('hide');
        if ($(this).closest('.modal').find('.position').val() == 'navbar-fixed-top') {
            $('#webBuilder_content').css({
                paddingTop: '5em'
            });
            $('#webBuilder_sidebar').css({
                paddingTop: '4.7em'
            })
        } else {
            $('#webBuilder_content').css({
                paddingTop: '1em'
            });
            $('#webBuilder_sidebar').css({
                paddingTop: '15px'
            })
        }
    });
    $(document).on('change', '#bootstrapNavbar .active', function() {
        if ($(this).val() == 'active') {
            $(this).closest('tr').siblings().find('.active').val('')
        }
    });
    $(document).on('click', '.addNewNavbar', function() {
        $('#bootstrapNavbar').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><input type="text" class="form-control title" /></td> 			<td><input type="text" class="form-control link" /></td> 			<td> 				<select class="form-control active"> 					<option value="">No</option> 					<option value="active">Yes</option> 				</select> 			</td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_navbar(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').find('.navbar').find('.navbar-nav').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><input type="text" class="form-control title" value="' + ($(items[i]).children().html()).replace(new RegExp('	', 'g'), '') + '" /></td> 				<td><input type="text" class="form-control link" value="' + ($(items[i]).children().attr('href') ? $(items[i]).children().attr('href') : '#') + '" /></td> 				<td> 					<select class="form-control active"> 						<option value="">No</option> 						<option value="active"' + ($(items[i]).hasClass('active') ? ' selected' : '') + '>Yes</option> 					</select> 				</td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapNavbar').find('tbody').html('').append(structure);
    var position = '';
    if ($(el).closest('.webBuilder_wrapper').children('.navbar').hasClass('navbar-fixed-top')) {
        position = 'navbar-fixed-top'
    } else if ($(el).closest('.webBuilder_wrapper').children('.navbar').hasClass('navbar-fixed-bottom')) {
        position = 'navbar-fixed-bottom'
    } else if ($(el).closest('.webBuilder_wrapper').children('.navbar').hasClass('navbar-static-top')) {
        position = 'navbar-static-top'
    }
    $('#bootstrapNavbar').find('.position').val(position);
    $('#bootstrapNavbar').find('.brand').val($(el).closest('.webBuilder_wrapper').children('.navbar').find('.navbar-brand').html());
    if ($(el).closest('.webBuilder_wrapper').children('.navbar').hasClass('navbar-default')) {
        $('#bootstrapNavbar').find('.inverted').val('navbar-default')
    } else {
        $('#bootstrapNavbar').find('.inverted').val('navbar-inverse')
    }
    initiateSortableTable()
};