var quill = new Quill('#editor', {
    theme: 'snow'
});
quill.on('text-change', () => {
const data = quill.root.innerHTML;
console.log(data);
const content = document.querySelector('#htmlContent');
content.value = data;
})
