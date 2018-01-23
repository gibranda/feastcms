tinymce.PluginManager.add('example', function(editor, url) {
   // Adds a menu item to the tools menu
   editor.addMenuItem('example', {
      id: 'myPluginId',
      text: 'My Plugin Menu Title',
      context: 'insert',
      onclick: function() {
         editor.windowManager.open({
            title: 'Title Of My Plugin',
            url: 'example.html',
            //we create the submit buttons here instead of in our HTML page
            buttons: [{
                  text: 'Submit',
                  onclick: 'submit'
               }, {
                  text: 'Cancel',
                  onclick: 'close'
               }],
            width: 500,
            height: 325,
            onsubmit: function(e) {
               //find the popup, get the iframe contents and find the HTML form in the iFrame
               form = $('#myPluginId iframe').contents().find('form');

               //once you have the form, you can do whatever you like with the data from here
            }
         });
      }
   });
});