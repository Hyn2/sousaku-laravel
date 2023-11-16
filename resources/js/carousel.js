// 변수 & 함수 선언
const container = document.querySelector('#container');
const nextButton = document.querySelector('#next');
const prevButton = document.querySelector('#prev');
const nextButtonClick = (e) => {
    const id = e.target.id;
    container.style.transform = `translateX(-${100}%)`;
    container.style.transitionDuration = '700ms';
    container.ontransitionend = () => {
        replaceElement(id)
    }
}
const prevButtonClick = (e) => {
    const id = e.target.id;
    container.style.transform = `translateX(${100}%)`;
    container.style.transitionDuration = '700ms';
    container.ontransitionend = () => {
        replaceElement(id);
    }
}

const replaceElement = (id) => {
    container.removeAttribute('style');
    (id === 'next') ?
        container.appendChild(container.firstElementChild) :
        container.insertBefore(container.lastElementChild, container.firstElementChild);
}

// 이벤트 등록
nextButton.addEventListener('click', nextButtonClick);
prevButton.addEventListener('click', prevButtonClick);



