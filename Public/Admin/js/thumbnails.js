window.onload = getProvince;

function createRequest() {//Ajax于PHP交互需要对象
  try {
    request = new XMLHttpRequest();//创建一个新的请求对象;
  } catch (tryMS) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (otherMS) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = null;
      }
    }
  }
  return request;
}

function sech(id) {//省市改变时触发，select的onchange事件

    var aa = document.getElementById(id);
if(id=="sheng"){
      getCity(aa.value);//这里aa.value为省的id
}
if(id=="shi")
{
getCounty(aa.value);//这里aa.value为市的id
}

}

function getProvince() {//获取所有省
  request = createRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  var url= "getDetails.php?ID=0";//ID=0时传递至PHP时让其获取所有省
  request.open("GET", url, true);
  request.onreadystatechange = displayProvince; //设置回调函数
  request.send(null);    //发送请求
}

function getCity(id){//获取省对应的市
  request = createRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  var url= "getDetails.php?ID=" + escape(id);
  request.open("GET", url, true);
  request.onreadystatechange = displayCity;
  request.send(null);
}

function getCounty(id){//获取市对应的区
  request = createRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  var url= "getDetails.php?ID=" + escape(id);
  request.open("GET", url, true);
  request.onreadystatechange = displayCounty;
  request.send(null);
}

 
function displayProvince() {//将获取的数据动态增加至select
  if (request.readyState == 4) {
    if (request.status == 200) {
  var a=new Array;
var b=request.responseText;//将PHP返回的数据赋值给b
 a=b.split(",");//通过","将这一数据保存在数组a中
  document.getElementById("sheng").length=1;
  var obj=document.getElementById("sheng');  
  for(i=0;i
      obj.options.add(new Option(a[i],i+1)); //动态生成OPTION加到select中，第一个参数为Text,第二个参数为Value值.

    }
  }
}

 
function displayCity() {//将获取的数据动态增加至select
  if (request.readyState == 4) {
    if (request.status == 200) {
  var a=new Array;
var b=request.responseText;
 a=b.split(",");
  document.getElementById("shi").length=1;//重新选择
  document.getElementById("xian").length=1;//重新选择
if(document.getElementById("sheng").value!="province"){
  var obj=document.getElementById('shi');  
  for(i=0;i
      obj.options.add(new Option(a[i], document.getElementById("sheng").value*100+i+1)); //ocument.getElementById("sheng").value*100+i+1对应的是市的ID。
}

    }
  }
}

function displayCounty() {//将获取的数据增加至select
  if (request.readyState == 4) {
    if (request.status == 200) {
  var a=new Array;
var b=request.responseText;
 a=b.split(",");
 document.getElementById("xian").length=1;
if(document.getElementById("sheng").value!="province"&&document.getElementById("shi").value!="city"){
  var obj=document.getElementById('xian');  
  for(i=0;i
      obj.options.add(new Option(a[i],i+1001)); 
}

    }
  }
}