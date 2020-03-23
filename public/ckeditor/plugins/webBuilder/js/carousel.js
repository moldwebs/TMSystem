$(function() {
    $(document).on('click', '.saveCarousel', function() {
        var d = new Date();
        var id = d.getTime();
        var items = $(this).closest('.modal').find('tbody').children();
        var item = content = '';
        for (var i = 0; i < items.length; i++) {
            item += '<li data-target="#carousel' + id + '" data-slide-to="' + i + '"' + (i == 0 ? ' class="active"' : '') + '></li>';
            content += ' 				<div class="item' + (i == 0 ? ' active' : '') + '"> 					<img src="' + $(items[i]).find('img').attr('src') + '" /> 					<div class="carousel-caption"> 						' + ($(items[i]).find('.title').val() != '' ? '<div class="carousel_title">' + $(items[i]).find('.title').val() + '</div>' : '') + ' 						' + ($(items[i]).find('.caption').val() != '' ? '<div class="carousel_caption">' + $(items[i]).find('.caption').val() + '</div>' : '') + ' 					</div> 				</div> 			'
        }
        $(current_element).parent().children('.carousel').attr('id', 'carousel' + id);
        $(current_element).parent().children('.carousel').find('.carousel-indicators').html(item);
        $(current_element).parent().children('.carousel').find('.carousel-inner').html(content);
        $(current_element).parent().children('.carousel').find('.carousel-control').attr('href', '#carousel' + id);
        $(current_element).parent().children('.carousel').find('.carousel-control').attr('data-cke-saved-href', '#carousel' + id);
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '.addNewCarousel', function() {
        $('#bootstrapCarousel').find('tbody').append('<tr> 			<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 			<td><textarea class="form-control title" onclick="open_ckeditor(this)"></textarea></td> 			<td><textarea class="form-control caption" onclick="open_ckeditor(this)"></textarea></td> 			<td> 				<img src="sample_images/no-image.jpg" /> 				<button type="button" class="btn btn-default btn-xs" onclick="browseImage(this)">...</button> 			</td> 			<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 		</tr>')
    })
});

function load_carousel(el) {
    var structure = '';
    var items = $(el).closest('.webBuilder_wrapper').find('.carousel-inner').children();
    for (var i = 0; i < items.length; i++) {
        structure += ' 			<tr> 				<td class="text-center"><div class="webBuilder_move_me"><span class="glyphicon glyphicon-move"></span></div></td> 				<td><textarea class="form-control title" onclick="open_ckeditor(this)">' + ($(items[i]).find('.carousel_title').html() ? $(items[i]).find('.carousel_title').html().replace(new RegExp('	', 'g'), '') : '') + '</textarea></td> 				<td><textarea class="form-control caption" onclick="open_ckeditor(this)">' + ($(items[i]).find('.carousel_caption').html() ? $(items[i]).find('.carousel_caption').html().replace(new RegExp('	', 'g'), '') : '') + '</textarea></td> 				<td> 					<img src="' + $(items[i]).find('img').attr('src') + '" /> 					<button type="button" class="btn btn-default btn-xs" onclick="browseImage(this)">...</button> 				</td> 				<td class="text-center"><a class="webBuilder_remove_me" href="#"><span class="glyphicon glyphicon-remove"></span></a></td> 			</tr> 		'
    }
    $('#bootstrapCarousel').find('tbody').html('').append(structure);
    initiateSortableTable()
};

function browseImage(el, multiple_image_select) {
    multiple_image_select = multiple_image_select || false;
    ele = el.parentElement.children[1];
    switch (webBuilder_fileManager) {
        case 'ckfinder':
        default:
            if (webBuilder_ckfinder_version == 3) {
                CKFinder.popup({
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function(finder) {
                        finder.on('files:choose', function(evt) {
                            var file = evt.data.files.first();
                            el.parentElement.children[0].src = file.getUrl()
                        })
                    }
                })
            } else {
                var webBuilder_finder = new CKFinder();
                webBuilder_finder.callback = function(webBuilder_api) {
                    webBuilder_api.hideTool('f0');
                    webBuilder_api.hideTool('f2')
                };
                webBuilder_finder.startupPath = 'Images:/';
                webBuilder_finder.selectActionFunction = function(webBuilder_fileUrl, webBuilder_data, webBuilder_multiple) {
                    el.parentElement.children[0].src = webBuilder_fileUrl;
                    el.parentElement.children[1].value = webBuilder_fileUrl
                };
                webBuilder_finder.popup()
            }
            break
    }
    if (!multiple_image_select) {
        el.parentNode.children[0].style.border = el.parentNode.children[1].value = '' ? '1px solid #f00' : ''
    }
};