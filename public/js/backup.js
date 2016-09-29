myapp.controller('backup',['$scope','$http','retrieve', function ($scope,$http,retrieve) {
    $scope.list=[];                                                         //数据源
    $scope.info={};
    $scope.info.p=1;                                                             //页码
    retrieve.list($scope);
    $scope.paging=function () {
        if($scope.info.p<1){
            $scope.info.p=1;
        }
        if($scope.info.p>$scope.total){
            $scope.info.p=$scope.total;
        }
        retrieve.list($scope);
    }
    $scope.backup=function () {
        $http({
            'url': '',
            'method': 'POST',
            'data': { 'back':1}
        }).success(function (a) {
            $scope.list = a['info'];
            $scope.info.p=a['total'];
            $scope.total = a['total'];
        })
    }

}]);

function deletebak() {
    if($(".table tbody input:checkbox").is(":checked"))
    $("#delback").submit();
}