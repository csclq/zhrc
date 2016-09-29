var myapp = angular.module('myapp', []);
myapp.config(['$interpolateProvider', function ($interpolateProvider) {
    $interpolateProvider.startSymbol('{_');
    $interpolateProvider.endSymbol('_}');
}]);
myapp.service('retrieve', function ($http) {
    return {
        'list': function (data) {
            $http({
                'url': '',
                'method': 'POST',
                'data': data.info
            }).success(function (a) {
                data.list = a['info'];
                data.total = a['total'];
            })
        }
    };
})
