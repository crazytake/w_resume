var ajax = function(){
  var ajaxData = {
    type: arguments[0].type || "GET",
    url:  arguments[0].url  || "",
    async:arguments[0].async|| "true",
    data: arguments[0].data || null,
    dataType: arguments[0].dataType || "text",
    // contentType: arguments[0].contentType || "application/x-www-form-urlencoded",
    before: arguments[0].before || function(){},
    success: arguments[0].success || function(){},
    error: arguments[0].error || function(){}
  }
  ajaxData.before()

  var xhr = createxmlHttpRequest();
  xhr.reponseType = ajaxData.dataType;
  xhr.open(ajaxData.type, ajaxData.url, ajaxData.async);
  // xhr.setRequestHeader("Content-Type",ajaxData.contentType);
  xhr.send(ajaxData.data);
  xhr.onReadystatechange = function() {
    if(xhr.readyState == 4) {
      if(xhr.status == 200) {
        ajaxData.success(xhr.responseText)
      } else {
        ajaxData.error();
      }
    }
  }

}

function createxmlHttpRequest() {
  if (window.ActiveXObject) {
    return new ActiveXObject("Microsoft.XMLHTTP");
  } else if (window.XMLHttpRequest) {
    return new XMLHttpRequest();
  }
}

function convertData(data) {
  if(typeof(data) === "object"){
    var convertResult = "";
    for(var c in data) {
      convertResult += c + "=" + data[c] + "&";
    }
    convertResult = convertResult.substring(0, convertResult.length-1)
    return convertResult;
  } else {
    return data;
  }
}
