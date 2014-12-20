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
    .when('/browse/schoolYear',
        {
          controller: 'SchoolYearHomeCtrl',
          templateUrl: 'partials/schoolyear/_schoolyear_home.html'
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