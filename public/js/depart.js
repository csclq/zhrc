myapp.controller('userinfo',['$scope','$http','retrieve',function ($scope,$http,retrieve) {
    $scope.info={};                                                         //筛选条件
    $scope.list=[];                                                         //数据源
    $scope.info.p=1;                                                        //分页
    $scope.total=1;                                                         //总页数




  retrieve.list($scope);
    $scope.paging=function () {                                             //分页
        if($scope.info.p<1){
            $scope.info.p=1;
        }
        if($scope.info.p>$scope.total){
            $scope.info.p=$scope.total;
        }
        retrieve.list($scope);
    }
    $scope.search=function () {                                         //筛选
        $scope.info.p=1;
        retrieve.list($scope);
    };
    $scope.add=function () {                                            //添加
        $(".add select option").prop('selected',false);
        $(".add input[name=id]").val(0);
        $(".add form")[0].reset();
        $(".add").show();
    }

    $scope.change=function (item) {                                     //
       $(".add input[name=id]").val(item['id']);
       $(".add input[name=name]").val(item['name']);
        console.log(item['depart']);
        $(".add select option").each(function () {
            $(this).prop('selected',false);
           if($(this).val()==item['depart']){
               $(this).prop('selected',true);
           }
        });
        $(".add").show();
    }
    $scope.delete=function (id) {
        if (confirm("删除后无法恢复，确定要删除？？？？")) {
            $http({
                'url': '/system/deleteDepart',
                'method': 'POST',
                'data': {id: id}
            }).success(function (a) {
                location.reload();
            })
        }
    }
}]);

myapp.controller('addController',function ($scope,$http) {
    $scope.add={};
    $scope.addsub=function () {
        $http({
            'url':'/system/adddepart',
            'method':'POST',
            'data':$scope.add
        }).success(function (a) {
           if(!a){
               alert("添加失败");
           }
           location.reload();
        })
    }
})



function deleted() {
    if($(".table tbody input:checkbox").is(":checked"))
        $("#delback").submit();
}
