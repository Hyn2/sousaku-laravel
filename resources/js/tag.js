const tags = document.querySelectorAll('.tag');
tags.forEach((tag)=> {
    tag.addEventListener('click', (e)=> {
        e.preventDefault();
        e.target.classList.toggle('clicked');
        const position = document.getElementById(e.target.value);
        position.selected = e.target.classList.contains('clicked');
    });
});
