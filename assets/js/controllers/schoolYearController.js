dashboardApp.controller('SchoolYearHomeCtrl', ['$scope', 'schoolYearFactory', function ($scope, schoolYearFactory) {
    schoolYearFactory.getAllSchoolYears()
        .success(function (data) {
            $scope.schoolYears = data;
        })
        .error(function (error) {});
}]);