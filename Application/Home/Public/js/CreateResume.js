window.onload = function(){
  var rBar = document.getElementById('r-bar');
  var upload = document.getElementById('head-pic');
  var saveBtn = document.getElementsByClassName('btn-save');
  console.log(saveBtn);
  upload.addEventListener('change', function() {
    uploadHead();
    // upl();
  });
  addEvents(saveBtn,'click', submitInfo);
  switchBar(rBar);
}

var switchBar = function(e) {
  e.addEventListener('click', function(){
    var _this = event.target;
    var target = _this.getAttribute('data-target');
    var editBlocks = document.getElementsByClassName('edit-block');
    var targetSection = document.getElementsByClassName(target)[0];
    var items = document.getElementsByClassName('nav-item');

    if(targetSection){
      for(var i = 0, iLen = items.length; i < iLen; i++) {
        items[i].classList.remove('active');
      }
      for(var j = 0, eLen = editBlocks.length; j < eLen; j++){
        editBlocks[j].classList.add('hide');
      }
      targetSection.classList.remove('hide');
      _this.classList.add('active');
    }
  }, false);
}

// var upl = function () {
//   var file = $('#head-pic').val();
//   var data = new FormData($('form')[0]);
//   // data.append('img',file);
//   var data1 = new FormData();
//   data1.append('img',$('#head-pic')[0].files[0]);
//   console.log(data1,data,$('#head-pic')[0].files[0])
//   $.ajax({
//     url: 'EditResume/uploadImg',
//     type: 'POST',
//     data: data1,
//     dataType: 'json',
//     processData: false,
//     contentType: false,
//     beforeSend: function(){
//       // console.log(data)
//     },
//     success: function(res){
//
//     },
//   })
// }

var uploadHead = function() {
  var file = document.querySelector('#head-pic').files[0];
  var data = new FormData();
  data.append('img',file);
  console.log(data,document.querySelector('#head-pic').files[0]);
  ajax({
    type: 'post',
    url: 'EditResume/uploadImg',
    data: data,
    dataType: 'json',
    success: function(res) {

    },
    error: function() {
      console.log("error");
    }
  })
}

var submitInfo = function() {
  var _this = event.target;
  console.log(_this);
  var form = document.getElementById(_this.getAttribute('data-submit'));
  var data = new FormData(form);
  data.append('module', form.getAttribute('id'));
  ajax({
    type: 'post',
    url: 'EditResume/SaveInfo',
    data: data,
    dataType: 'json',
    success: function(res) {

    } ,
    error: function() {
      console.log('error');
    }
  })
}
var addEvents = function(objArr, eventName, funcName) {
  for(var i = 0; i < objArr.length; i++){
    objArr[i].addEventListener(eventName, funcName);
  }
}
