dashboardApp.controller('StandardAddCtrl', ['$scope', '$window', '$routeParams', 'standardFactory', 'studentFactory', 'schoolYearFactory', function ($scope, $window, $routeParams, standardFactory, studentFactory, schoolYearFactory) {
    
    schoolYearFactory.getSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {});

    $scope.add = function() {
        var temp = new Date($scope.standard.date_given);
        $scope.standard.date_given =  temp.getFullYear() + "-" + (temp.getMonth()+1) + "-" + temp.getDate();
        standardFactory.addStandard($scope.standard, $scope.schoolyear)
        .success(function (data) {
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {});
    }
}]);

dashboardApp.controller('StandardEditCtrl', ['$scope', '$window', '$routeParams', 'standardFactory', 'studentFactory', 'schoolYearFactory', function ($scope, $window, $routeParams, standardFactory, studentFactory, schoolYearFactory) {
    $scope.id = $routeParams.standardId;
    $scope.schoolYearId = $routeParams.schoolYearId;

    /* Get the student applicable to edit */
    standardFactory.getStandard($scope.id)
        .success(function (data) {
            $scope.standard = data;
        })
        .error(function (error) {});

    /* Get the school year to let the user know the student is going in the right class */
    schoolYearFactory.getSchoolYear($scope.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {});

    $scope.edit = function() {
        var temp = new Date($scope.standard.date_given);
        $scope.standard.date_given =  temp.getFullYear() + "-" + (temp.getMonth()+1) + "-" + temp.getDate();
        
        standardFactory.editStandard($scope.standard)
        .success(function (data) {
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {});
    }
}]);

dashboardApp.controller('StandardRecordGradesCtrl', ['$scope', '$window', '$routeParams', 'standardFactory', 'studentFactory', 'schoolYearFactory', function ($scope, $window, $routeParams, standardFactory, studentFactory, schoolYearFactory) {
    $scope.id = $routeParams.standardId;
    $scope.schoolYearId = $routeParams.schoolYearId;

    /* Get the student applicable to edit */
    standardFactory.getStandard($scope.id)
        .success(function (data) {
            $scope.standard = data;
        })
        .error(function (error) {});

    /* Get the school year to let the user know the student is going in the right class */
    schoolYearFactory.getSchoolYear($scope.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        
            studentFactory.getStudentsFromSchoolYear($scope.schoolyear.id)
            .success(function (data) {
                $scope.roster = data;
            })
            .error(function (error) {});
        })
        .error(function (error) {});
    
    $scope.edit = function() {
        standardFactory.editStandard($scope.standard)
        .success(function (data) {
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {});
    }
    
    $scope.saveGrades = function() {
        standardFactory.recordGrades($scope.roster)
            .success(function (data) {
                console.log(data);
            })
            .error(function (error) {});
    }
}]);