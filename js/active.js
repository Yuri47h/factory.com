$(document).ready(function(){
$('li>.collection-item').each(function () {
  if($(this).attr('href') == location.href) $(this).addClass('Active');
});
});
