function upload(obj,callback) {              //obj:调用函数的对象，实参一般传this,callback:上传成功后的回调函数
    var formdata=new FormData();
    console.log(obj.files.length)
    for(var i=0;i<obj.files.length;i++){
        formdata.append('img[]',obj.files[i]);
    }
    $.ajax({
        url: '/index/upload',
        type: 'POST',
        cache: false,
        data: formdata,
        dataType:'json',
        processData: false,
        contentType: false
    }).done(function(res) {
        console.log(res)
        if(res.code==1){
            if(callback&& (typeof(callback)=='function')){
                callback(res.info);
            }
        }else{
            alert(res.msg);
        }

    }).fail(function(res) {
         alert('上传出错');
    });
}

