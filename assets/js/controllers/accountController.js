/* partials/account/profile_home.html */
dashboardApp.controller('AccountHomeCtrl', ['$scope', 'accountFactory', function ($scope, accountFactory) {
	
	accountFactory.getUser()
        .success(function (data) {
            $scope.user = data;
        })
        .error(function (error) {});
}]);


/* partials/account/profile_edit.html */
dashboardApp.controller('AccountEditCtrl', ['$scope', 'accountFactory', function ($scope, accountFactory) {
	
    $scope.bootswatch_themes = [
		"cerulean", "cosmo", "cyborg", "darkly","flatly", "journal", "lumen", "paper", "readable", "sandstone", "simplex", "slate", "spacelab", "superhero", "united", "yeti"
	];

	accountFactory.getUser()
        .success(function (data) {
            $scope.user = data;
        })
        .error(function (error) {});

    $scope.submitEditProfile = function(user) {
        accountFactory.editUser(user)
            .success(function (data) {
                console.log(data);
            })
            .error(function (error) {});
    };

    $scope.submitPasswordReset = function(user) {
        // Check if new passwords match
        if (user.newpassword_1 == user.newpassword_2) {

        }
    };

    // Will run every time the select box is changed
    $scope.updateTheme = function(theme) {
    	jQuery("link#boots_theme").attr("href", "assets/vendor/css/bootswatch/"+ theme +".css");
    };
}]);