dashboardApp.controller('StudentAddCtrl', ['$scope', '$window', '$routeParams', 'studentFactory', 'schoolYearFactory', function ($scope, $window, $routeParams, studentFactory, schoolYearFactory) {
    

    schoolYearFactory.getSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {});

        /*
    $scope.add = function() {
        schoolYearFactory.addSchoolYear($scope.student)
        .success(function (data) {
            $window.location.href = '#/browse';
        })
        .error(function (error) {});
    }*/
}]);