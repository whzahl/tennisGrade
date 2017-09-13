// 引用在TeacherQuery/index,PlaceQuery/index,CertificateQuery/index,Live/index页面
// ajax的分页查询
var pageFy = 1;                                     //第几页
var maxPageFy = 1;                                  //最大页
var keyFy;                                          //分页查询关键字
var keyName;                                        //关键字对应的字段名
var dbName;                                         //查询数据库名相应的Service名
var listNum = 2;                                    //每页显示的数据量
var maxListNum = 2;                                 //每页maxListNum个按钮（上一页、下一页、首页、末页不包含在内）
var btGroup;                                        //按钮组数
var currentBtGroup = 1;                             //当前按钮组，默认为第一组

// $(document).ready(function () {
//     $(".am-pagination-next a").click(nextPage());
// });
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
    if (maxPageFy !== 0){
        appendList($targetName,data,'pid','pname','picture');
    }
    else{
        $targetName.text("暂无数据...");
    }
}

function insertTeacher(data) {

}

function insertLive(data) {

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
    btGroup = Math.ceil(maxPageFy/maxListNum);
}

function initPage() {
    pageFy = 1;
    currentBtGroup = 1;
}
// 动态添加分页组件的方法
function appendFyDom(el) {
    el.html("");
    if (maxPageFy !== 0){
        var first = '<li class="am-pagination-first my-fy-list">'+
            '<a href="javascript:firstPage();" class="">第一页</a>'+
            '</li>';
        var prev = '<li class="am-pagination-prev my-fy-list">'+
            '<a href="javascript:prevPage();" class="">上一页</a>'+
            '</li>';
        var next = '<li class="am-pagination-next my-fy-list">'+
            '<a href="javascript:nextPage();" class="">下一页</a>'+
            '</li>';
        var last = '<li class="am-pagination-last my-fy-list">'+
            '<a href="javascript:lastPage();" class="">最末页</a>'+
            '</li>';
        var sumPage = '<span class="sum-fy">共'+maxPageFy+'页</span>';
        el.append(first);
        el.append(prev);
        for (var i = 1; i <= maxPageFy; i++){
            var list = '<li class="am-pagination-bts my-fy-list">'+
                '<a href="javascript:targetPage('+i+');" class="">'+i+'</a>'+
                '</li>';
            el.append(list);
        }
        el.append(next);
        el.append(last);
        el.append(sumPage);
        // 分页组件中所有的li元素
        var $list = $(".my-fy-list");
        // 分页组件中所有数字按钮元素
        var $bts = $(".am-pagination-bts");

        // 将当前页设置为active状态
        $($list.get(pageFy+1)).addClass("am-active");

        // 首页index=0,上一页index=1
        // 其他index=pageFy+1
        // 末页index=pageFy+3,下一页index=pageFy+2

        // 当前按钮组的第一个按钮数字=maxListNum*(currentBtGroup-1)+1,在$bts中的index=(maxListNum*(currentBtGroup-1)+1)-1
        var btsFirstIndex = (maxListNum*(currentBtGroup-1)+1)-1;
        // 当前按钮组的最后一个按钮数字=maxListNum*currentBtGroup，在$bts中的index=(maxListNum*currentBtGroup)-1
        var btsLastIndex = (maxListNum*currentBtGroup)-1;
        // 隐藏除了当前currentBtGroup的其他按钮
        $($bts.get(btsFirstIndex)).prevAll().css("display","none");
        $($bts.get(btsLastIndex)).nextAll().css("display","none");

        if (pageFy === maxPageFy){
            $($list.get(maxPageFy+2)).css("display","none");
            $($list.get(maxPageFy+3)).css("display","none");
        }

        // 第一页时隐藏首页、上一页
        if (pageFy !== 1){
            $($list.get(0)).css("display","inline-block");
            $($list.get(1)).css("display","inline-block");
        }
        //最后一页时隐藏最末页、下一页
        if (pageFy !== maxPageFy){
            $($list.get(maxPageFy+2)).css("display","inline-block");
            $($list.get(maxPageFy+3)).css("display","inline-block");
        }

        // 显示总页数span
        $(".sum-fy").css('display','inline-block');
    }

}

// 下一页
function nextPage() {
    if(pageFy < maxPageFy && pageFy >= 0){
        if (pageFy === maxListNum*currentBtGroup){
            currentBtGroup++;
        }
        pageFy++;
        loadData('/Home/AjaxFyQuery/ajaxFy',{
            page:pageFy,//第几页
            name:keyName,//查询字段名
            code:keyFy,//查询字段值
            db:dbName,//查询数据表
            num:listNum//每页几条数据
        },insertPlace);
        appendFyDom($(".am-pagination"));
    }
}

// 上一页
function prevPage() {
    if(pageFy <= maxPageFy && pageFy >= 0){
        if (pageFy === maxListNum*(currentBtGroup-1)+1){
            currentBtGroup--;
        }
        pageFy--;
        loadData('/Home/AjaxFyQuery/ajaxFy',{
            page:pageFy,//第几页
            name:keyName,//查询字段名
            code:keyFy,//查询字段值
            db:dbName,//查询数据表
            num:listNum//每页几条数据
        },insertPlace);
        appendFyDom($(".am-pagination"));
    }
}

// 跳转到指定页
function targetPage(target) {

    pageFy = target;

    loadData('/Home/AjaxFyQuery/ajaxFy',{
        page:pageFy,//第几页
        name:keyName,//查询字段名
        code:keyFy,//查询字段值
        db:dbName,//查询数据表
        num:listNum//每页几条数据
    },insertPlace);
    appendFyDom($(".am-pagination"));
}

// 首页
function firstPage() {
    pageFy = 1;
    currentBtGroup = 1;
    loadData('/Home/AjaxFyQuery/ajaxFy',{
        page:pageFy,//第几页
        name:keyName,//查询字段名
        code:keyFy,//查询字段值
        db:dbName,//查询数据表
        num:listNum//每页几条数据
    },insertPlace);
    appendFyDom($(".am-pagination"));
}

// 末页
function lastPage() {
    pageFy = maxPageFy;
    currentBtGroup = btGroup;
    loadData('/Home/AjaxFyQuery/ajaxFy',{
        page:pageFy,//第几页
        name:keyName,//查询字段名
        code:keyFy,//查询字段值
        db:dbName,//查询数据表
        num:listNum//每页几条数据
    },insertPlace);
    appendFyDom($(".am-pagination"));
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