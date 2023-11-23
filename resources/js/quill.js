const imageHandler = () => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('name', 'image');
    input.click();
    input.addEventListener('change', async () => {
        const formData = new FormData();
        formData.append('image', input.files[0]);
        const response = await axios.post('http://localhost:8000/api/image', formData);
        const editor = document.querySelector('.ql-editor');
        const img = document.createElement('img');
        img.setAttribute('src', response.data);
        editor.appendChild(img);
    });
}

const target = document.querySelector('#editor');

const config = {
    childList: true,
    subtree: true,
};

const observer = new MutationObserver((mutations, observer) => {
    mutations.map((element)=> {
        console.log(element);
        // if(element.removedNodes.length > 0) {
        //     console.log(element.removedNodes[0]);
        // }
    })
});

observer.observe(target, config);

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
