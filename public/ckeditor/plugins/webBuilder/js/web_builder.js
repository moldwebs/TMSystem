$(function() {
    $('.webBuilder_draggable.webBuilder_r').draggable({
        connectToSortable: '.sortable',
        appendTo: 'body',
        helper: function(e) {
            return (e.currentTarget.children[1].innerHTML).replace(/(\r\n|\n|\r|\t)/gm, "");
        },
        drag: function(e, u) {
            $('.webBuilder_row-placeholder').css({
                height: u.helper[0].style.height
            })
        },
        stop: function() {
            generateToolbar();
            initiateSortable()
        }
    });
    $('.webBuilder_draggable.webBuilder_c').draggable({
        appendTo: 'body',
        connectToSortable: '.row > div',
        helper: function(e) {
            return (e.currentTarget.children[1].innerHTML).replace(/(\r\n|\n|\r|\t)/gm, "");
        },
        drag: function(e, u) {
            $('.webBuilder_row-placeholder').css({
                height: u.helper[0].style.height
            })
        },
        stop: function(e, u) {
            generateToolbar();
            initiateSortable();
            generateRandomID(u.helper[0])
        }
    });
    $('#webBuilder_sidebar').find('a').on('click', function() {
        $(this).siblings('ul').stop(true, true).slideToggle(200);
        $(this).parent().siblings().children('ul').stop(true, true).slideUp(200);
        return false
    });
    $(document).on('click', '.webBuilder_add', function() {
        $('<div class="col-xs-1"></div>').insertAfter($(this).closest('.webBuilder_options').parent());
        generateToolbar();
        initiateSortable();
        return false
    });
    $(document).on('click', '.webBuilder_duplicate', function() {
        $($(this).closest('div[class*=col-]')[0].outerHTML).insertAfter($(this).closest('.webBuilder_options').parent());
        generateToolbar();
        initiateSortable();
        return false
    });
    $(document).on('click', '.webBuilder_offset_right', function() {
        offset_div('right', $(this).closest('.webBuilder_options').parent())
    });
    $(document).on('click', '.webBuilder_offset_left', function() {
        offset_div('left', $(this).closest('.webBuilder_options').parent())
    });
    $(document).on('click', '.webBuilder_grow', function() {
        grow_sink('grow', $(this).closest('.webBuilder_options').parent())
    });
    $(document).on('click', '.webBuilder_sink', function() {
        grow_sink('sink', $(this).closest('.webBuilder_options').parent())
    });
    $(document).on('click', '.webBuilder_remove', function() {
        $(this).closest('.webBuilder_options').parent().remove();
        checkEmptySortables();
        checkNavbars()
    });
    $(document).on('click', '.webBuilder_delete', function() {
        $(this).closest('.webBuilder_row_options').parent().remove();
        checkEmptySortables();
        checkNavbars()
    });
    $(document).on('click', '.webBuilder_settings', function() {
        current_element = $(this);
        eval("load_" + ($(this).attr('data-target')).replace('#', '') + "(current_element);");
        $($(this).attr('data-target')).modal()
    });
    $(document).on('click', '.webBuilder_remove_me', function() {
        if (confirm('Are you sure you want to delete this item?')) {
            if ($(this).closest('tbody').children().size() > 1) {
                $(this).closest('tr').remove()
            } else {
                alert('There should be at least 1 item!')
            }
        }
        return false
    });
    $(document).on('click', '.webBuilder_remove_wrapper', function() {
        if (confirm('Are you sure you want to delete this item?')) {
            $(this).closest('.webBuilder_wrapper').remove();
            checkEmptySortables();
            checkNavbars()
        }
    });
    $(document).on('click', '.webBuilder_button', function() {
        if ($(this).hasClass('active') || $(this).hasClass('webBuilder_close')) {
            return false
        }
        var current_active = $(this).parent().find('.active').attr('data-size');
        $(this).addClass('active').siblings().removeClass('active');
        var new_active = $(this).attr('data-size');
        var window_size = 0;
        if (($(this).attr('data-size') == 'lg' && current_active == 'md') || ($(this).attr('data-size') == 'lg' && current_active == 'sm') || ($(this).attr('data-size') == 'lg' && current_active == 'xs')) {
            window_size = webBuilder_container_large_desktop + 'px'
        } else if (($(this).attr('data-size') == 'md' && current_active == 'lg') || ($(this).attr('data-size') == 'md' && current_active == 'sm') || ($(this).attr('data-size') == 'md' && current_active == 'xs')) {
            window_size = webBuilder_container_desktop + 'px'
        } else if (($(this).attr('data-size') == 'sm' && current_active == 'lg') || ($(this).attr('data-size') == 'sm' && current_active == 'md') || ($(this).attr('data-size') == 'sm' && current_active == 'xs')) {
            window_size = webBuilder_container_tablet + 'px'
        } else if (($(this).attr('data-size') == 'xs' && current_active == 'lg') || ($(this).attr('data-size') == 'xs' && current_active == 'md') || ($(this).attr('data-size') == 'xs' && current_active == 'sm')) {
            window_size = '589px'
        }
        $('.webBuilder_drag-here').css({
            width: parseInt(window_size) + 30 + 'px'
        });
        $('#webBuilder_content').find('.container').css({
            width: window_size
        }).find('div[class*=col-]').each(function() {
            $(this).attr('data-' + current_active + '-size', $(this).attr('class').replace(new RegExp('xs', 'g'), current_active));
            if ($(this).attr('data-' + new_active + '-size')) {
                $(this).attr('class', ($(this).attr('data-' + new_active + '-size')).replace(new RegExp(new_active, 'g'), 'xs'))
            } else {
                if (new_active == 'lg') {
                    $(this).attr('class', $(this).attr('data-md-size') ? $(this).attr('data-md-size').replace('md', 'xs') : 'col-xs-' + webBuilder_grid_columns)
                } else if (new_active == 'md') {
                    $(this).attr('class', $(this).attr('data-sm-size') ? $(this).attr('data-sm-size').replace('sm', 'xs') : 'col-xs-' + webBuilder_grid_columns)
                } else if (new_active == 'sm') {
                    $(this).attr('class', $(this).attr('data-xs-size') ? $(this).attr('data-xs-size') : 'col-xs-' + webBuilder_grid_columns)
                } else {
                    $(this).attr('class', 'col-xs-' + webBuilder_grid_columns)
                }
            }
        })
    });
    $(document).on('click', '.webBuilder_close', function() {
        $('#webBuilder_content').find('div[class*=col-]').each(function() {
            var current_active = $('.webBuilder_button.active').attr('data-size');
            $(this).attr('data-' + current_active + '-size', $(this).attr('class').replace(new RegExp('xs', 'g'), current_active));
            var new_size = [];
            if ($(this).attr('data-lg-size')) {
                var data_lg_size = $(this).attr('data-lg-size').replace(new RegExp('ui-sortable', 'g'), '');
                data_lg_size = data_lg_size.split(' ');
                for (var i in data_lg_size) {
                    if (data_lg_size[i] != '') {
                        new_size.push(data_lg_size[i])
                    }
                }
            }
            if ($(this).attr('data-md-size')) {
                var data_md_size = $(this).attr('data-md-size').replace(new RegExp('ui-sortable', 'g'), '');
                data_md_size = data_md_size.split(' ');
                for (var i in data_md_size) {
                    if (data_md_size[i] != '') {
                        new_size.push(data_md_size[i])
                    }
                }
            }
            if ($(this).attr('data-sm-size')) {
                var data_sm_size = $(this).attr('data-sm-size').replace(new RegExp('ui-sortable', 'g'), '');
                data_sm_size = data_sm_size.split(' ');
                for (var i in data_sm_size) {
                    if (data_sm_size[i] != '') {
                        new_size.push(data_sm_size[i])
                    }
                }
            }
            if ($(this).attr('data-xs-size')) {
                var data_xs_size = $(this).attr('data-xs-size').replace(new RegExp('ui-sortable', 'g'), '');
                data_xs_size = data_xs_size.split(' ');
                for (var i in data_xs_size) {
                    if (data_xs_size[i] != '') {
                        new_size.push(data_xs_size[i])
                    }
                }
                new_size.push($(this).attr('data-xs-size').replace(new RegExp('ui-sortable', 'g'), '').replace(new RegExp(' ', 'g'), ''))
            }
            $(this).attr('class', new_size.join(' ')).removeAttr('data-lg-size').removeAttr('data-md-size').removeAttr('data-sm-size').removeAttr('data-xs-size')
        });
        if ($('#webBuilder_content').find('.container').html() != undefined) {
            $('#webBuilder_content').find('.container').find('.webBuilder_wrapper').children().first().unwrap('<div></div>');
            $('#webBuilder_content').find('.container').find('.webBuilder_options, .webBuilder_row_options, .webBuilder_move, .webBuilder_settings, .webBuilder_remove_wrapper').remove();
            $('#webBuilder_content').find('div[class*=col-]').removeAttr('style');
            $('#webBuilder_content').find('.row').css({
                marginBottom: '.5em'
            });
            webBuilder_current_element.document.$.body.innerHTML = $('#webBuilder_content').find('.container').html();
            window.parent.document.getElementById('webBuilder_iframe').remove()
        }
    });
    $(document).on('mouseleave', '.webBuilder_wrapper', function() {
        $(this).find('.webBuilder_settings, .webBuilder_move, .webBuilder_remove_wrapper').removeAttr('style')
    });
    loadExternals();
    setupGrids();
    initiateSortable();
    generateToolbar();
    checkEmptySortables()
});
$(window).on('load', function() {
    $('.webBuilder_loader').remove()
});

function loadExternals() {
    $('<link rel="stylesheet" type="text/css" href="' + mj_variables_bootstrap_css_path + '" />').insertBefore('.jquery-ui');
    $('<script type="text/javascript" src="' + mj_variables_bootstrap_js_path + '"></script>').insertBefore('.jquery-ui-script');
    $('<script type="text/javascript" src="' + webBuilder_ckfinder_path + '"></script>').insertAfter('.jquery-ui-script');
    if(Array.isArray(contentsCss)){
        contentsCss.forEach(function(entry) {
            $('<link rel="stylesheet" type="text/css" href="' + entry + '" />').insertBefore('.jquery-ui');
        });
    }
};

function open_ckeditor(el) {
    return;
    webBuilder_current_element_popup = el;
    var webBuilder_id = '';
    var webBuilder_id_ctr = 3;
    var webBuilder_d = new Date();
    webBuilder_id = webBuilder_d.getTime();
    var webBuilder_popup = 'toolbar=no,status=no,resizable=yes,dependent=yes,width=' + (screen.width * 0.7) + ',height=' + (screen.height * 0.7) + ',left=' + ((screen.width - (screen.width * 0.7)) / 2) + ',top=' + ((screen.height - (screen.height * 0.7)) / 2);
    window.open('ckeditor.html', 'Web Builder ' + webBuilder_id, webBuilder_popup)
};

function generateRandomID(el) {
    var d = new Date();
    var id = d.getTime();
    if ($(el).find('.panel-group').size() > 0) {
        $(el).find('.panel-group').attr('id', 'collapse' + id);
        var ctr = 0;
        $(el).find('.panel-heading').each(function() {
            $(this).attr({
                'id': '#heading' + id + '_' + ctr
            });
            ctr++
        });
        var ctr = 0;
        $(el).find('.panel-title').each(function() {
            $(this).children('a').attr({
                'data-parent': '#collapse' + id,
                'data-target': '#collapse' + id + '_' + ctr,
                'aria-controls': 'collapse' + id + '_' + ctr
            });
            ctr++
        });
        var ctr = 0;
        $(el).find('.panel-body').each(function() {
            $(this).parent().attr({
                id: 'collapse' + id + '_' + ctr,
                'aria-labelledby': 'heading' + id + '_' + ctr
            });
            ctr++
        })
    } else if ($(el).find('.nav-tabs[role=tablist]').parent().size() > 0) {
        $(el).find('.nav-tabs').parent().parent().attr('id', 'collapse' + id);
        var ctr = 0;
        $(el).find('.nav-tabs').children().each(function() {
            $(this).find('a').attr({
                href: '#tab' + id + '_' + ctr,
                'aria-controls': 'tab' + id + '_' + ctr
            });
            ctr++
        });
        var ctr = 0;
        $(el).find('.tab-content').children().each(function() {
            $(this).attr({
                id: 'tab' + id + '_' + ctr
            });
            ctr++
        })
    } else if ($(el).find('.navbar').size() > 0) {
        $(el).find('.navbar-header').children().attr('data-target', '#navbar-collapse' + id);
        $(el).find('.navbar-collapse').attr('id', 'navbar-collapse' + id)
    } else if ($(el).find('.carousel').size() > 0) {
        var ctr = 0;
        $(el).find('.carousel-indicators').children().each(function() {
            $(this).children().children().attr({
                'data-target': '#carousel' + id,
                'data-slide-to': ctr
            });
            ctr++
        });
        $(el).find('.carousel').attr('id', 'carousel' + id);
        $(el).find('.carousel-control').attr('href', '#carousel' + id);
        $(el).find('.carousel-control').attr('data-cke-saved-href', '#carousel' + id)
    }
};

function setupGrids() {
    $('#webBuilder_content .container').css({
        width: webBuilder_container_desktop
    });
    $('.webBuilder_drag-here').css({
        width: webBuilder_container_desktop + 30
    });
    $('#webBuilder_content').find('.container').css({
        width: webBuilder_container_desktop + 'px'
    }).html(webBuilder_current_content == '<p><br></p>' ? '' : webBuilder_current_content);
    $(document).find('#webBuilder_content').find('div[class*=col-]').each(function() {
        var my_class = $(this).attr('class').split(' ');
        var data_lg_size = [];
        var data_md_size = [];
        var data_sm_size = [];
        var data_xs_size = [];
        var other_classes = [];
        $.each(my_class, function(k, v) {
            if (v.indexOf('col-lg-') >= 0) {
                data_lg_size.push(v)
            } else if (v.indexOf('col-md-') >= 0) {
                data_md_size.push(v)
            } else if (v.indexOf('col-sm-') >= 0) {
                data_sm_size.push(v)
            } else if (v.indexOf('col-xs-') >= 0) {
                data_xs_size.push(v)
            } else {
                other_classes.push(v)
            }
        });
        if (data_lg_size.length > 0) {
            $(this).attr('data-lg-size', data_lg_size.join(' '))
        }
        if (data_md_size.length > 0) {
            $(this).attr('data-md-size', data_md_size.join(' ')).attr('class', (data_md_size.join(' ')).replace(new RegExp('md', 'g'), 'xs'))
        }
        if (data_sm_size.length > 0) {
            $(this).attr('data-sm-size', data_sm_size.join(' '))
        }
        if (data_xs_size.length > 0) {
            $(this).attr('data-xs-size', data_xs_size.join(' '))
        }
        if (other_classes.length > 0) {
            $(this).attr('data-xs-size', other_classes.join(' '))
        }
    });
    checkNavbars();
    wrapElements()
};

function checkNavbars() {
    $('.navbar').each(function() {
        if ($(this).hasClass('navbar-fixed-top')) {
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
    })
};

function initiateSortableTable() {
    $('.sortableTable').sortable({
        handle: '.webBuilder_move_me',
        cursorAt: {
            top: 0,
            left: 0
        }
    })
};

function initiateSortable() {
    checkEmptySortables();
    $('.sortable').sortable({
        handle: '.webBuilder_move',
        placeholder: 'webBuilder_row-placeholder',
        revert: 0,
        start: function(e, u) {
            $('.webBuilder_row-placeholder').css({
                height: u.helper[0].style.height
            })
        },
        stop: function(e, u) {
            u.item[0].removeAttribute('style');
            checkEmptySortables()
        }
    });
    $('#webBuilder_content .row > div').sortable({
        connectWith: '.row > div',
        handle: '.webBuilder_move',
        placeholder: 'webBuilder_row-placeholder',
        revert: 0,
        start: function(e, u) {
            $('.webBuilder_row-placeholder').css({
                height: u.helper[0].style.height
            })
        },
        stop: function(e, u) {
            u.item[0].removeAttribute('style');
            checkEmptySortables();
            $(e.toElement).closest('.webBuilder_wrapper').find('.webBuilder_settings, .webBuilder_move, .webBuilder_remove_wrapper').show()
        }
    })
};

function checkEmptySortables() {
    $('.row > div').each(function() {
        if ($(this).children().size() == 1) {
            $(this).css('height', 200)
        } else {
            $(this).removeAttr('style')
        }
    })
};

function wrapElements() {
    $('#webBuilder_content').find('.btn').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0 && $(this).closest('.btn-group[role=group]').size() == 0 && $(this).closest('.dropdown').size() == 0 && $(this).closest('.jumbotron').size() == 0 && $(this).closest('.btn-group[data-toggle=buttons]').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="buttons"></div>')
        }
    });
    $('#webBuilder_content').find('.btn-group[role=group]').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="buttonGroups"></div>')
        }
    });
    $('#webBuilder_content').find('.dropdown').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="buttonDropdowns"></div>')
        }
    });
    $('#webBuilder_content').find('.nav-tabs').not('[role=tablist]').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="navs"></div>')
        }
    });
    $('#webBuilder_content').find('.navbar').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="navbar"></div>')
        }
    });
    $('#webBuilder_content').find('.breadcrumb').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="breadcrumbs"></div>')
        }
    });
    $('#webBuilder_content').find('.jumbotron').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="jumbotron"></div>')
        }
    });
    $('#webBuilder_content').find('.page-header').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="pageHeader"></div>')
        }
    });
    $('#webBuilder_content').find('.alert').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="alerts"></div>')
        }
    });
    $('#webBuilder_content').find('.list-group').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="listGroup"></div>')
        }
    });
    $('#webBuilder_content').find('.panel').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0 && $(this).closest('div[role=tablist]').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="panels"></div>')
        }
    });
    $('#webBuilder_content').find('.well').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="well"></div>')
        }
    });
    $('#webBuilder_content').find('div[role=tabpanel]').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0 && $(this).closest('div[role=tablist]').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="tab"></div>')
        }
    });
    $('#webBuilder_content').find('.btn-group[data-toggle=buttons]').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            if ($(this).children().first().find('input').attr('type') == 'checkbox') {
                $(this).wrap('<div class="webBuilder_wrapper" data-widget="checkbox"></div>')
            } else {
                $(this).wrap('<div class="webBuilder_wrapper" data-widget="radioButtons"></div>')
            }
        }
    });
    $('#webBuilder_content').find('.panel-group').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="collapse"></div>')
        }
    });
    $('#webBuilder_content').find('.table-responsive').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="tables"></div>')
        }
    });
    $('#webBuilder_content').find('.carousel').each(function() {
        if ($(this).closest('.webBuilder_wrapper').size() == 0) {
            $(this).wrap('<div class="webBuilder_wrapper" data-widget="carousel"></div>')
        }
    })
};

function generateToolbar() {
    $('div[class*=col-]').each(function() {
        if ($(this).children('.webBuilder_options').size() == 0) {
            addToolbar($(this))
        }
    });
    $('.webBuilder_wrapper').each(function() {
        if ($(this).children('.webBuilder_settings').size() == 0) {
            $(this).prepend(' 				<div class="webBuilder_move" title="Move"></div> 				' + (!$(this).hasClass('webBuilder_nocog') ? '<div class="webBuilder_settings" title="Manage" data-target="#' + $(this).attr('data-widget') + '"></div>' : '') + ' 				<div class="webBuilder_remove_wrapper" title="Remove"></div> 			')
        }
    })
};

function addToolbar(el) {
    var toolbar = ' 		<div class="webBuilder_options"> 			<div class="webBuilder_add" title="Add Grid"></div> 			<div class="webBuilder_duplicate" title="Duplicate"></div> 			<div class="webBuilder_remove" title="Remove"></div> 			<div class="webBuilder_grow" title="Expand Grid"></div> 			<div class="webBuilder_sink" title="Shrink Grid"></div> 			<div class="webBuilder_offset_right" title="Expand Offset"></div> 			<div class="webBuilder_offset_left" title="Shrink Offset"></div> 		</div> 	';
    $(el).prepend(toolbar);
    if ($(el).closest('.row').children('.webBuilder_row_options').size() == 0) {
        var toolbar = ' 			<div class="webBuilder_row_options"> 				<div class="webBuilder_move" title="Move"></div> 				<div class="webBuilder_delete" title="Remove"></div> 			</div> 		';
        $(el).closest('.row').prepend(toolbar)
    }
};

function offset_div(event, current_target) {
    if ($(current_target).attr('class').indexOf('-offset-') >= 0) {
        var offset = $(current_target).attr('class').match(/\bcol-xs-offset-\S+/g).join('');
        offset = parseInt(offset.replace('col-xs-offset-', ''));
        if (offset < 12) {
            $(current_target).removeClass(function(index, className) {
                return (className.match(/\bcol-xs-offset-\S+/g) || []).join(' ')
            });
            if (event == 'right') {
                $(current_target).addClass('col-xs-offset-' + (offset + 1))
            } else {
                if (offset - 1 > 0) {
                    $(current_target).addClass('col-xs-offset-' + (offset - 1))
                }
            }
        }
    } else {
        if (event == 'right') {
            $(current_target).addClass('col-xs-offset-1')
        }
    }
};

function grow_sink(event, current_target) {
    target = current_target;
    if ($(target).attr('class').indexOf('col-lg') >= 0) {
        var offset_class = ($(target).attr('class').match(/\bcol-lg-offset\S+/g) || []).join(' ')
    } else if ($(target).attr('class').indexOf('col-md') >= 0) {
        var offset_class = ($(target).attr('class').match(/\bcol-md-offset\S+/g) || []).join(' ')
    } else if ($(target).attr('class').indexOf('col-sm') >= 0) {
        var offset_class = ($(target).attr('class').match(/\bcol-sm-offset\S+/g) || []).join(' ')
    } else if ($(target).attr('class').indexOf('col-xs') >= 0) {
        var offset_class = ($(target).attr('class').match(/\bcol-xs-offset\S+/g) || []).join(' ')
    }
    $(target).removeClass(function(index, className) {
        if (className.indexOf('col-lg-offset') >= 0) {
            return (className.match(/\bcol-lg-offset\S+/g) || []).join(' ')
        } else if (className.indexOf('col-md-offset') >= 0) {
            return (className.match(/\bcol-md-offset\S+/g) || []).join(' ')
        } else if (className.indexOf('col-sm-offset') >= 0) {
            return (className.match(/\bcol-sm-offset\S+/g) || []).join(' ')
        } else if (className.indexOf('col-xs-offset') >= 0) {
            return (className.match(/\bcol-xs-offset\S+/g) || []).join(' ')
        }
    });
    if ($(target).attr('class').indexOf('col-lg') >= 0) {
        var size = 'col-lg-';
        var newCol = $(target).attr('class').match(/\bcol-lg-\S+/g).join('')
    } else if ($(target).attr('class').indexOf('col-md') >= 0) {
        var size = 'col-md-';
        var newCol = $(target).attr('class').match(/\bcol-md-\S+/g).join('')
    } else if ($(target).attr('class').indexOf('col-sm') >= 0) {
        var size = 'col-sm-';
        var newCol = $(target).attr('class').match(/\bcol-sm-\S+/g).join('')
    } else if ($(target).attr('class').indexOf('col-xs') >= 0) {
        var size = 'col-xs-';
        var newCol = $(target).attr('class').match(/\bcol-xs-\S+/g).join('')
    }
    newCol = parseInt(newCol.replace(size, ''));
    if ((event == 'sink' && newCol - 1 == 0) || event == 'grow' && newCol == 12) {
        return false
    }
    $(target).removeClass(function(index, className) {
        if (className.indexOf('col-lg') >= 0) {
            return (className.match(/\bcol-lg-\S+/g) || []).join(' ')
        } else if (className.indexOf('col-md') >= 0) {
            return (className.match(/\bcol-md-\S+/g) || []).join(' ')
        } else if (className.indexOf('col-sm') >= 0) {
            return (className.match(/\bcol-sm-\S+/g) || []).join(' ')
        } else if (className.indexOf('col-xs') >= 0) {
            return (className.match(/\bcol-xs-\S+/g) || []).join(' ')
        }
    });
    if (offset_class != '') {
        $(target).addClass(offset_class)
    }
    if (event == 'grow') {
        $(target).addClass(size + (newCol + 1))
    } else {
        $(target).addClass(size + (newCol - 1))
    }
};

function in_array(needle, haystack) {
    for (var i in haystack) {
        if (haystack[i] == needle) return true
    }
    return false
};