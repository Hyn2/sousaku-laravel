// Include the Quill library
import 'https://cdn.quilljs.com/1.3.6/quill.js';

var options = {
    readOnly: true,
};

const getData = document.querySelector('#editorReadOnly').getAttribute('data');
var reader = new Quill('#editorReadOnly', options);

reader.setContents(reader.clipboard.convert(getData));
