window.onload = function(){
  var rBar = document.getElementById('r-bar');
  var upload = document.getElementById('head-pic');
  var saveBtn = document.getElementsByClassName('btn-save');
  var timeSelector = document.getElementsByClassName('time-input');
  var timeSelectorYear = document.getElementsByClassName('select-item-year');
  var timeSelectorMonth = document.getElementsByClassName('select-item-month');
  var AddModuleBtn = document.getElementsByClassName('btn-add');
  upload.addEventListener('change', function() {
    uploadHead();
  });
  saveBtn.addEvents('click', submitInfo);
  switchBar(rBar);
  timeSelector.addEvents('click', checkTimeSelector);
  timeSelectorYear.addEvents('click', selectedYear);
  timeSelectorMonth.addEvents('click', selectMonth);
  document.querySelector('.time-selector .year').scrollUnique();
  document.querySelector('.time-selector .month').scrollUnique();
  AddModuleBtn.addEvents('click', addModuleItem);
}

var selectedYear = function (e){
  var _this = e.target;
  if(_this.className != 'selected'){
    if(_this.siblings('.selected').length != 0){
      _this.siblings('.selected')[0].className = '';
    }
    _this.className = 'selected';
    _this.parentNode.parentNode.setAttribute('data-year', _this.innerHTML);
  } else {
    _this.className = '';
  }
}
var selectMonth = function(e) {
  var _this = e.target;
  var input = _this.parentNode.parentNode.previousElementSibling;
  if(_this.className != 'selected'){
    if(_this.siblings('.selected').length != 0){
      _this.siblings('.selected')[0].className = '';
    }
    _this.className = 'selected';
    var year = _this.parentNode.parentNode.getAttribute('data-year');
    var month = _this.getAttribute('data-value');
    input.value = year+'/'+month;
    _this.parentNode.parentNode.style.display = 'none';
  } else {
    target.className = '';
  }
}
var checkTimeSelector = function() {
  var _this = event.target;
  var selector = _this.nextElementSibling;
  if(selector.style.display == '' || selector.style.display == 'none') {
    selector.style.display = 'inline-block';
  }else {
    selector.style.display = 'none';
  }
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



var uploadHead = function() {
  var file = document.querySelector('#head-pic').files[0];
  var data = new FormData();
  data.append('img',file);
  ajax({
    type: 'post',
    url: 'EditResume/uploadImg',
    data: data,
    contentType: 'multipart/form-data',
    dataType: 'json',
    success: function(res) {

    },
    error: function() {
      console.log("error");
    }
  })
}



var addModuleItem = function() {
  var _this = event.target;
  var editBlock = document.getElementsByClassName(_this.getAttribute('data-target'))[0];
  console.log(editBlock.classList);
  if(editBlock.classList.contains('hide')){
    _this.innerHTML = '取消';
    editBlock.classList.remove('hide');
  } else{
    _this.innerHTML = '添加';
    editBlock.classList.add('hide');
  }
}

var submitInfo = function() {
  var _this = event.target;
  var targetModule = _this.getAttribute('data-block');
  var username = document.getElementsByName('username')[0].value,
      birthday = document.getElementsByName('birthday')[0].value,
      location = document.getElementsByName('location')[0].value,
      experience = document.getElementsByName('experience')[0].value,
      phone = document.getElementsByName('phone')[0].value,
      email = document.getElementsByName('email')[0].value,
      oneword = document.getElementsByName('oneword')[0].value;
  var data = {};
  if(targetModule == 'baseInfo'){
    // data['username'] = username;
    // data['birthday'] = birthday;
    // data['location'] = location;
    // data['experience'] = experience;
    // data['phone'] = phone;
    // data['email'] = email;
    // data['oneword'] = oneword;
    data = {
      'baseinfo':{
          'username': username,
          'birthday': birthday,
          'location': location,
          'experience': experience,
          'phone': phone,
          'email': email,
          'oneword': oneword
        }
    }
  } else if (targetModule == 'intension') {
    data = {
      'intension':{
        'expect_job': document.getElementsByName('expect_job')[0].value,
        'expect_type': document.getElementsByName('expect_type')[0].value,
        'expect_city': document.getElementsByName('expect_city')[0].value,
        'entry_time': document.getElementsByName('entry_time')[0].value
      }
    }
  } else if(targetModule == 'education'){
    data = {
      'education': {
        'school_name': document.getElementsByName('school_name')[0].value,
        'major': document.getElementsByName('major')[0].value,
        'qualification': document.getElementsByName('qualification')[0].value,
        'graduate-year': document.getElementsByName('graduate-year')[0].value,
        'study_content': document.getElementsByName('study_content')[0].value
      }
    }
  }else if(targetModule == 'work_history'){
    data = {
      'work_history': {
        'company': document.getElementsByName('company')[0].value,
        'place': document.getElementsByName('place')[0].value,
        'c_stime': document.getElementsByName('c_stime')[0].value,
        'c_etime': document.getElementsByName('c_etime')[0].value,
        'work_contents': document.getElementsByName('work_contents')[0].value
      }
    }
  }else if(targetModule == 'project_history') {
    data = {
      'project_history': {
        'project_name': document.getElementsByName('project_name')[0].value,
        'project_duty': document.getElementsByName('project_duty')[0].value,
        'p_stime': document.getElementsByName('p_stime')[0].value,
        'p_etime': document.getElementsByName('p_etime')[0].value,
        'project_content': document.getElementsByName('project_content')[0].value
      }
    }
  } else if(targetModule == 'evalution') {
    data = {
      'evalution': document.getElementsByName('evalution')[0].value
    }
  }

  console.log(data);
  data = JSON.stringify(data);
  console.log(data);
  // data.append('module', form.getAttribute('id'));
  ajax({
    type: 'post',
    url: 'EditResume/SaveInfo',
    data: data,
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'json',
    success: function(res) {

    } ,
    error: function() {
      console.log('error');
    }
  })
}
HTMLCollection.prototype.addEvents = function(eventName, funcName) {
  for(var i = 0; i < this.length; i++){
    this[i].addEventListener(eventName, funcName);
  }
}
HTMLCollection.prototype.removeEvents = function(eventName, funcName) {
  for(var i = 0; i < this.length; i++){
    this[i].removeEventListener(eventName, funcName);
  }
}
NodeList.prototype.addEvents = function(eventName, funcName) {
  for(var i = 0; i < this.length; i++){
    this[i].addEventListener(eventName, funcName);
  }
}
NodeList.prototype.removeEvents = function(eventName, funcName) {
  for(var i = 0; i < this.length; i++){
    this[i].removeEventListener(eventName, funcName);
  }
}
HTMLElement.prototype.scrollUnique = function() {
  var _this = this;
  var eventType = 'mousewheel';
  if(document.mozHidden !== undefined){
    eventType = 'DOMMouseScroll';
  }
  _this.addEventListener(eventType, function(event) {
    var scrollTop = _this.scrollTop,
        scrollHeight = _this.scrollHeight,
        height = _this.clientHeight;
    var delta = (event.wheelDelta) ? event.wheelDelta : -(event.detail || 0);

    if((delta > 0 &&scrollTop <= delta) || (delta < 0 && scrollHeight - height - scrollTop <= -1 * delta)) {
      _this.scrollTop = delta > 0? 0: scrollHeight;
      event.preventDefault();
    }
  });
}
HTMLElement.prototype.siblings = function(query) {
  var _this = this;
  var a = [];
  var p = _this.parentNode.children;
  if(query.substr(0,1) == '.'){
    for(var i = 0; i < p.length; i++){
      if(p[i] != _this && p[i].classList.contains(query.substring(1))){
        a.push(p[i]);
      }
    }
  } else {
    for(var i = 0; i < p.length; i++){
      if(p[i] != _this){
        a.push(p[i]);
      }
    }
  }
  return a;
}
NodeList.prototype.getByClass = function(className) {
  var _this = this;
  for(var i = 0; i < _this.length; i++){
    if(_this[i].nodeName != '#text' && _this[i].className == className){
      return _this[i];
    }
  }
}
