dashboardApp.controller('DashboardHomeCtrl', ['$scope', 'schoolYearFactory', function ($scope, schoolYearFactory) {
    
}]);

dashboardApp.controller('AccountHomeCtrl', ['$scope', 'accountFactory', function ($scope, accountFactory) {
	
	accountFactory.getUser()
        .success(function (data) {
            $scope.user = data;
        })
        .error(function (error) {});
}]);