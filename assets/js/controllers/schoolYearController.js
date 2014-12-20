dashboardApp.controller('SchoolYearHomeCtrl', ['$scope', 'schoolYearFactory', function ($scope, schoolYearFactory) {
    schoolYearFactory.getAllSchoolYears()
        .success(function (data) {
            $scope.schoolYears = data;
        })
        .error(function (error) {});
}]);

dashboardApp.controller('SchoolYearAddCtrl', ['$scope', '$window', 'schoolYearFactory', function ($scope, $window, schoolYearFactory) {
    $scope.add = function() {
        schoolYearFactory.addSchoolYear($scope.title)
        .success(function (data) {
            $window.location.href = '#/browse';
        })
        .error(function (error) {});
    }
}]);