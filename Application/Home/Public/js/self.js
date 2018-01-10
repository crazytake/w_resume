$(function(){
  $('.btn-hc').on('click', function(){
    $('#file').trigger('click');
  });
  $('#file').on('change', function() {
    var fr = new FileReader();
    fr.onloadend = function(e){
      console.log(e.target.result);
      $('#avatar-img').attr('src',e.target.result);
    }
    var avatar = this.files[0];
    fr.readAsDataURL(avatar);
    var data = new FormData();
    data.append('avatar',avatar);
    console.log(data);
    $.ajax({
      url: 'User/set_avatar',
      type: 'post',
      data: data,
      // contentType: 'multipart/form-data;charset=utf-8',
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(res){
        console.log(res);
      },
      error: function(){
        console.log('error');
      }
    })
  })
});
