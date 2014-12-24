var dashboardApp = angular.module('dashboardApp', ['ngRoute', 'ui.bootstrap']);

dashboardApp.config(function($routeProvider) {
$routeProvider
    .when('/',
        {
          redirectTo: '/home'
        })
    .when('/home',
        {
          controller: 'DashboardHomeCtrl',
          templateUrl: 'partials/dashboard/_dashboard_home.html'
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
    
    .otherwise({redirectTo: '/home'})
});

function HeaderController($scope, $location) { 
    $scope.isActive = function (viewLocation) { 
        return $location.path().indexOf(viewLocation) == 0;
    };
}

/** 
  * Dropdown controller for the right-side menu */
dashboardApp.controller('DropdownCtrl', function ($scope, $log) {
  $scope.status = {
    isopen: false
  };

  $scope.toggleDropdown = function($event) {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.status.isopen = !$scope.status.isopen;
  };
});