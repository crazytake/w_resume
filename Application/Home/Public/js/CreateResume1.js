$(function(){
  $('#r-bar').on('click', '.nav-item',function() {
    var _this = $(event.target);
    var editBlocks = $('.edit-block');
    var targetSection = $('.'+_this.data('target'));
    var items = $('.nav-item');
    if(targetSection){
      _this.addClass('active');
      _this.siblings().removeClass('active');
      editBlocks.addClass('hide');
      targetSection.removeClass('hide');
    }
  });

  $('.btn-add').on('click', function() {
    var targetClass = '.'+$(this).data('target');
    var listItem = $(targetClass).html();
    var listItem = $('<div class="'+targetClass.substring(1)+'"></div>').append(listItem);
    console.log(listItem);
    $(targetClass).parent().append(listItem);
  });
});
