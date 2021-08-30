angular.module('admin.service', [])
    .factory('dashboardServices', dashboardServices)
    .factory('homeServices', homeServices)
    .factory('kriteriaServices', kriteriaServices)
    .factory('karyawanServices', karyawanServices)
    .factory('periodeServices', periodeServices)
    .factory('penilaianServices', penilaianServices)
    .factory('analysisServices', analysisServices);


function dashboardServices($http, $q, $state, helperServices, AuthService) {
    var controller = helperServices.url + 'users';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        post: post,
        put: put
    };

    function get() {
        var def = $q.defer();
        if (service.instance) {
            def.resolve(service.data);
        } else {
            $http({
                method: 'get',
                url: controller,
                headers: AuthService.getHeader()
            }).then(
                (res) => {
                    service.instance = true;
                    service.data = res.data;
                    def.resolve(res.data);
                },
                (err) => {
                    def.reject(err);
                }
            );
        }
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: helperServices.url + 'administrator/createuser/' + param.roles,
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: helperServices.url + 'administrator/updateuser/' + param.id,
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.firstName = param.firstName;
                    data.lastName = param.lastName;
                    data.userName = param.userName;
                    data.email = param.email;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

}

function homeServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'admin/home';
    var service = {};
    service.data = [];
    return {
        get: get
    };

    function get() {
        var def = $q.defer();
        if (service.instance) {
            def.resolve(service.data);
        } else {
            $http({
                method: 'get',
                url: controller + "/read",
                headers: AuthService.getHeader()
            }).then(
                (res) => {
                    def.resolve(res.data);
                },
                (err) => {
                    def.reject(err);
                }
            );
        }
        return def.promise;
    }

}

function kriteriaServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'kriteria/';
    var service = {};
    service.data = [];
    return {
        get:get, postKriteria:postKriteria, putKriteria: putKriteria, postSubKriteria:postSubKriteria, putSubKriteria:putSubKriteria, deletedKriteria:deletedKriteria, deletedSubKriteria:deletedSubKriteria
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function postKriteria(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'createKriteria',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                res.data.subKriteria = [];
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function postSubKriteria(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'createSubKriteria',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.kriteriaid);
                if(data){
                    data.subKriteria.push(res.data);
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function putKriteria(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'updateKriteria',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.id);
                if(data){
                    data.kode = param.kode;
                    data.nama = param.nama;
                    data.type = param.type;
                    data.bobot = param.bobot;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function putSubKriteria(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'updateSubKriteria',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.kriteriaid);
                if(data){
                    var item = data.subKriteria.find(x=>x.id == param.id);
                    if(item){
                        item.nama = param.nama;
                        item.bobot = param.bobot;
                    }
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function deletedKriteria(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + 'deleteKriteria/' + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function deletedSubKriteria(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + 'deleteSubKriteria/' + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.kriteriaid);
                if(data){
                    var index = data.subKriteria.indexOf(param);
                    data.subKriteria.splice(index, 1);
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }
}

function karyawanServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'karyawan/';
    var service = {};
    service.data = [];
    return {
        get:get, post:post, put: put, deleted:deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'create',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'update',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.id);
                if(data){
                    data.nama = param.nama;
                    data.hp = param.hp;
                    data.email = param.email;
                    data.alamat = param.alamat;
                    data.status = param.status;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + 'delete/' + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }
}

function periodeServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'periode/';
    var service = {};
    service.data = [];
    return {
        get:get, post:post, put: put, deleted:deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'create',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'update',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.id);
                if(data){
                    data.nama = param.nama;
                    data.hp = param.hp;
                    data.email = param.email;
                    data.alamat = param.alamat;
                    data.status = param.status;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + 'delete/' + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }
}

function penilaianServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'penilaian/';
    var service = {};
    service.data = [];
    return {
        get:get, post:post, put: put, deleted:deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'create',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.id);
                if(data){
                    data.nilai = res.data.nilai;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'update',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id == param.id);
                if(data){
                    data.nama = param.nama;
                    data.hp = param.hp;
                    data.email = param.email;
                    data.alamat = param.alamat;
                    data.status = param.status;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + 'delete/' + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }
}

function analysisServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'analysis/';
    var service = {};
    service.data = [];
    return {
        get:get
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err.data);
                message.info(err.data);
            }
        );
        return def.promise;
    }
}

