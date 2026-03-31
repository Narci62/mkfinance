/*
 *  Document   : app.js
 *  Author     : pixelcave
 *  Description: Main entry point
 *
 */
// Import required modules
import Template from './modules/template.js';
//flag icon
import "/node_modules/flag-icons/css/flag-icons.min.css";
//checkeditor5 package
import { ClassicEditor, Essentials, Bold, Italic, Font, Paragraph } from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
ClassicEditor.create(document.querySelector('#content'), {
  plugins: [Essentials, Bold, Italic, Font, Paragraph],
  toolbar: [
      'undo', 'redo', '|', 'bold', 'italic', '|',
      'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
      
  ],
  
  ui: {
    poweredBy: {
        forceVisible: false,
        position: 'inside',
        side: 'left',
        label: 'This is'
    }
}
})
.then( /* ... */ )
.catch( /* ... */ );

// App extends Template
export default class App extends Template {
  /*
   * Auto called when creating a new instance
   *
   */
  constructor() {
    super();
  }

  /*
   *  Here you can override or extend any function you want from Template class
   *  if you would like to change/extend/remove the default functionality.
   *
   *  This way it will be easier for you to update the module files if a new update
   *  is released since all your changes will be in here overriding the original ones.
   *
   *  Let's have a look at the _uiInit() function, the one that runs the first time
   *  we create an instance of Template class or App class which extends it. This function
   *  inits all vital functionality but you can change it to fit your own needs.
   *
   */

  /*
   * EXAMPLE #1 - Removing default functionality by making it empty
   *
   */

  //  _uiInit() {}


  /*
   * EXAMPLE #2 - Extending default functionality with additional code
   *
   */

  //  _uiInit() {
  //      // Call original function
  //      super._uiInit();
  //
  //      // Your extra JS code afterwards
  //  }

  /*
   * EXAMPLE #3 - Replacing default functionality by writing your own code
   *
   */

  //  _uiInit() {
  //      // Your own JS code without ever calling the original function's code
  //  }
}

// Create a new instance of App
window.Dashmix = new App();
