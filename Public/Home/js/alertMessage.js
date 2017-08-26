//基于AmazeUi
//使用前引入AmazeUi的css和js
//两种样式，调用方法showAlertDiv（"请输入正确的手机号码！","style1"），showAlertDiv（"请输入正确的手机号码！","style2"）
function showAlertDiv(message,alertDivStyle) {
//            方案一
    var alertDiv1 = '<div id="alert-div1" style="border-radius: 5px;  text-align: center;  background-color: rgba(221,51,76,0.8);  border-color: #dd514c;' +
        'width: 500px;  height: 50px;  margin: auto;  position: fixed;  top: 0;  bottom: 0;  right: 0;  left: 0;  z-index:500;"' +
        ' class="am-alert" data-am-alert>\n' +
        '            <button id="alert-div1-close" type="button" class="am-close">&times;</button>\n' +
        '            <p>'+message+'</p>\n' +
        '            </div>';

//            方案二
    // var alertDiv2Button = '<button\n' +
    //     '  type="button"\n' +
    //     'style="height: 0;margin: 0;padding: 0;"'+
    //     '  class="am-btn am-btn-primary"\n' +
    //     '  data-am-modal="{target: \'#doc-modal-1\', closeViaDimmer: 0, width: 400, height: 225}">\n' +
    //     '  Modal\n' +
    //     '</button>';

    //隐藏按钮，不在文档中显示
    var alertDiv2 = '<button\n' +
        'style="height: 0;margin: 0;padding: 0;"'+
        '  type="button"\n' +
        '  id="alert-button"\n' +
        '  class="am-btn am-btn-primary"\n' +
        '  data-am-modal="{target: \'#my-alert\'}">\n' +
        '  Alert\n' +
        '</button>\n' +
        '\n' +
        '<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">\n' +
        '  <div id="alert-div2" class="am-modal-dialog" style="background-color: #d9a4ed;border-radius: 10px">\n'  +
        '    <div class="am-modal-bd" style="border-bottom: 1px solid #A09393">\n' +
        message +
        '    </div>\n' +
        '    <div class="am-modal-footer">\n' +
        '      <span class="am-modal-btn" id="alert-div2-close">确定</span>\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>';
    switch (alertDivStyle){
        case "style1":
            //判断是否重复添加元素
            if (!$("#alert-div1").length > 0){
                //将元素添加到body
                $("body").append(alertDiv1);
                //2s后点击关闭按钮，将元素从body移除（不是隐藏）
                setTimeout(function () {
                    $("#alert-div1-close").click();
                },2000);
                // setTimeout(clearAlertDiv("alert-div1-close"),3000);
                break;
            }
            else{
                break;
            }
        case "style2":
            //判断是否重复添加元素
            if (!$("#alert-div2").length > 0){
                //将元素添加到body
                $("body").append(alertDiv2);
            }
            //触发点击弹窗事件显示弹出层
            $("#alert-button").click();
            //2s后触发点击关闭按钮隐藏弹出层（不是移除）
            setTimeout(function () {
                $("#alert-div2-close").click();
            },2000);
            break;
    }

}
