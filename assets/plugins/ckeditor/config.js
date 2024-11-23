/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */



CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.removePlugins = 'forms,save,newpage,language';	
	config.entities = false;
	config.scayt_autoStartup = true;	
	config.allowedContent = true;
	config.oembed_maxWidth = '560';
	config.oembed_maxHeight = '315';
	config.fullPage = false;
	config.height = '400px';
};
