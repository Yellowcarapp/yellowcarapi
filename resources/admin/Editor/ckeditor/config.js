/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/


CKEDITOR.editorConfig = function( config )
{
	 //Define changes to default configuration here. For example:
	       config.language = 'ar';
	        //config.uiColor = '#AADC6E';
	       //config.font_names = 'Tahoma;Arial;Times New Roman;Verdana';
  	       config.pasteFromWordRemoveFontStyles = false;
	       config.pasteFromWordRemoveStyles = false;
	       config.pasteFromWordIgnoreFontFace = false;
           //config.contentsCss = 'contents.css';

	       config.font_defaultLabel = 'Tahoma';
 		  
		  
		    config.extraPlugins = 'uicolor,newplugin';
		    // config.toolbar = 'Full'
 		    config.toolbar = 'MyToolbar';
			config.toolbar_MyToolbar =
			[    
			['Source','-','Save','NewPage','-','Templates','Preview'],
			['Cut','Copy','Paste','PasteText','PasteFromWord','-'],
			['Undo','Redo','-','Replace','-','RemoveFormat'],
			
		   
			'/',
			['Bold','Italic','Underline','Strike','-'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['NumberedList','BulletedList','-','CreateDiv'],
 			['Link','Unlink','Anchor'],[ 'UIColor' ],
			
			'/',
			['Styles','Format','Font','FontSize'],
			['TextColor','BGColor'], ['BidiLtr', 'BidiRtl'],
			['Maximize', 'ShowBlocks'],
		  
		    ['Image','Flash','Table','HorizontalRule','SpecialChar'],
			];
	
	
  };
 