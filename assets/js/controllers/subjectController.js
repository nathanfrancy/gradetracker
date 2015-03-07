dashboardApp.controller('SubjectAddCtrl', ['$scope', '$window', '$routeParams', 'subjectFactory', 'schoolYearFactory', 'alertService',
function ($scope, $window, $routeParams, subjectFactory, schoolYearFactory, alertService) {

    schoolYearFactory.getSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {
            alertService.alert("Error loading school year.", "danger", 3);
        });

    $scope.add = function() {

        subjectFactory.addSubject($scope.subject, $scope.schoolyear)
            .success(function (data) {
                alertService.alert("Successfully added subject.", "success", 3);
                $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
            })
            .error(function (error) {
                alertService.alert("Error saving subject.", "danger", 3);
            });

    }
    
}]);