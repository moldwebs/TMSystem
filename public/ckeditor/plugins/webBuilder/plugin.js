/*
	Plugin	: Web Builder
	Author	: Moldwebs
	Version	: 1.0
*/

CKEDITOR.plugins.add('webBuilder', {
    icons: 'webBuilder',
    init: function(editor) {
        editor.addCommand('webBuilder', {
            exec: function(editor) {
                bootstrapGrid_CKEDITOR_instance = editor;
                var webBuilder_iframe = document.createElement('iframe');
                webBuilder_iframe.src = CKEDITOR.plugins.getPath('webBuilder') + 'web_builder.html';
                webBuilder_iframe.style.position = 'fixed';
                webBuilder_iframe.style.top = 0;
                webBuilder_iframe.style.left = 0;
                webBuilder_iframe.style.border = 0;
                webBuilder_iframe.style.height = '100%';
                webBuilder_iframe.style.width = '100%';
                webBuilder_iframe.style.zIndex = 999;
                webBuilder_iframe.id = 'webBuilder_iframe';
                document.body.appendChild(webBuilder_iframe);
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_current_element = editor;
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_current_element_popup = editor;
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_current_content = editor.document.$.body.innerHTML;
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_container_large_desktop = editor.config.webBuilder_container_large_desktop ? editor.config.webBuilder_container_large_desktop : 1170;
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_container_desktop = editor.config.webBuilder_container_desktop ? editor.config.webBuilder_container_desktop : 970;
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_container_tablet = editor.config.webBuilder_container_tablet ? editor.config.webBuilder_container_tablet : 750;
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_grid_columns = editor.config.webBuilder_grid_columns ? editor.config.webBuilder_grid_columns : 12;
                document.getElementById('webBuilder_iframe').contentWindow.mj_variables_bootstrap_css_path = editor.config.mj_variables_bootstrap_css_path ? editor.config.mj_variables_bootstrap_css_path : 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css';
                document.getElementById('webBuilder_iframe').contentWindow.mj_variables_bootstrap_js_path = editor.config.mj_variables_bootstrap_js_path ? editor.config.mj_variables_bootstrap_js_path : 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js';
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_fileManager = editor.config.webBuilder_fileManager ? editor.config.webBuilder_fileManager : 'ckeditor';
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_ckfinder_path = editor.config.webBuilder_ckfinder_path;
                document.getElementById('webBuilder_iframe').contentWindow.webBuilder_ckfinder_version = editor.config.webBuilder_ckfinder_version
                document.getElementById('webBuilder_iframe').contentWindow.contentsCss = editor.config.contentsCss ? editor.config.contentsCss : '';
            }
        });
        editor.addContentsCss(CKEDITOR.plugins.getPath('webBuilder') + 'css/bootstrapGrid.css');
        editor.ui.addButton('webBuilder', {
            label: 'Web Builder',
            command: 'webBuilder'
        })
    }
});

for(var i in CKEDITOR.instances){
	CKEDITOR.instances[i].ui.addButton('webBuilder', {
        command : 'webBuilder',
        icon 	: this.path + 'icons/webBuilder.png',
    });
}