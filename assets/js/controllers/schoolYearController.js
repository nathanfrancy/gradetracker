dashboardApp.controller('SchoolYearHomeCtrl', ['$scope', 'schoolYearFactory', function ($scope, schoolYearFactory) {
    schoolYearFactory.getAllSchoolYears()
        .success(function (data) {
            $scope.schoolYears = data;
        })
        .error(function (error) {});
}]);

dashboardApp.controller('SchoolYearSpecificHomeCtrl', ['$scope', '$routeParams', 'schoolYearFactory', 'studentFactory', 'standardFactory', function ($scope, $routeParams, schoolYearFactory, studentFactory, standardFactory) {
    $scope.id = $routeParams.id;
    $scope.quarters = [
        { title: "Quarter 1" },
        { title: "Quarter 2" },
        { title: "Quarter 3" },
        { title: "Quarter 4" }
    ];

    standardFactory.getStandardsFromSchoolYear($scope.id)
        .success(function (data) {
            $scope.standards = data;
            $scope.orderByField = 'date_given';
            $scope.reverseSort = true;
        })
        .error(function (error) {});
    
    schoolYearFactory.getSchoolYear($scope.id)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {});

    studentFactory.getStudentsFromSchoolYear($scope.id)
        .success(function (data) {
            $scope.roster = data;
        })
        .error(function (error) {});
}]);

dashboardApp.controller('SchoolYearAddCtrl', ['$scope', '$window', 'schoolYearFactory', function ($scope, $window, schoolYearFactory) {
    $scope.schoolYearId = $routeParams.id;

    $scope.add = function() {
        schoolYearFactory.addSchoolYear($scope.title)
        .success(function (data) {
            $window.location.href = '#/browse';
        })
        .error(function (error) {});
    }
}]);

dashboardApp.controller('SchoolYearEditCtrl', ['$scope', '$window', '$routeParams', 'schoolYearFactory', function ($scope, $window, $routeParams, schoolYearFactory) {
    schoolYearFactory.getSchoolYear($scope.id)
        .success(function (data) {
            $scope.title = data.title;
        })
        .error(function (error) {});

    $scope.edit = function() {
        schoolYearFactory.editSchoolYear($scope.id, $scope.title)
        .success(function (data) {
            $window.location.href = '#/browse';
        })
        .error(function (error) {});
    }
}]);