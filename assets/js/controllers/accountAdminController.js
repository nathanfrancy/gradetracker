/* partials/account/profile_home.html */
dashboardApp.controller('AccountHomeCtrl', ['$scope', 'accountFactory', 'alertService', function ($scope, accountFactory, alertService) {
	
	accountFactory.getUser()
        .success(function (data) {
            $scope.user = data;
        })
        .error(function (error) {
            alertService.alert("Couldn't load user.", "danger", 3);
        });
}]);

dashboardApp.controller('AdminUsersCtrl', ['$scope', 'accountFactory', 'alertService', function ($scope, accountFactory, alertService) {
    
    accountFactory.getUser()
        .success(function (data) {
            $scope.user = data;

            accountFactory.getAllUsers()
                .success(function (data) {
                    $scope.users = data;
                })
                .error(function (error) {
                    alertService.alert("Couldn't load users.", "danger", 3);
                });
        })
        .error(function (error) {
            alertService.alert("Couldn't load user.", "danger", 3);
        });

    $scope.refreshUsers = function() {
        accountFactory.getAllUsers()
            .success(function (data) {
                $scope.users = data;
            })
            .error(function (error) {
                alertService.alert("Couldn't load users.", "danger", 3);
            });
    }
}]);

dashboardApp.controller('AdminUserCtrl', ['$scope', '$routeParams', '$window', 'accountFactory', 'alertService', function ($scope, $routeParams, $window, accountFactory, alertService) {
    $scope.id = $routeParams.id;

    $scope.bootswatch_themes = bootswatch;

    accountFactory.getUserById($scope.id)
        .success(function (data) {
            $scope.user = data;

            accountFactory.getLoginRecordsForAccount($scope.user.id)
                .success(function (data2) {
                    $scope.logs = data2;

                    // Parse the date/times
                    for (var i = 0; i < $scope.logs.length; i++) {
                        $scope.logs[i].date_tried = Date.parse($scope.logs[i].date_tried);
                    }
                })
                .error(function (error) {
                    alertService.alert("Couldn't load login records.", "danger", 3);
                });
        })
        .error(function (error) {
            alertService.alert("Couldn't load user.", "danger", 3);
        });

    $scope.editUser = function() {
        // Service call to save the user
        accountFactory.editUser($scope.user)
        .success(function (data) {
            alertService.alert(data.message, data.response, 3);
        })
        .error(function (error) {
            alertService.alert("Couldn't save user.", "danger", 3);
        });
    }

}]);


/* partials/account/profile_edit.html */
dashboardApp.controller('AccountEditCtrl', ['$scope', '$window', 'accountFactory', 'alertService', 
    function ($scope, $window, accountFactory, alertService) {
	
    $scope.bootswatch_themes = bootswatch;

	accountFactory.getUser()
        .success(function (data) {
            $scope.user = data;
        })
        .error(function (error) {
            alertService.alert("Couldn't load user.", "danger", 3);
        });

    $scope.submitEditProfile = function(user) {
        accountFactory.editUser(user)
            .success(function (data) {
                alertService.alert("Successfully updated your profile.", "success", 3);
                $window.location.href = '#/profile';
            })
            .error(function (error) {
                alertService.alert("Error occurred while trying to update user.", "danger", 3);
            });
    };

    $scope.userPasswordReset = function(user) {
        // Check if new passwords match
        if (user.newpassword_1 == user.newpassword_2) {

            accountFactory.userPasswordReset(user)
                .success(function (data) {
                    if (data.response == true) {
                        alertService.alert("Successfully updated your password.", "success", 3);
                        $window.location.href = '#/profile';
                    }
                    else {
                        alertService.alert("Error: make sure current password is correct.", "warning", 3);
                    }
                })
                .error(function (error) {
                    alertService.alert("Error occured when trying to update password.", "danger", 3);
                });
        }
    };

    // Will run every time the select box is changed
    $scope.updateTheme = function(theme) {
    	jQuery("link#boots_theme").attr("href", "assets/vendor/css/bootswatch/"+ theme +".css");
        alertService.alert("Viewing "+ theme + " theme. Submit to save.", "warning", 3);
    };
}]);