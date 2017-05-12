  /*  CKEDITOR.plugins.add('newplugin',
    {
        init: function (editor) {
            var pluginName = 'newplugin';
            editor.ui.addButton('newplugin',
                {
                    label: 'TopLine',
                    command: 'OpenWindow',
                    icon: CKEDITOR.plugins.getPath('newplugin') + 'Favicon.gif'
                });
            var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
        }
    });
    function showMyDialog(e) {
		alert(CKEDITOR.plugins.getPath('newplugin'));
       // window.open('/index.html', 'MyWindow', 'width=500,height=500,scrollbars=no,scrolling=no,location=no,toolbar=no');
    }*/
 

 CKEDITOR.plugins.add('newplugin',
{
	requires: ['iframedialog'],
	init: function(editor)
	{
		var pluginName = 'newplugin';
		var mypath     = this.path;
		CKEDITOR.dialog.addIframe( pluginName, 'Topline', mypath+'about-topline.php', 400, 300, false);
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
		editor.ui.addButton('newplugin',
		{
			label: 'TopLine',
			command: pluginName,
			icon: this.path + 'Favicon.gif'
		});
	}
});
