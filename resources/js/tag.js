const tags = document.querySelectorAll('.tag');
tags.forEach((tag)=> {
    tag.addEventListener('click', (e)=> {
        e.preventDefault();
        e.target.classList.toggle('clicked');
        const position = document.getElementById(e.target.value);
        if(e.target.classList.contains('clicked')) {
            position.selected = true;
        } else {
            position.selected = false;
        }

    });
});
