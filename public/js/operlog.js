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





}]);


