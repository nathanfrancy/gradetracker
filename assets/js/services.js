angular.module('dashboardApp').factory('schoolYearFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getAllSchoolYears = function () {
        return $http.get('/api/get/?rq=getAllSchoolYears');
    };
    
    /*
    dataFactory.getSingleCity = function (id) {
        return $http.get('/api/get/?rq=getSingleCity&id='+ id);
    };
    dataFactory.addCity = function (name) {
        return $http({ url: 'api/add/index.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'addCity', name: name }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.updateCity = function (id, name) {
        return $http({ url: '/api/update/index.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'updateCity', id: id, name: name }, headers: { "Content-Type": "application/json"}});
    };
    dataFactory.deleteCity = function (city) {
        return $http({ url: '/api/delete/index.php', dataType: 'json', method: 'PUT',
                    data: { rq: 'deleteCity', id: city.id }, headers: { "Content-Type": "application/json"}});
    };
    */

    return dataFactory;
}]);