window.onload = function(){
  var rBar = document.getElementById('r-bar');
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
