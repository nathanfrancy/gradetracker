angular.module('dashboardApp').factory('schoolYearFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getAllSchoolYears = function () {
        return $http.get('/api/get.php?rq=getAllSchoolYears');
    };
    dataFactory.addSchoolYear = function (title) {
        return $http({ url: '/api/add.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'addSchoolYear', title: title }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.getSchoolYear = function (id) {
        return $http.get('/api/get.php?rq=getSchoolYear&id='+ id);
    };
    dataFactory.editSchoolYear = function (id, title) {
        return $http({ url: '/api/edit.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'editSchoolYear', id: id, title: title }, headers: { "Content-Type": "application/json"}});
    };
    /*
    dataFactory.deleteCity = function (city) {
        return $http({ url: '/api/delete/index.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'deleteCity', id: city.id }, headers: { "Content-Type": "application/json"}});
    };
    */

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
                    data: { rq: 'addStandard', title: standard.title, date_given: standard.date_given, schoolyear_id: schoolyear.id }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.getStandard = function (id) {
        return $http.get('/api/get.php?rq=getStandard&id='+ id);
    };
    dataFactory.editStandard = function (standard) {
        return $http({ url: '/api/edit.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'editStandard', id: standard.id, title: standard.title, date_given: standard.date_given }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.recordGrades = function (students) {
        return $http({ url: '/controllers/testGrades.php', dataType: 'json', method: 'PUT',
                    data: { students: students }, headers: { "Content-Type": "application/json"}});
    };
    /*
    dataFactory.deleteCity = function (city) {
        return $http({ url: '/api/delete/index.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'deleteCity', id: city.id }, headers: { "Content-Type": "application/json"}});
    };
    */

    return dataFactory;
}]);