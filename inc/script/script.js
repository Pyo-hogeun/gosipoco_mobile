function openMenu(){
  document.querySelector('.all-menu').classList.add('on');
  document.querySelector('body').style.overflow = 'hidden';
}
function closeMenu(){
  document.querySelector('.all-menu').classList.remove('on');
  document.querySelector('body').style.overflow = 'auto';
}
$('document').ready(function(){
  $('.board-overview .header > ul > li > a').on('click', function(e){
    e.preventDefault();
    $(this).parents('li').addClass('on').siblings('li').removeClass('on');
  })
})