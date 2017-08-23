//表单验证函数
function notEmpty(inputValue,message){
    if (inputValue !== ""){
        return true;
    }
    else {
        showAlertDiv(message,"style1");
        return false;
    }
}
function notUndefined(inputVal,message) {
    if(typeof(inputVal) !== "undefined"){
        return true
    }
    else {
        showAlertDiv(message,"style1");
        return false;
    }
}
function isAge(inputValue,message) {
    var pattern = /^[1-9][0-9]{0,2}$/;//1-9开头，后面为0-9的一个1-3位的数字
    if (pattern.test(inputValue)) {
        return true;
    }
    else {
        showAlertDiv(message,"style1");
        return false;
    }

}
function isPhone(inputValue,message){
    var pattern = /^1[0-9]{10}$}/;//1开头，后十位为0-9的11位数字
    if(pattern.test(inputValue)){
        return true;
    }
    else {
        showAlertDiv(message,"style1");
        return false;
    }
}
// 验证码是否正确
function isEqual(inputValue,checkCode,message){
    if (inputValue === checkCode){
        return true;
    }
    else {
        showAlertDiv(message,"style1");
        return false;
    }
}
// 字符串长度是否合适
function isStringLengthRight(inputValue,maxLength,minLength,message){
    if (inputValue.length >= minLength && inputValue.length <= maxLength){
        return true;
    }
    else {
        showAlertDiv(message,"style1");
        return false
    }
}
function isEmail(inputValue,message){
    var pattern = /^([\w\_\-]+)@([\w\-]+[\.]?)*[\w]+\.[a-zA-Z]{2,10}$/;
    if(pattern.test(inputValue)){
        return true;
    }
    else {
        showAlertDiv(message,"style1");
        return false;
    }
}
$(document).ready(function () {
    //简介弹出层
    var t;
    $("#intro-a").mouseover(function () {
        clearTimeout(t);
        $(".intro").slideDown(100);
    });
    $("#intro-a,.intro").mouseleave(function () {
       t = setTimeout(function () {
            $(".intro").slideUp(100);
        },500);
    });
    $(".intro").mouseover(function () {
        clearTimeout(t);
        $(".intro").slideDown(100);
    });
    //退出弹出层
    $("#personal-center,.login-out").mouseover(function () {
        clearTimeout(t);
        $(".login-out").slideDown(100);
    });
    $("#personal-center,.login-out").mouseleave(function () {
        t = setTimeout(function () {
            $(".login-out").slideUp(100);
        },500);
    });
    //异步加载市、区
    $("[name=province]").change(function () {
        $.get("/Home/Base/city",{
            code : $("[name=province] option:selected").val()
        }, function (data) {
            $("[name=city]").html("<option value='市'>选择市</option>");
            for (var i = 0; i < data.length; i++){
                var code = data[i].code;
                var name = data[i].name;
                var insetOptions = '<option value='+code+'>'+name+'</option>';
                $("[name=city]").append(insetOptions);
            }
        },"json")
    });
    $("[name=city]").change(function () {
        $.get("/Home/Base/area",{
            code : $("[name=city] option:selected").val()
        },function (data) {
            $("[name=area]").html("<option value='区'>选择区</option>");
            for (var i = 0; i < data.length; i++){
                var code = data[i].code;
                var name = data[i].name;
                var insetOptions = '<option value='+code+'>'+name+'</option>';
                $("[name=area]").append(insetOptions);
            }
        },"json");
    });
    //jquery1.5版本之后不触发$ajaxStart和Stop的全局方法，用$(document).AjaxStart（）可解决问题
    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    })
})