// 引用在TeacherQuery/index,PlaceQuery/index,CertificateQuery/index,Live/index页面
// ajax的分页查询
$(function () {
    var pageFy = 1;
    var maxPageFy = 1;
    var keyFy;
    var $targetCityName = $("[name=city]");
    var $targetAreaName = $("[name=area]");
    $("[name=province]").change(function () {
        loadData('/Home/Base/city',{code : $("[name=province] option:selected").val()}, cityQuery);
    });
    $targetCityName.change(function () {
        loadData('/Home/Base/area',{code: $("[name=city] option:selected").val()},areaQuery);
    });
});

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
// 动态添加分页组件的方法
function appendFyDom(el) {
    
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

