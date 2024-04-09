function startCKEditor(selector) {
    ClassicEditor.create(document.querySelector(selector), {
        language: 'fa'
    })
}

/**
 * Replaces the given input with ckEditor instance
 * @param element_id
 * @param with_upload
 */
function startCKEditor4(element_id, upload_url, csrf_tokne) {
    upload_url = upload_url || false;

    if (upload_url) {
        const editor = CKEDITOR.replace(element_id, {
            language: 'fa',
            filebrowserUploadUrl: upload_url,
            extraPlugins: 'codesnippet, oembed, Cy-GistInsert',
            toolbar: 'Full',
        });

        editor.on('fileUploadRequest', function (evt) {
            var xhr = evt.data.fileLoader.xhr;

            xhr.setRequestHeader('X-CSRF-TOKEN', csrf_tokne);
            xhr.withCredentials = true;
        });
    } else {
        CKEDITOR.replace(element_id, {
            language: 'fa'
        });
    }

    ckEditorAddNofllowOnExternalLinks();
}

function ckEditorAddNofllowOnExternalLinks()
{
    CKEDITOR.on('instanceReady', function (ev) {
        var editor = ev.editor;
        editor.dataProcessor.htmlFilter.addRules({
            elements: {
                a: function (element) {
                    if (!element.attributes.rel) {
                        var url = element.attributes.href;
                        var hostname = (new URL(url)).hostname;
                        if (hostname !== window.location.host && hostname !== "kodesign.ir") {
                            element.attributes.rel = 'nofollow';
                        }
                    }
                }
            }
        });
    })
}
