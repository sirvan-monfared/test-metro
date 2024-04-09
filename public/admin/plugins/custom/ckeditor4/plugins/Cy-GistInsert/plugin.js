/*
 CKEditor Plugin 
 name : Cy-GistInsert.
 
 2016-08-27.started by igotit. 

*/
CKEDITOR.plugins.add( 'Cy-GistInsert', {
    icons: 'Cy-GistInsert',
    init: function( editor ) {
        editor.addCommand( 'cmd-insertgist1', new CKEDITOR.dialogCommand('Cy-GistInsertDlg')); // adding command with dialog.
        editor.ui.addButton( 'Cy-GistInsert', {
            label: 'Insert GitHub Gist',      // button's tooltip text.
            command: 'cmd-insertgist1',       // the command to be executed when the button is clicked.
            toolbar: 'insert'                 // toolbar groub into which the button will be added
        });

        /// begin - context menu
        if (editor.contextMenu) {
            editor.addMenuGroup('Group_CyGistInsert');
            editor.addMenuItem('Item_CyGistInsert', {
                label: 'Edit Cy-GistInsert',
                icon: this.path + 'icons/Cy-GistInsert.png',
                command: 'cmd-insertgist1',
                group: 'Group_CyGistInsert'
            });

            editor.contextMenu.addListener(function (element) {

                if (element.getAscendant('div').getId() == 'Cy-GistInsert') { // <div id="Cy-GistInser"> </div> 

                    return { Item_CyGistInsert: CKEDITOR.TRISTATE_OFF };
                }
            });
        }
        /// end - context menu

        CKEDITOR.dialog.add('Cy-GistInsertDlg', this.path + 'dialogs/Cy-GistInsertDlg.js');  // related to real dlg filepath and file name. 
    }
});
