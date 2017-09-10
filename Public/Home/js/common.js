// 引用在所有前端页面


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

    //jquery1.5版本之后不触发$ajaxStart和Stop的全局方法，用$(document).AjaxStart（）可解决问题
    //Ajax调用开始时显示GIF图，结束时隐藏
    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    })
})