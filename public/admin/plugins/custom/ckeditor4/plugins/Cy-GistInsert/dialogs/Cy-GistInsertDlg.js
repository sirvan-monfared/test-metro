/*
    file name : Cy-GistInsertDlg.js
    CKEditor Plugin "Cy-GistInsert" Dialog 

    2016-08-28. started by igotit. 
*/

CKEDITOR.dialog.add('Cy-GistInsertDlg', function (editor) {
    return {
        title: 'Cy-GistInsert', // text shown titlebar.
        minWidth: 400,
        minHeight: 100,

        contents: [
            {
                id: 'tab-basic',
                label: 'Basic Settings',
                elements: [
                    // UI elements of the first tab should be defined here.
                    {
                        type: 'text',
                        id: 'id-gisturi',
                        label: 'GitHub Gist ID',
                        validate: CKEDITOR.dialog.validate.notEmpty("GitHub Gist ID field cannot be empty."),

                        setup: function (element_code) {
                            this.setValue(element_code.getAttribute("data-gist-id"));
                        },

                        commit: function (element_code, element_a) {
                            var url_gist_modi = 'https://gist.github.com/' + this.getValue();
                            element_a.setAttribute('href', url_gist_modi);
                            element_a.removeAttribute('data-cke-saved-href'); // important . if not this, the href not changing.

                            element_code.setAttribute("data-gist-id", this.getValue());
                            element_code.setText('[Gist Code Inserted.id=' + this.getValue() + ' : Cy-GistInsert]');                            
                        }
                    }
                ]
            }
        ],
        onShow: function () {
            var selection = editor.getSelection();
            var element_start = selection.getStartElement();
            var element_div; 
            var element_code;
            var element_a; 

            if (element_start)
            {
                element_div = element_start.getAscendant('div', true); // ascendant from element_start
            }

            if (!element_div || element_div.getId() != 'Cy-GistInsert') {  // 
                //                element = editor.document.createElement('div');   // 
                this.insertMode = true;                
            }
            else
            {
                
                if (element_div.getChild(0).getName() == 'br') // CKEditor bug adding <br /> 
                {
                    element_a = element_div.getChild(1);    // descendants from first div
                    element_code = element_div.getChild(2); // descendants from first div

                }
                else // if there is no <br/> after <div>
                {
                    element_a = element_div.getChild(0);    // descendants from first div
                    element_code = element_div.getChild(1); // descendants from first div
                }

                this.element_a = element_a;
                this.element_code = element_code;

                this.insertMode = false;
            }

            if (!this.insertMode)
            {
                this.setupContent(this.element_code);
            }                
        },

        onOk: function () {
            var dialog = this;

            if (dialog.insertMode == false)
            {
                dialog.commitContent(dialog.element_code, dialog.element_a);
            }
            else if (dialog.insertMode == true)
            {
                var link_url_id = dialog.getValueOf('tab-basic', 'id-gisturi');
                var url_gist = 'https://gist.github.com/' + link_url_id;
                
                editor.insertHtml('<div id="Cy-GistInsert">', 'html');/// start <div>

                /// making link gist
                // var elem_linkgist = editor.document.createElement('a'); // element creation. <a> </a>
                // elem_linkgist.setAttribute('href', url_gist);
                // elem_linkgist.setAttribute('target', '_blank');
                // elem_linkgist.setAttribute('title', 'View following codes at GitHub Gist. new window');
                // elem_linkgist.setText('code from Gist');
                // editor.insertElement(elem_linkgist);

                /// making <code> </code> gist-embed style. gist-embed-> https://github.com/blairvanderhoof/gist-embed
                var elem_CyGistInsert = editor.document.createElement('code'); // element creation. ie. <code> </code>
                elem_CyGistInsert.setAttribute('data-gist-id', link_url_id); // making <code data-gist-id=18ashyr3478

                elem_CyGistInsert.setText('[Gist Code Inserted.id=' + link_url_id + ' : Cy-GistInsert]'); // making <code data-gist-id=18ashyr3478 data-gist-hide-footer="true">[Code expression Gist. by plugin:Cy-GistInsert]</code> , this text can be seen in CKEditor. Now shown in Browser
                editor.insertElement(elem_CyGistInsert); // code 

                editor.insertHtml('</div>');/// end </div>                
            }  
        }
    };
});
