// 引用在TeacherQuery/index,PlaceQuery/index,CertificateQuery/index,Live/index页面
// ajax的分页查询
var pageFy = 2;
var maxPageFy = 1;
var keyFy;
var listNum = 2;
// el:目标元素；option：ajax参数
function loadData(url, data, fun){
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        success:function (data) {
            fun(data);
        }
    })
}

// 异步加载数据，用在查询数据的总条数
function loadDataFalse(url, data, fun){
    $.ajax({
        type: 'GET',
        url: url,
        data: data,
        dataType: 'json',
        async:false,
        success:function (data) {
            fun(data);
        }
    })
}
function insertPlace(data) {
    var $targetName = $("#place-insert");
    appendList($targetName,data,'pid','pname','picture');
}

function appendList(targetName,data,id1,name1,img1) {
    // 清空目标DOM元素，然后在填充
    targetName.html("");
    for (var i = 0; i < data.length; i++){
        var link = "#";
        var id = data[i][id1];
        var name = data[i][name1];
        var img = data[i][img1];
        var insertDom = '<li>'+
                            '<a href="' + link + '">' +
                                '<img src="'+ img + '" alt="">' +
                            '</a>' +
                            '<p>' + name + '</p>' +
                        '</li>';
        targetName.append(insertDom);
    }
}

function amount(data) {
    maxPageFy = Math.ceil(data/listNum);
}
// 动态添加分页组件的方法
function appendFyDom(el) {
    el.html("");
    var first = '<li class="am-pagination-first ">'+
                    '<a href="#" class="">第一页</a>'+
                '</li>';
    var prev = '<li class="am-pagination-prev ">'+
                    '<a href="#" class="">上一页</a>'+
                '</li>';
    var next = '<li class="am-pagination-next ">'+
                    '<a href="#" class="">下一页</a>'+
                '</li>';
    var last = '<li class="am-pagination-last ">'+
                    '<a href="#" class="">最末页</a>'+
                '</li>';
    var sumPage = '<span>共'+maxPageFy+'页</span>';
    el.append(first);
    el.append(prev);
    for (var i = 1; i <= maxPageFy; i++){
        var list = '<li class="">'+
                        '<a href="#" class="">'+i+'</a>'+
                   '</li>';
        el.append(list);
    }
    el.append(next);
    el.append(last);
    el.append(sumPage);
    
}

// 下一页
function nextPage() {
    
}

// 上一页
function prevPage() {
    
}

// 跳转到指定页
function targetPage(tarPage) {

}

// 首页
function firstPage() {

}

// 末页
function lastPage() {

}

//填充省市区dom元素
function appendChild(targetName,data,code,name) {
    for (var i = 0; i < data.length; i++){
        var code1 = data[i][code];
        var name1 = data[i][name];
        var insetOptions = '<option value='+code1+'>'+name1+'</option>';
        targetName.append(insetOptions);
    }
}

// 查询市
function cityQuery(data) {
    var $targetName = $("[name=city]");
    $targetName.html("<option value='市'>选择市</option>");
    appendChild($targetName, data, 'code', 'name');
}

// 查询区
function areaQuery(data) {
    var $targetName = $("[name=area]");
    $targetName.html("<option value='区'>选择区</option>");
    appendChild($targetName, data, 'code', 'name');
}

// 查询考官
function teacherQuery(data) {
    var $targetName = $("[name=tid]");
    $targetName.html("<option value='考官'>选择考官</option>");
    appendChild($targetName,data,'tid','tname');
}