//引用在Student/index,Teacher/index,Place/index页面

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
    var pattern = /^1[0-9]{10}$/;//1开头，后十位为0-9的11位数字
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
// function isAgeConformsWithLevel(inputValue,ageValue,message) {
//     if(ageValue <= 8 && inputValue !== "TG-R1"){
//         showAlertDiv(message,"style1");
//         return false;
//     }
//     //注意是字母O不是数字0
//     if (ageValue >=9 && ageValue <= 10 && inputValue !== "TG-O1"){
//         showAlertDiv(message,"style1");
//         return false;
//     }
//     if (ageValue >=9 && ageValue <= 10 && inputValue !== "TG1"){
//         showAlertDiv(message,"style1");
//         return false;
//     }
//     if (ageValue>11 && inputValue !== "TG-Y1"){
//         showAlertDiv(message,"style1");
//         return false;
//     }
//     return true;
// }