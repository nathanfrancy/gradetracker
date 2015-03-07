dashboardApp.controller('StandardAddCtrl', ['$scope', '$window', '$routeParams', 'standardFactory', 'studentFactory', 'schoolYearFactory', 'subjectFactory', 'alertService',
function ($scope, $window, $routeParams, standardFactory, studentFactory, schoolYearFactory, subjectFactory, alertService) {
    
    schoolYearFactory.getSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {
            alertService.alert("Error loading the school year.", "danger", 3);
        });

    subjectFactory.getSubjectsFromSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.possiblesubjects = data;
        })
        .error(function (error) {
            alertService.alert("Error loading the subjects for this school year.", "danger", 3);
        });

    $scope.add = function() {
        var temp = new Date($scope.standard.date_given);
        $scope.standard.date_given =  temp.getFullYear() + "-" + (temp.getMonth()+1) + "-" + temp.getDate();
        
        standardFactory.addStandard($scope.standard, $scope.schoolyear, $scope.subject)
            .success(function (data) {
                alertService.alert("Successfully added "+ $scope.standard.title +".", "success", 3);
                $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
            })
            .error(function (error) {
                alertService.alert("Error adding "+ $scope.standard.title + ".", "danger", 3);
            });
    }
}]);

dashboardApp.controller('StandardEditCtrl', ['$scope', '$window', '$routeParams', 'standardFactory', 'studentFactory', 'schoolYearFactory', 'subjectFactory', 'alertService', 
function ($scope, $window, $routeParams, standardFactory, studentFactory, schoolYearFactory, subjectFactory, alertService) {
    
    $scope.id = $routeParams.standardId;
    $scope.schoolYearId = $routeParams.schoolYearId;

    /* Get the school year to let the user know the student is going in the right class */
    schoolYearFactory.getSchoolYear($scope.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;
        })
        .error(function (error) {
            alertService.alert("Error loading school year.", "danger", 3);
        });

    subjectFactory.getSubjectsFromSchoolYear($routeParams.schoolYearId)
        .success(function (data) {
            $scope.possiblesubjects = data;
        })
        .error(function (error) {
            alertService.alert("Error loading the subjects for this school year.", "danger", 3);
        });

    /* Get the standard applicable to edit */
    standardFactory.getStandard($scope.id)
        .success(function (data) {
            $scope.standard = data;
        })
        .error(function (error) {
            alertService.alert("Error loading standard (id="+ $scope.id +".", "danger", 3);
        });

    $scope.edit = function() {
        var temp = new Date($scope.standard.date_given);
        $scope.standard.date_given =  temp.getFullYear() + "-" + (temp.getMonth()+1) + "-" + temp.getDate();
        
        standardFactory.editStandard($scope.standard)
        .success(function (data) {
            alertService.alert("Successfully edited "+ $scope.standard.title + ".", "success", 3);
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {
            alertService.alert("Error editing this standard (id="+ $scope.standard.id +".", "danger", 3);
        });
    }
}]);

dashboardApp.controller('StandardRecordGradesCtrl', ['$scope', '$window', '$routeParams', 'standardFactory', 'studentFactory', 'schoolYearFactory', 'gradeFactory', 'alertService',
function ($scope, $window, $routeParams, standardFactory, studentFactory, schoolYearFactory, gradeFactory, alertService) {

    $scope.id = $routeParams.standardId;
    $scope.schoolYearId = $routeParams.schoolYearId;

    /* Get the student applicable to edit */
   

    /* Get the school year to let the user know the student is going in the right class */
    schoolYearFactory.getSchoolYear($scope.schoolYearId)
        .success(function (data) {
            $scope.schoolyear = data;

            /* Get the particular standard for this page */
             standardFactory.getStandard($scope.id)
                .success(function (data) {
                    $scope.standard = data;

                    /* Get the students that will have taken this test (from this school year) */
                    gradeFactory.getStudentsWithStandardGrades($scope.schoolyear.id, $scope.standard.id)
                        .success(function (data) {
                            $scope.roster = data;
                        })
                        .error(function (error) {
                            alertService.alert("Error loading standard grades.", "danger", 3);
                        });
                })
                .error(function (error) {
                    alertService.alert("Error loading this standard.", "danger", 3);
                });
        })
        .error(function (error) {
            alertService.alert("Error loading this school year.", "danger", 3);
        });
    
    $scope.edit = function() {
        standardFactory.editStandard($scope.standard)
        .success(function (data) {
            alertService.alert("Successfully updated standard grades.", "success", 3);
            $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
        })
        .error(function (error) {
            alertService.alert("Error saving grades.", "danger", 3);
        });
    }
    
    $scope.recordStandardGrades = function() {
        gradeFactory.recordStandardGrades($scope.roster, $scope.standard)
            .success(function (data) {
                alertService.alert("Successfully saved standard grades.", "success", 3);
                $window.location.href = '#/browse/schoolyear/' + $scope.schoolyear.id;
            })
            .error(function (error) {
                alertService.alert("Error saving grades.", "danger", 3);
            });
    }
}]);