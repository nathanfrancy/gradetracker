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

    /* Get the student applicable to edit */
    studentFactory.getStudent($scope.id)
        .success(function (data) {
            $scope.student = data;
        })
        .error(function (error) {});

    /* Get the school year to let the user know the student is going in the right class */
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
}]);