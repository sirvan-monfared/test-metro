Cy-GistInsert.

CKEditor plugin for easily insert into codes from GitHub Gist. 

tested CKEditor version : 4.5.10

How to install. 
1. download the Cy-GistInsert.zip and then unlock the download zip file using windows explorer. 
 - how to unlock the zip file -> http://www.advsofteng.com/unblock_zip.html
2. unzip the Cy-GistInsert.zip file. 
3. upload all the "Cy-GistInsert" folder into web server's "ckeditor/plugins/"
4. add the  config.extraPlugins = 'Cy-GistInsert';  in ckeditors/config.js file. 

How to use. 
run CKEditor,  click the Cy-GistInsert button and then copy paste the "Gist id" and then click ok button.
(Gist ID can be found on url ex.https://gist.github.com/igotit-anything/90ea1095c785a41dd8409bd92d86c6f7 in this case, the Gist id is 90ea1095c785a41dd8409bd92d86c6f7 )

IMPORTANT : Mandatory settings before using Cy-GistInsert. 
1. gist-embed should be applied on web page.  
- gist-embed : https://github.com/blairvanderhoof/gist-embed
2. config.allowedContent = true;  in ckeditors/config.js


///end. 2018-08-28.

Cy-GistInsert release site : https://github.com/igotit-anything/Cy-GistInsert
