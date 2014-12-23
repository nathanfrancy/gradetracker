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

    /*
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