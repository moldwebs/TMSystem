/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function () {
  const config = CKEDITOR.config;
  //config.extraAllowedContent = 'div(*);picture';

  // Define changes to default configuration here.
  // For complete reference see:
  // http://docs.ckeditor.com/#!/api/CKEDITOR.config

  // The toolbar groups arrangement, optimized for two toolbar rows.
  config.toolbarGroups = [
    {name: 'clipboard', groups: ['clipboard', 'undo']},
    {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
    {name: 'links'},
    {name: 'insert'},
    {name: 'forms'},
    {name: 'tools'},
    {name: 'document', groups: ['mode', 'document', 'doctools']},
    {name: 'others'},
    '/',
    {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
    {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
    {name: 'styles'},
    {name: 'colors'},
    {name: 'about'},
    //{name: 'insert', items: ['webBuilder', 'Source']}
  ];

  // Remove some buttons provided by the standard plugins, which are
  // not needed in the Standard(s) toolbar.
  // config.removeButtons = 'Subscript,Superscript';
  config.extraPlugins = 'justify,webBuilder,youtube,lobiUploader,blockquote';
  // Set the most common block elements.
  config.format_tags = 'p;h1;h2;h3;pre';

  // Simplify the dialog windows.
  //config.removeDialogTabs = 'image:advanced;link:advanced';

  //config.extraPlugins = 'webBuilder';
  //config.contentsCss = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
  //config.mj_variables_bootstrap_css_path = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css';
  //config.mj_variables_bootstrap_js_path = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js';
  config.allowedContent = true;
  config.fillEmptyBlocks = false;
  config.webBuilder_container_large_desktop = 1170;
  config.webBuilder_container_desktop = 970;
  config.webBuilder_container_tablet = 750;
  config.webBuilder_grid_columns = 12;
  config.webBuilder_ckfinder_version = 3;
  config.webBuilder_ckfinder_path = '/bundles/cksourceckfinder/ckfinder/ckfinder.js';

  config.contentsCss = [
      '/frontend/css/bootstrap.min.css',
      '/frontend/css/font-awesome.min.css',
      '/frontend/js/revolution-slider/css/settings.css',
      '/frontend/css/owl.theme.css',
      '/frontend/css/owl.carousel.css',
      '/frontend/css/style.css',
  ];

  $.each(CKEDITOR.dtd.$removeEmpty, function (i, value) {
    CKEDITOR.dtd.$removeEmpty[i] = false;
  });

  //config.height = 500;

})();
