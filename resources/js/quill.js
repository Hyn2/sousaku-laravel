const imageHandler = () => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('name', 'image');
    input.click();
    input.addEventListener('change', async () => {
        const formData = new FormData();
        formData.append('image', input.files[0]);
        const response = await axios.post('http://localhost:8000/api/image', formData);
        console.log(response);
    });
}

const modules = {
    toolbar: {
        container : [
            ["image"],
            [{header: [1,2,3,false]}],
            ["bold","italic","underline","strike"],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
        ],
        handlers: {
            image: imageHandler,
        },
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
