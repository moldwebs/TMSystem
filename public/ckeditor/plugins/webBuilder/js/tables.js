var current_cell;
$(function() {
    $(document).on('contextmenu', '.webBuilder_wrapper .table', function(e) {
        current_cell = e.target;
        $('body').find('#webBuilder_table_contextmenu').remove();
        var contextmenu = ' 			<div class="dropdown" id="webBuilder_table_contextmenu"> 				<ul class="dropdown-menu"> 					<li class="dropdown-submenu"> 						<a href="javascript:void(0)">Cell</a> 						<ul class="dropdown-menu"> 							<li><a href="javascript:void(0)" class="webBuilder_insertCellBefore">Insert Cell Before</a></li> 							<li><a href="javascript:void(0)" class="webBuilder_insertCellAfter">Insert Cell After</a></li> 							<li><a href="javascript:void(0)" class="webBuilder_deleteCell">Delete Cell</a></li> 		';
        if ((($(current_cell).next('td').size() > 0 && !$(current_cell).attr('rowspan')) || ($(current_cell).next('td').size() > 0 && parseInt($(current_cell).attr('rowspan')) == parseInt($(current_cell).next('td').attr('rowspan')))) || (($(current_cell).next('th').size() > 0 && !$(current_cell).attr('rowspan')) || ($(current_cell).next('th').size() > 0 && parseInt($(current_cell).attr('rowspan')) == parseInt($(current_cell).next('th').attr('rowspan'))))) {
            contextmenu += '<li><a href="javascript:void(0)" class="webBuilder_mergeRight">Merge Right</a></li>'
        }
        var allow_merge_down = false;
        if ($(current_cell).attr('rowspan')) {
            var rowspan = parseInt($(current_cell).attr('rowspan'));
            var index = $(current_cell).closest('tr').index() + 1;
            if ($(current_cell).closest('tr').children().size() == $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children().size()) {
                allow_merge_down = true
            } else if ($(current_cell).closest('tr').children().size() > $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children().size()) {
                allow_merge_down = true
            } else if (($(current_cell).closest('tr').children().size() < $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children().size())) {
                allow_merge_down = true
            }
        } else if ($(current_cell).closest('tr').children().size() == $(current_cell).closest('tr').next('tr').children().size()) {
            allow_merge_down = true
        } else if ($(current_cell).closest('tr').children().size() > $(current_cell).closest('tr').next('tr').children().size()) {
            allow_merge_down = true
        } else if (($(current_cell).closest('tr').children().size() < $(current_cell).closest('tr').next('tr').children().size())) {
            allow_merge_down = true
        }
        if (allow_merge_down && $(current_cell).closest('tr').next('tr').size() > 0) {
            contextmenu += '<li><a href="javascript:void(0)" class="webBuilder_mergeDown">Merge Down</a></li>'
        }
        contextmenu += ' 						</ul> 					</li> 					<li class="dropdown-submenu"> 						<a href="javascript:void(0)">Row</a> 						<ul class="dropdown-menu"> 							<li><a href="javascript:void(0)" class="webBuilder_insertRowBefore">Insert Row Before</a></li> 							<li><a href="javascript:void(0)" class="webBuilder_insertRowAfter">Insert Row After</a></li> 							<li><a href="javascript:void(0)" class="webBuilder_deleteRow">Delete Row</a></li> 						</ul> 					</li> 				</ul> 			</div> 		';
        $('body').append(contextmenu).find('#webBuilder_table_contextmenu').css({
            left: e.pageX,
            top: e.pageY
        }).children('ul').show();
        return false
    });
    $(document).on('click', '#webBuilder_table_contextmenu .webBuilder_insertCellBefore', function() {
        $('<td></td>').insertBefore($(current_cell));
        hide_table_context_menu()
    });
    $(document).on('click', '#webBuilder_table_contextmenu .webBuilder_insertCellAfter', function() {
        $('<td></td>').insertAfter($(current_cell));
        hide_table_context_menu()
    });
    $(document).on('click', '#webBuilder_table_contextmenu .webBuilder_deleteCell', function() {
        $(current_cell).remove();
        hide_table_context_menu()
    });
    $(document).on('click', '#webBuilder_table_contextmenu .webBuilder_mergeRight', function() {
        var next_content = $(current_cell).next().html();
        $(current_cell).attr('colspan', parseInt($(current_cell).attr('colspan')) > 0 ? parseInt($(current_cell).attr('colspan')) + 1 : 2).html($(current_cell).html() + next_content).next().remove();
        hide_table_context_menu()
    });
    $(document).on('click', '#webBuilder_table_contextmenu .webBuilder_mergeDown', function() {
        if ($(current_cell).attr('rowspan')) {
            var rowspan = parseInt($(current_cell).attr('rowspan'));
            var index = $(current_cell).closest('tr').index() + 1;
            if ($(current_cell).closest('tr').children().size() == $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children().size()) {
                var down_content = $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children(':nth-child(' + ($(current_cell).index() + 1) + ')').html();
                $(current_cell).attr('rowspan', parseInt($(current_cell).attr('rowspan')) > 0 ? parseInt($(current_cell).attr('rowspan')) + 1 : 2).html($(current_cell).html() + '<br />' + down_content);
                $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children(':nth-child(' + ($(current_cell).index() + 1) + ')').remove()
            } else if ($(current_cell).closest('tr').children().size() > $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children().size()) {
                var the_index = $(current_cell).index() + 1;
                $(current_cell).prevAll('td').each(function() {
                    the_index -= $(this).attr('rowspan') ? 1 : 0
                });
                var loopie = $(current_cell).attr('rowspan');
                var current_tr = $(current_cell).closest('tr');
                while (loopie > 0) {
                    current_tr = $(current_tr).next('tr');
                    $(current_tr).children(':nth-child(' + the_index + ')').prevAll('td').each(function() {
                        the_index -= $(this).attr('rowspan') ? 1 : 0
                    });
                    loopie--
                }
                var down_content = $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children(':nth-child(' + the_index + ')').html();
                $(current_cell).attr('rowspan', parseInt($(current_cell).attr('rowspan')) > 0 ? parseInt($(current_cell).attr('rowspan')) + 1 : 2).html($(current_cell).html() + '<br />' + down_content);
                $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children(':nth-child(' + the_index + ')').remove()
            } else if (($(current_cell).closest('tr').children().size() < $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children().size())) {
                var the_index = 1;
                $(current_cell).prevAll('td').each(function() {
                    the_index += $(this).attr('rowspan') ? 1 : 0
                });
                $(current_cell).closest('tr').prevAll('tr').each(function() {
                    $(this).children().each(function() {
                        the_index += $(this).index() <= $(current_cell).index() && $(this).attr('rowspan') ? 1 : 0
                    })
                });
                var down_content = $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children(':nth-child(' + the_index + ')').html();
                $(current_cell).attr('rowspan', parseInt($(current_cell).attr('rowspan')) > 0 ? parseInt($(current_cell).attr('rowspan')) + 1 : 2).html($(current_cell).html() + '<br />' + down_content);
                $(current_cell).closest('tr').parent().children(':nth-child(' + (rowspan + index) + ')').children(':nth-child(' + the_index + ')').remove()
            }
        } else if ($(current_cell).closest('tr').children().size() == $(current_cell).closest('tr').next('tr').children().size()) {
            var down_content = $(current_cell).closest('tr').next('tr').children(':nth-child(' + ($(current_cell).index() + 1) + ')').html();
            $(current_cell).attr('rowspan', parseInt($(current_cell).attr('rowspan')) > 0 ? parseInt($(current_cell).attr('rowspan')) + 1 : 2).html($(current_cell).html() + '<br />' + down_content).closest('tr').next('tr').children(':nth-child(' + ($(current_cell).index() + 1) + ')').remove()
        } else if ($(current_cell).closest('tr').children().size() > $(current_cell).closest('tr').next('tr').children().size()) {
            var index = $(current_cell).index() + 1;
            $(current_cell).prevAll('td').each(function() {
                index -= $(this).attr('rowspan') ? 1 : 0
            });
            var down_content = $(current_cell).closest('tr').next('tr').children(':nth-child(' + index + ')').html();
            $(current_cell).attr('rowspan', parseInt($(current_cell).attr('rowspan')) > 0 ? parseInt($(current_cell).attr('rowspan')) + 1 : 2).html($(current_cell).html() + '<br />' + down_content).closest('tr').next('tr').children(':nth-child(' + index + ')').remove()
        } else if (($(current_cell).closest('tr').children().size() < $(current_cell).closest('tr').next('tr').children().size())) {
            var index = 1;
            $(current_cell).prevAll('td').each(function() {
                index += $(this).attr('rowspan') ? 1 : 0
            });
            $(current_cell).closest('tr').prevAll('tr').each(function() {
                $(this).children().each(function() {
                    index += $(this).index() <= $(current_cell).index() && $(this).attr('rowspan') ? 1 : 0
                })
            });
            var down_content = $(current_cell).closest('tr').next('tr').children(':nth-child(' + index + ')').html();
            $(current_cell).attr('rowspan', parseInt($(current_cell).attr('rowspan')) > 0 ? parseInt($(current_cell).attr('rowspan')) + 1 : 2).html($(current_cell).html() + '<br />' + down_content).closest('tr').next('tr').children(':nth-child(' + index + ')').remove()
        }
        hide_table_context_menu()
    });
    $(document).on('contextmenu click', function(e) {
        if ($(e.target) != $(current_cell)) {
            $('#webBuilder_table_contextmenu').remove()
        }
    });
    $(document).on('click', '.webBuilder_insertRowBefore', function() {
        $(current_cell).closest('tr').clone().insertBefore($(current_cell).closest('tr'));
        $(current_cell).closest('tr').prev('tr').find('td').html('&nbsp;')
    });
    $(document).on('click', '.webBuilder_insertRowAfter', function() {
        $(current_cell).closest('tr').clone().insertAfter($(current_cell).closest('tr'));
        $(current_cell).closest('tr').next('tr').find('td').html('&nbsp;')
    });
    $(document).on('click', '.webBuilder_deleteRow', function() {
        $(current_cell).closest('tr').remove()
    });
    $(document).on('click', '.saveTable', function() {
        $(current_element).parent().children('.table-responsive').children('.table').addClass($(this).closest('.modal').find('.striped').val());
        $(current_element).parent().children('.table-responsive').children('.table').addClass($(this).closest('.modal').find('.bordered').val());
        $(current_element).parent().children('.table-responsive').children('.table').addClass($(this).closest('.modal').find('.hover').val());
        $(current_element).parent().children('.table-responsive').children('.table').addClass($(this).closest('.modal').find('.condensed').val());
        $(this).closest('.modal').modal('hide')
    });
    $(document).on('click', '#webBuilder_content th, #webBuilder_content td', function() {
        $(this).prop('contenteditable', true).focus();
        document.execCommand('selectAll', false, null)
    })
});

function hide_table_context_menu() {
    $('body').find('#webBuilder_table_contextmenu').remove()
};

function load_tables(el) {
    if ($(el).closest('.webBuilder_wrapper').children('.table-responsive').children('.table').hasClass('table-striped')) {
        $('#bootstrapTables').find('.striped').val('table-striped')
    }
    if ($(el).closest('.webBuilder_wrapper').children('.table-responsive').children('.table').hasClass('table-bordered')) {
        $('#bootstrapTables').find('.bordered').val('table-bordered')
    }
    if ($(el).closest('.webBuilder_wrapper').children('.table-responsive').children('.table').hasClass('table-hover')) {
        $('#bootstrapTables').find('.hover').val('table-hover')
    }
    if ($(el).closest('.webBuilder_wrapper').children('.table-responsive').children('.table').hasClass('table-condensed')) {
        $('#bootstrapTables').find('.condensed').val('table-condensed')
    }
};