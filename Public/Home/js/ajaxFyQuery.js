// 引用在TeacherQuery/index,PlaceQuery/index,CertificateQuery/index,Live/index页面
// ajax的分页查询

var pageFy = 1;
var maxPageFy = 1;
var keyFy;

// el:目标元素；option：ajax参数
function loadData(el, options){
    this.options = {
        url:'',
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

