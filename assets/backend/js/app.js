window.$ = window.jQuery = require('jquery');
window.eModal = require('./eModal');
//window.notify = require('./notify');
window.notify = require('bootstrap-notify');

require('bootstrap');
import '../plugins/bootstrap4-editable/css/bootstrap-editable.css';
const EditableForm = require('../plugins/bootstrap4-editable/js/bootstrap-editable.min');
global.EditableForm = EditableForm;

//import '../css/template.css';
import '../css/app.css';

import '../theme/fonts/feather-font/css/iconfont.css';
import '../theme/plugins/perfect-scrollbar/perfect-scrollbar.css';

const feather = require('../theme/plugins/feather-icons/feather.min.js');
const PerfectScrollbar = require('../theme/plugins/perfect-scrollbar/perfect-scrollbar.min.js');

global.feather = feather;
global.PerfectScrollbar = PerfectScrollbar;

import '../theme/plugins/datatables-net/dataTables.bootstrap4.css';
require('../theme/plugins/datatables-net/jquery.dataTables.js');
require('../theme/plugins/datatables-net-bs4/dataTables.bootstrap4.js');

import '../theme/plugins/@mdi/css/materialdesignicons.min.css';
import '../theme/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css';

//require('../theme/plugins/chartjs/Chart.min.js');
require('chart.js');
require('../theme/plugins/jquery.flot/jquery.flot.js');
require('../theme/plugins/jquery.flot/jquery.flot.resize.js');
require('../theme/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
const ApexCharts = require('../theme/plugins/apexcharts/apexcharts.min.js');
global.ApexCharts = ApexCharts;
require('../theme/plugins/progressbar-js/progressbar.min.js');

require('../theme/js/dashboard');
require('../theme/js/datepicker');
require('../theme/js/template');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


$(".alert").delay(4000).slideUp(200, function() {
    $(this).alert('close');
});

$(document).on('click', '.js-emodal', function (e) {
    e.preventDefault();

    var options = {
        url: $(this).attr('href'),
        title: $(this).attr('title') ? $(this).attr('title') : '',
        size: $(this).attr('size') ? $(this).attr('size') : eModal.size.lg,
        buttons: []
    };

    eModal.ajax(options);
});


import '../theme/plugins/select2/css/select2.css';
import '../theme/plugins/select2/select2.min';

$(document).on('change', '[js-change-load]', function () {
    var path = $(this).parents('form:first').attr('action') ?? window.location.href;
    var load_item = $(this).attr('js-change-load');

    var data = {};
    data[$(this).attr('name')] = $(this).val();

    $.ajax({
        url : path,
        type: 'get',
        data : data,
        success: function(html) {
            load_item.split(" ").forEach(function (item) {
                $(item).replaceWith(
                    $(html).find(item)
                );
            });
            ajax_init();
        }
    });
});



function ajax_init() {
    if ($(".select2").length) {
        $(".select2").select2();
    }
}

$(function() {
    ajax_init();
});

import '../theme/sass/app.scss';

