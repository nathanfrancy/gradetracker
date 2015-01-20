dashboardApp.controller('SchoolYearHomeCtrl', ['$scope', 'schoolYearFactory', 'alertService',
function ($scope, schoolYearFactory, alertService) {
    schoolYearFactory.getAllSchoolYears()
        .success(function (data) {
            $scope.schoolYears = data;
            $scope.predicate = '-title';
        })
        .error(function (error) {
            alertService.alert("Error loading your school years.", "danger", 3);
        });
}]);

dashboardApp.controller('SchoolYearSpecificHomeCtrl', ['$scope', '$routeParams', 'schoolYearFactory', 'studentFactory', 'standardFactory', 
function ($scope, $routeParams, schoolYearFactory, studentFactory, standardFactory) {

    $scope.id = $routeParams.id;

    standardFactory.getStandardsFromSchoolYear($scope.id)
        .success(function (data) {
            $scope.standards = data;
            $scope.orderByField = 'date_given';
            $scope.reverseSort = true;
        })
        .error(function (error) {
            alertService.alert("Error loading standards for this school year.", "danger", 3);
        });
    
    schoolYearFactory.getSchoolYear($scope.id)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {
            alertService.alert("Error loading this school year.", "danger", 3);
        });

    studentFactory.getStudentsFromSchoolYear($scope.id)
        .success(function (data) {
            $scope.roster = data;
        })
        .error(function (error) {
            alertService.alert("Error loading students for this school year.", "danger", 3);
        });
}]);

dashboardApp.controller('SchoolYearAddCtrl', ['$scope', '$window', '$routeParams', 'schoolYearFactory', 'alertService', 
function ($scope, $window, $routeParams, schoolYearFactory, alertService) {
    
    $scope.schoolYearId = $routeParams.id;

    $scope.add = function() {
        schoolYearFactory.addSchoolYear($scope.schoolYear)
        .success(function (data) {
            alertService.alert("Successfully added the school year.", "success", 3);
            $window.location.href = '#/browse';
        })
        .error(function (error) {
            alertService.alert("Error adding this school year.", "danger", 3);
        });
    }
}]);

dashboardApp.controller('SchoolYearEditCtrl', ['$scope', '$window', '$routeParams', 'schoolYearFactory', 'alertService',
function ($scope, $window, $routeParams, schoolYearFactory, alertService) {
    
    $scope.id = $routeParams.id;
    
    schoolYearFactory.getSchoolYear($scope.id)
        .success(function (data) {
            $scope.schoolYear = data;
        })
        .error(function (error) {
            alertService.alert("Error loading this school year.", "danger", 3);
        });

    $scope.edit = function() {
        schoolYearFactory.editSchoolYear($scope.schoolYear)
        .success(function (data) {
            $window.location.href = '#/browse/schoolyear/'+ $scope.schoolYear.id;
            alertService.alert(data.message, "success", 3);
        })
        .error(function (error) {
            alertService.alert("Error updating this school year.", "danger", 3);
        });
    }
}]);