dashboardApp = angular.module('dashboardApp', ['ngRoute', 'ui.bootstrap']);

dashboardApp.config(function($routeProvider) {
$routeProvider
    .when('/',
        {
          redirectTo: '/home'
        })
    .when('/home', 
        {
            controller: 'AdminUsersCtrl',
            templateUrl: 'partials/account/admin_users.html'
        })
    .when('/user/:id', 
        {
            controller: 'AdminUserCtrl',
            templateUrl: 'partials/account/admin_user.html'
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
    .otherwise({redirectTo: '/'})
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