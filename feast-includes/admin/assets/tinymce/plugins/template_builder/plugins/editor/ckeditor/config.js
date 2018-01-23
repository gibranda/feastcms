/**6
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    config.language = 'en';
	
    config.allowedContent = true;

    config.title = false;

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	//config.removeDialogTabs = 'image:advanced;link:advanced';
    config.removeDialogTabs = 'link:advanced';

	config.removePlugins = 'showblocks,magicline';

	config.extraPlugins = 'template_builder_buttons';

	config.toolbar = [
        ['Cut', 'Copy', '-', 'Undo', 'Redo'],
        //['Bold','Italic','Underline'],
        //['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        //['Styles', 'Format', 'Font', 'FontSize' ],
        //['Image', 'Table', 'Iframe', '-', 'Link', 'Unlink'],
        //['Table'],
        ['Source', 'Maximize'],

        ['template_builder_col_conf', 'template_builder_col_change_type'],
        ['template_builder_col_move_left', 'template_builder_col_move_right'],
        ['template_builder_col_add'],
        ['template_builder_col_delete']
    ];
    config.skin = 'be';
}