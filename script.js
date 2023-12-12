//Change navbar color when onScroll :)
const header = document.querySelector('header');
window.addEventListener('scroll', () => {
  if (window.pageYOffset > 0) {
    header.classList.add('bg-white');
    header.classList.add('shadow-md');
  } else {
    header.classList.remove('bg-white');
    header.classList.remove('shadow-md');
  }
});
