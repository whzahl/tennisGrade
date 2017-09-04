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
$(document).ready(function () {
    var t;
    //简介弹出层
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
    //jquery的$.get()方法
    //异步加载市
    $("[name=province]").change(function () {
        $.get("/Home/Base/city",{
            //获取被选中option的value
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
    //异步加载区
    //jquery的$.get()方法
    // $("[name=city]").change(function () {
    //     $.get("/Home/Base/area",{
    //         //获取被选中option的value
    //         code : $("[name=city] option:selected").val()
    //     },function (data) {
    //         $("[name=area]").html("<option value='区'>选择区</option>");
    //         for (var i = 0; i < data.length; i++){
    //             var code = data[i].code;
    //             var name = data[i].name;
    //             var insetOptions = '<option value='+code+'>'+name+'</option>';
    //             $("[name=area]").append(insetOptions);
    //         }
    //     },"json");
    // });

    //jquery的$.ajax()方法
    //异步加载区
    $('[name=city]').change(function () {
        $.ajax({
            type:"GET",
            url:"/Home/Base/area",
            data:{
                //获取被选中option的value
                code:$("[name=city] option:selected").val()
            },
            //请求超时时间10s
            timeout:10000,
            dataType:"json",
            //请求发送前可修改XMLHttpRequest对象的函数，在beforeSend中如果返回false可以取消本次Ajax请求
            //XMLHttpRequest对象是唯一参数
            beforeSend:function (XMLHttpRequest) {
                console.log("这是请求发送前执行的函数");
            },
            // 请求完成后调用的回调函数（无论成功与否都调用），
            // 参数是XMLHttpRequest对象和一个用来描述成功请求类型的字符串
            complete:function (XMLHttpRequest,textStatus) {
                console.log("这是请求完成后执行的回调函数");
            },
            //请求成功后调用的回调函数
            //两个参数:data,由服务器返回并根据datatype参数进行处理之后的数据；textStatus,描述状态的字符串
            success:function (data,textStatus) {
                $("[name=area]").html("<option value='区'>选择区</option>");
                for (var i = 0; i < data.length; i++){
                    var code = data[i].code;
                    var name = data[i].name;
                    var insetOptions = '<option value='+code+'>'+name+'</option>';
                    $("[name=area]").append(insetOptions);
                }
            },
            //请求失败时调用的函数
            //三个参数XMLHttpRequest对象、错误信息、捕获的错误对象（可选）
            error:function (XMLHttpRequest,textStatus,errorThrown) {
                console.log("这是请求失败后执行的函数")
            },
            //默认为true表示是否出发全局Ajax事件
            global:true
        })
    });
    //异步加载考点
    $("[name=area]").change(
        // function () {
        //     $.get("/Home/Base/place",{
        //         code : $("[name=area] option:selected").val()
        //     },function (data) {
        //         $("[name=pid]").html("<option value='考点'>选择考点</option>");
        //         for (var i = 0; i < data.length; i++){
        //             var pid = data[i].pid;
        //             var pname = data[i].pname;
        //             var insetOptions = '<option value='+pid+'>'+pname+'</option>';
        //             $("[name=pid]").append(insetOptions);
        //         }
        //     },"json")
        // }

        // Ajax的原生JS调用方法，jquery的ajaxStart()和ajaxStop()方法对其不起作用，要另行设置
        function () {
            var xmlhttp;
            if(window.XMLHttpRequest){
                //for others
                xmlhttp = new XMLHttpRequest();
            }
            else {
                //for IE5、6
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var code = $("[name=area] option:selected").val();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 1){
                    $("#loading").show();
                }
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200 ){
                    $("#loading").hide();
                    var data = JSON.parse(xmlhttp.responseText);
                    $("[name=pid]").html("<option value='考点'>选择考点</option>");
                    for (var i = 0; i < data.length; i++){
                        var pid = data[i].pid;
                        var pname = data[i].pname;
                        var insetOptions = '<option value='+pid+'>'+pname+'</option>';
                        $("[name=pid]").append(insetOptions);
                    }
                }
            }
            //open方式初始化XMLHttpRequest对象，指定相关参数
            xmlhttp.open("GET","/Home/Base/place?code="+code,true);
            //send方法发送请求
            xmlhttp.send();
        }
    );
    //异步加载考官
    $("[name=pid]").change(
        function () {
            // console.log($("[name=pid] option:selected").val());
            $.get("/Home/Base/teacher",{
                pid : $("[name=pid] option:selected").val()
            },function (data) {
                // console.log($("[name=pid] option:selected").val());
                $("[name=id]").html("<option value='陪考'>选择陪考</option>");
                for (var i = 0; i < data.length; i++){
                    var tid = data[i].tid;
                    var tname = data[i].tname;
                    var insetOptions = '<option value='+tid+'>'+tname+'</option>';
                    $("[name=tid]").append(insetOptions);
                }
            },"json")
        }
    );
    //jquery1.5版本之后不触发$ajaxStart和Stop的全局方法，用$(document).AjaxStart（）可解决问题
    //Ajax调用开始时显示GIF图，结束时隐藏
    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    })
})