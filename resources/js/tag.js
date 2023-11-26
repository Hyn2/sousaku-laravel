const createOptionTag = (value) => {
    const option = document.createElement('option');
    option.setAttribute('selected', true);
    option.setAttribute('value', value);
    return option;
}

const tags = document.querySelectorAll('.tag');
tags.forEach((tag)=> {
    tag.addEventListener('click', (e)=> {
        e.preventDefault();
        const positions = document.querySelector('#positions');

        positions.appendChild(createOptionTag(e.target.value));
    });
});
