function openMenu(){
  document.querySelector('.all-menu').classList.add('on');
  document.querySelector('body').style.overflow = 'hidden';
}
function closeMenu(){
  document.querySelector('.all-menu').classList.remove('on');
  document.querySelector('body').style.overflow = 'auto';
}