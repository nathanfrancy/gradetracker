dashboardApp = angular.module('dashboardApp', ['ngRoute', 'ui.bootstrap']);

dashboardApp.config(function($routeProvider) {
$routeProvider
    .when('/',
        {
          redirectTo: '/browse'
        })
    .when('/profile',
        {
          controller: 'AccountHomeCtrl',
          templateUrl: 'partials/account/profile_home.html'
        })
    .when('/profile/edit',
        {
          controller: 'AccountEditCtrl',
          templateUrl: 'partials/account/profile_edit.html'
        })
    .when('/browse',
        {
          controller: 'SchoolYearHomeCtrl',
          templateUrl: 'partials/schoolyear/_schoolyear_home.html'
        })
    .when('/browse/schoolyear',
        {
          controller: 'SchoolYearHomeCtrl',
          templateUrl: 'partials/schoolyear/_schoolyear_home.html'
        })
    .when('/browse/schoolyear/:id',
        {
          controller: 'SchoolYearSpecificHomeCtrl',
          templateUrl: 'partials/schoolyear/_schoolyear_specifichome.html'
        })
    .when('/schoolyear/add',
        {
          controller: 'SchoolYearAddCtrl',
          templateUrl: 'partials/schoolyear/_schoolyear_add.html'
        })
    .when('/schoolyear/edit/:id',
        {
          controller: 'SchoolYearEditCtrl',
          templateUrl: 'partials/schoolyear/_schoolyear_edit.html'
        })

    .when('/browse/schoolyear/:schoolYearId/addstudent',
        {
          controller: 'StudentAddCtrl',
          templateUrl: 'partials/student/_student_add.html'
        })
    .when('/browse/schoolyear/:schoolYearId/editstudent/:studentId',
        {
          controller: 'StudentEditCtrl',
          templateUrl: 'partials/student/_student_edit.html'
        })

    .when('/browse/schoolyear/:schoolYearId/addstandard',
        {
          controller: 'StandardAddCtrl',
          templateUrl: 'partials/standard/_standard_add.html'
        })
    .when('/browse/schoolyear/:schoolYearId/editstandard/:standardId',
        {
          controller: 'StandardEditCtrl',
          templateUrl: 'partials/standard/_standard_edit.html'
        })
    .when('/browse/schoolyear/:schoolYearId/recordgrades/:standardId',
        {
          controller: 'StandardRecordGradesCtrl',
          templateUrl: 'partials/standard/_standard_recordgrades.html'
        })
    
    .otherwise({redirectTo: '/browse'})
});

dashboardApp.controller('NavBarController', function ($scope, $log, $location) {
    $scope.navbarCollapsed = true;
    
    $scope.isActive = function (viewLocation) { 
        return $location.path().indexOf(viewLocation) == 0;
    };
    
    $scope.status = {
        isopen: false
    };

    $scope.toggled = function(open) {
        $log.log('Dropdown is now: ', open);
    };

    $scope.toggleDropdown = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.status.isopen = !$scope.status.isopen;
    };
});

dashboardApp.controller('SchoolYearNavController', function ($scope, $log, $location, schoolYearFactory) {
    schoolYearFactory.getAllSchoolYears()
        .success(function (data) {
            $scope.schoolYears = data;
        })
        .error(function (error) {});
});