$(document).ajaxStart(function() {
  NProgress.start();
});

$(document).ajaxStop(function() {
  NProgress.done();
});

$(document).ready(function() {
  $('.tip').tooltip();

  $('.js-dblclick-edit').bind('dblclick', function() {
    document.location = $(this).data('dblclick-url');
  });
  
  $('.js-deferred-load').each(function() {
    $(this).load($(this).data('deferred-url'));
  });
  
  $('.js-confirm').on('click', function() {
    return confirm($(this).data('confirm'));
  });
});