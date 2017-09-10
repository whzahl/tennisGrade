// 引用在TeacherQuery/index,PlaceQuery/index,CertificateQuery/index,Live/index页面
// ajax的分页查询

var pageFy = 1;
var maxPageFy = 1;
var keyFy;

// el:目标元素；option：ajax参数
function loadData(el, options){
    this.options = {
        url:'/Home/AjaxFyQuery/',
        type:'GET',
        data:'',
        successFun:'',
        dataType:'json'
    };

    for (var i in options){
        this.options[i] = options[i];
    }

    $.ajax({
        type:this.options.type,
        url:this.options.url,
        data:this.options.data,
        dataType:this.options.dataType,
        success:this.options.successFun()
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
var $targetCityName = $("[name=city]");
var $targetAreaName = $("[name=area]");

// 查询市
function cityQuery() {
    loadData($targetCityName,{
        url:'/Home/Base/area',
        type:'GET',
        data:{
            //获取被选中option的value
            code:$("[name=province] option:selected").val()
        }
    })
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

