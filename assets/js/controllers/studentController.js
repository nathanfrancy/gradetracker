dashboardApp.controller('StudentAddCtrl', ['$scope', '$window', '$routeParams', 'studentFactory', 'schoolYearFactory', function ($scope, $window, $routeParams, studentFactory, schoolYearFactory) {

    schoolYearFactory.getSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {});

    $scope.add = function() {
        studentFactory.addStudent($scope.student, $scope.schoolyear)
        .success(function (data) {
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {});
    }
}]);

dashboardApp.controller('StudentEditCtrl', ['$scope', '$window', '$routeParams', 'studentFactory', 'schoolYearFactory', function ($scope, $window, $routeParams, studentFactory, schoolYearFactory) {
    $scope.id = $routeParams.studentId;
    $scope.schoolYearId = $routeParams.schoolYearId;

    studentFactory.getStudent($scope.id)
        .success(function (data) {
            $scope.student = data;
        })
        .error(function (error) {});
    
    schoolYearFactory.getSchoolYear($scope.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {});

    $scope.edit = function() {
        studentFactory.editStudent($scope.student)
        .success(function (data) {
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {});
    }
    
    /*
    standardFactory.getStandard($scope.id)
        .success(function (data) {
            $scope.standard = data;
        })
        .error(function (error) {});
    schoolYearFactory.getSchoolYear($scope.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {});

    $scope.edit = function() {
        standardFactory.editStandard($scope.standard)
        .success(function (data) {
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {});
    }
    */
}]);