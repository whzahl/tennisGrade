// 引用在Teacher/index,Place/index,Student/index页面

$(document).ready(function () {
    function appendChild(targetName,data,code,name) {
        for (var i = 0; i < data.length; i++){
            var code1 = data[i][code];
            var name1 = data[i][name];
            var insetOptions = '<option value='+code1+'>'+name1+'</option>';
            targetName.append(insetOptions);
        }
    }

    //jquery的$.get()方法
    //异步加载市
    $("[name=province]").change(function () {
        $.get("/Home/Base/city",{
            //获取被选中option的value
            code : $("[name=province] option:selected").val()
        }, function (data) {
            var $targetName = $("[name=city]");
            $targetName.html("<option value='市'>选择市</option>");
            appendChild($targetName,data,'code','name');
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
                var $targetName = $("[name=area]");
                $targetName.html("<option value='区'>选择区</option>");
                appendChild($targetName,data,'code','name');
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
                    var $targetName = $("[name=pid]");
                    var data = JSON.parse(xmlhttp.responseText);
                    $targetName.html("<option value='考点'>选择考点</option>");
                    appendChild($targetName,data,'pid','pname');
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
            $.get("/Home/Base/teacher",{
                pid : $("[name=pid] option:selected").val()
            },function (data) {
                var $targetName = $("[name=tid]");
                $targetName.html("<option value='陪考'>选择陪考</option>");
                appendChild($targetName,data,'tid','tname');
            },"json")
        }
    );
    //异步加载陪考
    // $("[name=pid]").change(
    //     function () {
    //         $.get("/Home/Base/teacher",{
    //             code : $("[name=pid] option:selected").val()
    //         },function (data) {
    //             $("[name=tid]").html("<option value='陪考'>选择陪考</option>")
    //             for (var i = 0; i < data.length; i++){
    //                 var tid = data[i].tid;
    //                 var tname = data[i].tname;
    //                 var insetOptions = '<option value='+tid+'>'+tname+'</option>';
    //                 $("[name=tid]").append(insetOptions);
    //             }
    //         },"json")
    //     }
    // );
});