// Include the Quill library
import 'https://cdn.quilljs.com/1.3.6/quill.js';

const image = (e) => {
    const img = document.querySelector('#preImg');
    if(img.src !== '') {
        console.log('a');
        URL.revokeObjectURL(img.src);
    }
    const url = URL.createObjectURL(e.target.files[0]);
    img.setAttribute('src', url);
}

const img = document.querySelector('#image');
img.addEventListener('change', image);

const modules = {
    toolbar: {
        container : [
            [{header: [1,2,3,false]}],
            ["bold","italic","underline","strike"],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
        ],
    },
}

const formats =
    [
    "header",
    "bold",
    "italic",
    "underline",
    "strike",
    "align",
    "list",
    "bullet",
    "background",
    "color",
    "image",
];

const quill = new Quill('#editor', {
    theme: 'snow',
    modules: modules,
    formats: formats,
});
quill.on('text-change', () => {
    const data = quill.root.innerHTML;
    const content = document.querySelector('#htmlContent');
    content.value = data;
});


