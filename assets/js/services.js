angular.module('dashboardApp').factory('accountFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getUser = function () {
        return $http.get('/api/get.php?rq=getUser');
    };
    dataFactory.editUser = function (user) {
        return $http({ url: '/api/edit.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'editUser', id: user.id, firstname: user.firstname, lastname: user.lastname, email: user.email, username: user.username, theme: user.theme }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.userPasswordReset = function (user) {
        return $http({ url: '/api/edit.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'userPasswordReset', currentpassword: user.currentpassword, newpassword: user.newpassword_1 }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.getAllUsersSortedByType = function() {
        return $http.get('/api/get.php?rq=getAllUsersSortedByType');
    }

    return dataFactory;
}]);

angular.module('dashboardApp').factory('schoolYearFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getAllSchoolYears = function () {
        return $http.get('/api/get.php?rq=getAllSchoolYears');
    };
    dataFactory.addSchoolYear = function (schoolYear) {
        return $http({ url: '/api/add.php', dataType: 'json', method: 'PUT',
                    data: { 
                        rq: 'addSchoolYear', 
                        title: schoolYear.title,
                        q1_start: schoolYear.q1_start,
                        q1_end: schoolYear.q1_end,
                        q2_start: schoolYear.q2_start,
                        q2_end: schoolYear.q2_end,
                        q3_start: schoolYear.q3_start,
                        q3_end: schoolYear.q3_end,
                        q4_start: schoolYear.q4_start,
                        q4_end: schoolYear.q4_end }, 
                    headers: { "Content-Type": "application/json"}});
    };
    dataFactory.getSchoolYear = function (id) {
        return $http.get('/api/get.php?rq=getSchoolYear&id='+ id);
    };
    dataFactory.editSchoolYear = function (schoolYear) {
        return $http({ url: '/api/edit.php', dataType: 'json', method: 'PUT',
                    data: { 
                        rq: 'editSchoolYear', 
                        id: schoolYear.id, 
                        title: schoolYear.title, 
                        q1_start: schoolYear.q1_start,
                        q1_end: schoolYear.q1_end,
                        q2_start: schoolYear.q2_start,
                        q2_end: schoolYear.q2_end,
                        q3_start: schoolYear.q3_start,
                        q3_end: schoolYear.q3_end,
                        q4_start: schoolYear.q4_start,
                        q4_end: schoolYear.q4_end }, 
                    headers: { "Content-Type": "application/json"}});
    };

    return dataFactory;
}]);

angular.module('dashboardApp').factory('studentFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getStudentsFromSchoolYear = function (id) {
        return $http.get('/api/get.php?rq=getStudentsFromSchoolYear&id=' + id);
    };
    dataFactory.addStudent = function (student, schoolyear) {
        return $http({ url: '/api/add.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'addStudent', firstname: student.firstname, lastname: student.lastname, schoolyear_id: schoolyear.id }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.getStudent = function (id) {
        return $http.get('/api/get.php?rq=getStudent&id='+ id);
    };
    dataFactory.editStudent = function (student) {
        return $http({ url: '/api/edit.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'editStudent', id: student.id, firstname: student.firstname, lastname: student.lastname, status: student.status}, headers: { "Content-Type": "application/json"}});
    };
    /*
    dataFactory.deleteCity = function (city) {
        return $http({ url: '/api/delete/index.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'deleteCity', id: city.id }, headers: { "Content-Type": "application/json"}});
    };
    */

    return dataFactory;
}]);

angular.module('dashboardApp').factory('standardFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getStandardsFromSchoolYear = function (id) {
        return $http.get('/api/get.php?rq=getStandardsFromSchoolYear&id=' + id);
    };
    dataFactory.addStandard = function (standard, schoolyear) {
        return $http({ url: '/api/add.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'addStandard', title: standard.title, description: standard.description, date_given: standard.date_given, schoolyear_id: schoolyear.id }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.getStandard = function (id) {
        return $http.get('/api/get.php?rq=getStandard&id='+ id);
    };
    dataFactory.editStandard = function (standard) {
        return $http({ url: '/api/edit.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'editStandard', id: standard.id, title: standard.title, description: standard.description, date_given: standard.date_given }, headers: { "Content-Type": "application/json"}});
    };
    /*
    dataFactory.deleteCity = function (city) {
        return $http({ url: '/api/delete/index.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'deleteCity', id: city.id }, headers: { "Content-Type": "application/json"}});
    };
    */

    return dataFactory;
}]);

angular.module('dashboardApp').factory('gradeFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getStudentsWithStandardGrades = function (schoolyear_id, standard_id) {
        return $http.get('/api/get.php?rq=getStudentsWithStandardGrades&schoolyear_id=' + schoolyear_id + '&standard_id=' + standard_id);
    };
    dataFactory.recordStandardGrades = function (students, standard) {
        return $http({ url: '/api/add.php', dataType: 'json', method: 'PUT',
                    data: { rq: "recordStandardGrades", students: students, standard: standard }, headers: { "Content-Type": "application/json"}});
    };

    return dataFactory;
}]);

/* Notification service, include in in dependencies - call alertService.alert(msg, type, seconds) to push to view */
/* Temporarily using jquery to show and hide messages */
dashboardApp.service('alertService', function($timeout) {
    var serv = {};
    serv.alert = function(msg, type, seconds) {
        jQuery("#alert-container .alert").removeClass("alert-success alert-danger alert-warning alert-info");
        jQuery("#alert-container .alert").addClass("alert-" + type);
        jQuery("#alert-container .alert span").html(msg);
        jQuery("#alert-container").fadeIn();
        $timeout(function() {
            jQuery("#alert-container").fadeOut();
        }, (seconds*1000) );
    }
    return serv;
});