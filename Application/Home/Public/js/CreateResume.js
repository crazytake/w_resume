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


  document.getElementsByClassName('btn-confirm').addEvents('click', saveModuleItem);
  document.getElementsByClassName('module-list').addEvents('click', function(){
    var _this = event.target;
    if(_this.classList.contains('btn-del')){
      _this.parentNode.parentNode.removeChild(_this.parentNode);
    }
  });
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
  var fr = new FileReader();
  fr.onloadend = function(e){
    document.getElementById('headPic'). src = e.target.result;
  }
  var img = document.querySelector('#head-pic').files[0];
  fr.readAsDataURL(img);
  var resume_id = document.body.getAttribute('data-id')||null;
  var data = new FormData();
  data.append('img',img);
  data.append('resume_id',resume_id);
  ajax({
    type: 'post',
    url: 'EditResume/upload_img',
    data: data,
    contentType: 'multipart/form-data',
    dataType: 'json',
    success: function(res) {
      var resData = JSON.parse(res);
      if(resData.resume_id){
        document.body.setAttribute('data-id',resData.resume_id);
      }
      var tnode = document.getElementById('tips');
      tnode.innerHTML = resData.content;
      tnode.classList.remove('hide');
      setTimeout(function(){
        tnode.classList.add('hide');
      },1000);
    },
    error: function() {
      console.log("error");
    }
  })
}



var addModuleItem = function() {
  var _this = event.target;
  var editBlock = document.getElementsByClassName(_this.getAttribute('data-target'))[0];
  if(editBlock.classList.contains('hide')){
    // _this.innerHTML = '取消';
    editBlock.classList.remove('hide');
  } else{
    _this.innerHTML = '添加';
    editBlock.classList.add('hide');
  }
}

var saveModuleItem = function(){
  var _this = event.target;
  var editBlock = _this.parentNode;
  // 教育经历
  if(_this.parentNode.classList.contains('education-edit')){
    var school_name = document.getElementsByName('school_name')[0].value,
        major = document.getElementsByName('major')[0].value,
        qualification = document.getElementsByName('qualification')[0].value,
        graduate_year = document.getElementsByName('graduate-year')[0].value,
        study_content = document.getElementsByName('study_content')[0].value;
    var listItem = document.createElement('div');
    listItem.className = 'education-list-item';
    if(school_name&&major){
      var html = '<div class="line clearfix">'+
                  '<span class="school-name" data-value="'+school_name+'">'+school_name+'</span>'+
                  '<span class="qualification-saved" data-value="'+qualification+'">'+qualification+'</span>'+
                  '<span class="major-name" data-value="'+major+'">|'+major+'</span>'+
                  '<span class="graduate-year" data-value="'+graduate_year+'">'+graduate_year+'毕业</span>'+
                  '</div>'+
                  '<span class="study-content" data-value="'+study_content+'">'+study_content+'</span>'+
                  '<button class="btn-del btn" type="button">删除</button>';


      listItem.innerHTML = html;
      document.getElementsByClassName('education-list')[0].appendChild(listItem);
      editBlock.classList.add('hide');
      clearForm('education-edit');
    }else{
      alert('请填写完整信息！');
    }
  }
  // 工作经历
  else if(_this.parentNode.classList.contains('job-edit')){
    var company = document.getElementsByName('company')[0].value,
        place = document.getElementsByName('place')[0].value,
        c_stime = document.getElementsByName('c_stime')[0].value,
        c_etime = document.getElementsByName('c_etime')[0].value,
        work_contents = document.getElementsByName('work_contents')[0].value;
    var listItem = document.createElement('div');
    listItem.className = 'job-list-item';
    if(company&&place&&c_stime&&c_etime){
      var html = '<div class="line clearfix">'+
                  '<span class="company-name" data-value="'+company+'">'+company+'</span>'+
                  '<span class="place-name" data-value="'+place+'">'+place+'</span>'+
                  '<span class="c-last-time" data-value="'+c_stime+'~'+c_etime+'">'+c_stime+'~'+c_etime+'</span>'+
                  '</div>'+
                  '<span class="work-contents" data-value="'+work_contents+'">'+work_contents+'</span>'+
                  '<button class="btn-del btn" type="button">删除</button>';

      listItem.innerHTML = html;
      document.getElementsByClassName('job-list')[0].appendChild(listItem);
      editBlock.classList.add('hide');
      clearForm('job-edit');
    }else{
      alert('请填写完整信息！');
    }
  }
  // 项目经历
  else if(_this.parentNode.classList.contains('project-edit')){
    var project = document.getElementsByName('project_name')[0].value,
        duty = document.getElementsByName('project_duty')[0].value,
        p_stime = document.getElementsByName('p_stime')[0].value,
        p_etime = document.getElementsByName('p_etime')[0].value,
        project_contents = document.getElementsByName('project_contents')[0].value;
    var listItem = document.createElement('div');
    listItem.className = 'project-list-item';
    if(project&&duty&&p_stime&&p_etime){
      var html = '<div class="line clearfix">'+
                  '<span class="project-name" data-value="'+project+'">'+project+'</span>'+
                  '<span class="duty-name" data-value="'+duty+'">'+duty+'</span>'+
                  '<span class="p-last-time" data-value="'+p_stime+'~'+p_etime+'">'+p_stime+'~'+p_etime+'</span>'+
                  '</div>'+
                  '<span class="project-contents" data-value="'+project_contents+'">'+project_contents+'</span>'+
                  '<button class="btn-del btn" type="button">删除</button>';

      listItem.innerHTML = html;
      document.getElementsByClassName('project-list')[0].appendChild(listItem);
      editBlock.classList.add('hide');
      clearForm('project-edit');
    }else{
      alert('请填写完整信息！');
    }
  }
}
var getData = function(formClass){
  var target = document.getElementsByClassName(formClass)[0].children;
  if(target == undefined){
    return;
  }
  var data = [];
  for(var i = 0; i < target.length; i++){
    if(formClass == 'education-list'){
      data[i] = {
        'school_name':document.getElementsByClassName('school-name')[i].getAttribute('data-value'),
        'qualification':document.getElementsByClassName('qualification-saved')[i].getAttribute('data-value'),
        'major':document.getElementsByClassName('major-name')[i].getAttribute('data-value'),
        'graduate_year':document.getElementsByClassName('graduate-year')[i].getAttribute('data-value'),
        'study_content':document.getElementsByClassName('study-content')[i].getAttribute('data-value')
      }
    }else if(formClass == 'job-list'){
      data[i] = {
        'company':document.getElementsByClassName('company-name')[i].getAttribute('data-value'),
        'place':document.getElementsByClassName('place-name')[i].getAttribute('data-value'),
        'last_time':document.getElementsByClassName('c-last-time')[i].getAttribute('data-value'),
        'work_contents':document.getElementsByClassName('work-contents')[i].getAttribute('data-value')
      }
    }else if(formClass == 'project-list'){
      data[i] = {
        'project_name': document.getElementsByClassName('project-name')[i].getAttribute('data-value'),
        'project_duty': document.getElementsByClassName('duty-name')[i].getAttribute('data-value'),
        'last_time':document.getElementsByClassName('p-last-time')[i].getAttribute('data-value'),
        'project_contents':document.getElementsByClassName('project-contents')[i].getAttribute('data-value')
      }
    }
  }
  return data;
}
var clearForm = function(id){
  var target = document.getElementById(id);
  if(target == undefined){
    return;
  }
  for(var i = 0; i<target.elements.length; i++){
    if (target.elements[i].type == "text") {
         target.elements[i].value = "";
     }
     else if (target.elements[i].type == "password") {
         target.elements[i].value = "";
     }
     else if (target.elements[i].type == "radio") {
         target.elements[i].checked = false;
     }
     else if (target.elements[i].type == "checkbox") {
         target.elements[i].checked = false;
     }
     else if (target.elements[i].type == "select-one") {
         target.elements[i].options[0].selected = true;
     }
     else if (target.elements[i].type == "select-multiple") {
         for (var j = 0; j < target.elements[i].options.length; j++) {
             target.elements[i].options[j].selected = false;
         }
     }
     else if (target.elements[i].type == "textarea") {
         target.elements[i].value = "";
     }
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
  if(document.body.getAttribute('data-id')){
    var resume_id = document.body.getAttribute('data-id');
  }else{
    var resume_id = null;
  }
  if(targetModule == 'base_info'){
    data = {
      resume_id:resume_id,
      base_info:{
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
      resume_id:resume_id,
      'intension':{
        'expect_job': document.getElementsByName('expect_job')[0].value,
        'expect_type': document.getElementsByName('expect_type')[0].value,
        'expect_city': document.getElementsByName('expect_city')[0].value,
        'entry_time': document.getElementsByName('entry_time')[0].value
      }
    }
  } else if(targetModule == 'education'){
    var t = 'education-list';
    data = {
      resume_id:resume_id,
      'education': getData(t)
    }
  }else if(targetModule == 'work_history'){
    var t = 'job-list';
    data = {
      resume_id:resume_id,
      'work_history': getData(t)
    }
  }else if(targetModule == 'project_history') {
    var t = 'project-list';
    data = {
      resume_id:resume_id,
      'project_history':getData(t)
    }
  } else if(targetModule == 'evalution') {
    data = {
      resume_id:resume_id,
      'evalution': document.getElementsByName('evalution')[0].value
    }
  }

  data = JSON.stringify(data);
  // data.append('module', form.getAttribute('id'));
  ajax({
    type: 'post',
    url: 'EditResume/save_info',
    data: data,
    contentType: 'application/json;charset=utf-8',
    dataType: 'json',
    success: function(res) {
      var resData = JSON.parse(res);
      if(resData.resume_id){
        document.body.setAttribute('data-id',resData.resume_id);
      }
      var tnode = document.getElementById('tips');
      tnode.innerHTML = resData.content;
      tnode.classList.remove('hide');
      setTimeout(function(){
        tnode.classList.add('hide');
      },1000)
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
