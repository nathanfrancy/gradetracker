dashboardApp.controller('StudentAddCtrl', ['$scope', '$window', '$routeParams', 'studentFactory', 'schoolYearFactory', 'alertService',
function ($scope, $window, $routeParams, studentFactory, schoolYearFactory, alertService) {

    schoolYearFactory.getSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {
            alertService.alert("Error loading school year.", "danger", 3);
        });

    $scope.add = function() {
        studentFactory.addStudent($scope.student, $scope.schoolyear)
        .success(function (data) {
            alertService.alert("Successfully added student.", "success", 3);
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {
            alertService.alert("Error saving student.", "danger", 3);
        });
    }
}]);

dashboardApp.controller('StudentEditCtrl', ['$scope', '$window', '$routeParams', 'studentFactory', 'schoolYearFactory', 
function ($scope, $window, $routeParams, studentFactory, schoolYearFactory) {

    $scope.id = $routeParams.studentId;
    $scope.schoolYearId = $routeParams.schoolYearId;

    studentFactory.getStudent($scope.id)
        .success(function (data) {
            $scope.student = data;
        })
        .error(function (error) {
            alertService.alert("Error loading student.", "danger", 3);
        });
    
    schoolYearFactory.getSchoolYear($scope.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {
            alertService.alert("Error loading school year.", "danger", 3);
        });

    $scope.edit = function() {
        studentFactory.editStudent($scope.student)
        .success(function (data) {
            alertService.alert("Successfully saved changes.", "success", 3);
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {
            alertService.alert("Error saving changes to student.", "danger", 3);
        });
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