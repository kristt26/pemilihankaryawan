angular.module('adminctrl', [])
    .controller('pageController', pageController)
    .controller('homeController', homeController)
    .controller('kriteriaController', kriteriaController)
    .controller('karyawanController', karyawanController)
    .controller('periodeController', periodeController)
    .controller('penilaianController', penilaianController)
    .controller('analysisController', analysisController);

function pageController($scope, helperServices) {
    $scope.Title = "Page Header";
}

function homeController($scope, $http, helperServices, homeServices) {
    $scope.$emit("SendUp", "Home");
    homeServices.get().then(x => {
        console.log(x);
        var lebel = [];
        var datas = [];
        var color = [];
        x.forEach(element => {
            lebel.push($scope.setBulan(element.stringbln));
            datas.push(element.jumlah);
            color.push("#"+Math.floor(Math.random()*16777215).toString(16));
        });
        console.log(lebel);
        console.log(datas);
        console.log(color);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lebel,
                datasets: [{
                    data: datas,
                    backgroundColor: color,
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }, 
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Pemasangan Iklan Tahun ' + new Date().getFullYear(),
                      }
                }
            }
        });
    })

    $scope.setBulan = (bulan)=>{
        switch (parseInt(bulan)) {
            case 1:
                return "Januari"
                break;
            case 2:
                return "Februari"
                break;
            case 3:
                return "Maret"
                break;
            case 4:
                return "April"
                break;
            case 5:
                return "Mei"
                break;
            case 6:
                return "Juni"
                break;
            case 7:
                return "Juli"
                break;
            case 8:
                return "Agustus"
                break;
            case 9:
                return "September"
                break;
            case 10:
                return "Oktober"
                break;
            case 11:
                return "November"
                break;
        
            default:
                return "Desember"
                break;
        }
    }
}

function kriteriaController($scope, kriteriaServices, message) {
    $scope.$emit("SendUp", "Kriteria");
    $scope.datas = [];
    $scope.model = {};
    $scope.modelSub = {};
    $scope.sub = false;
    kriteriaServices.get().then(res=>{
        $scope.datas = res;
    })

    $scope.edit = (item)=>{
        item.bobot = parseFloat(item.bobot);
        $scope.model = angular.copy(item)
    }

    $scope.editSub = (item)=>{
        item.bobot = parseFloat(item.bobot);
        $scope.modelSub = angular.copy(item);
        $("#inputSubKriteria").modal('show');
    }
    
    $scope.save = (item)=>{
        if(item.id){
            message.dialog("Anda yakin ingin mengubah kriteria?", "Ya", "Tidak").then(x=>{
                kriteriaServices.putKriteria(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $scope.model = {};
                })
            })
        }else{
            message.dialog("Anda yakin ingin menyimpan kriteria?", "Ya", "Tidak").then(x=>{
                kriteriaServices.postKriteria(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $scope.model = {};
                })
            })
        }
    }

    $scope.saveSub = (item)=>{
        item.kriteriaid = $scope.subKriteria.id;
        if(item.id){
            message.dialog("Anda yakin ingin mengubah Sub kriteria?", "Ya", "Tidak").then(x=>{
                kriteriaServices.putSubKriteria(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $scope.modelSub = {};
                    $("#inputSubKriteria").modal('hide');
                })
            })
        }else{
            message.dialog("Anda yakin ingin menyimpan Sub kriteria?", "Ya", "Tidak").then(x=>{
                kriteriaServices.postSubKriteria(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $scope.modelSub = {};
                    $("#inputSubKriteria").modal('hide');
                })
            })
        }
    }

    $scope.deleteKriteria = (item)=>{
        message.dialog("Yakin ingin menghapus?", "Ya", "Tidak").then(x=>{
            kriteriaServices.deletedKriteria(item).then(res=>{
                message.info("Berhasil menghapus Kriteria");
            })
        })
    }

    $scope.deleteSub = (item)=>{
        message.dialog("Yakin ingin menghapus?", "Ya", "Tidak").then(x=>{
            kriteriaServices.deletedSubKriteria(item).then(res=>{
                message.info("Berhasil menghapus Kriteria");
            })
        })
    }

    $scope.showSub = (item)=>{
        $scope.subKriteria = item;
        $scope.sub = true;
        console.log($scope.subKriteria);
        // $("#inputSubKriteria").modal('show');
    }
}

function karyawanController($scope, karyawanServices, message) {
    $scope.$emit("SendUp", "Karyawan");
    $scope.datas = [];
    $scope.model = {};
    karyawanServices.get().then(res=>{
        $scope.datas = res;
    })

    $scope.edit = (item)=>{
        $scope.model = angular.copy(item);
        console.log($scope.model);
        $("#inputKaryawan").modal('show');
    }
    
    $scope.save = (item)=>{
        if(item.id){
            message.dialog("Anda yakin ingin mengubah data karyawan?", "Ya", "Tidak").then(x=>{
                karyawanServices.put(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $("#inputKaryawan").modal('hide');
                    $scope.model = {};
                })
            })
        }else{
            message.dialog("Anda yakin ingin menyimpan data karyawan?", "Ya", "Tidak").then(x=>{
                karyawanServices.post(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $("#inputKaryawan").modal('hide');
                    $scope.model = {};
                })
            })
        }
    }

    $scope.delete = (item)=>{
        message.dialog("Yakin ingin menghapus?", "Ya", "Tidak").then(x=>{
            karyawanServices.deleted(item).then(res=>{
                message.info("Berhasil menghapus Kriteria");
            })
        })
    }
}

function periodeController($scope, periodeServices, message) {
    $scope.$emit("SendUp", "Karyawan");
    $scope.datas = [];
    $scope.model = {};
    periodeServices.get().then(res=>{
        $scope.datas = res;
    })

    $scope.edit = (item)=>{
        $scope.model = angular.copy(item);
        console.log($scope.model);
        $("#inputKaryawan").modal('show');
    }
    
    $scope.save = (item)=>{
        if(item.id){
            message.dialog("Anda yakin ingin mengubah data karyawan?", "Ya", "Tidak").then(x=>{
                periodeServices.put(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $("#inputKaryawan").modal('hide');
                    $scope.model = {};
                })
            })
        }else{
            message.dialog("Anda yakin ingin menyimpan data karyawan?", "Ya", "Tidak").then(x=>{
                periodeServices.post(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $("#inputKaryawan").modal('hide');
                    $scope.model = {};
                })
            })
        }
    }

    $scope.delete = (item)=>{
        message.dialog("Yakin ingin menghapus?", "Ya", "Tidak").then(x=>{
            periodeServices.deleted(item).then(res=>{
                message.info("Berhasil menghapus Kriteria");
            })
        })
    }
}

function penilaianController($scope, penilaianServices, kriteriaServices, message) {
    $scope.$emit("SendUp", "Penilaian");
    $scope.datas = [];
    $scope.model = {};
    $scope.setEdit =  false;
    penilaianServices.get().then(res=>{
        $scope.datas = res;
        kriteriaServices.get().then(res=>{
            $scope.kriterias = res;
            console.log($scope.kriterias);
        })
    })

    $scope.edit = (item)=>{
        $scope.model = angular.copy(item);
        $scope.model.nilai.forEach(element => {
            if(element.nilai){
                element.setNilai = element.subKriteria.find(x=>x.id == element.nilai.subkriteriaid);
            }
        });
        console.log($scope.model);
        $("#formNilai").modal('show');
    }
    
    $scope.save = (item)=>{
        console.log(item);
        if($scope.setEdit){
            message.dialog("Anda yakin ingin mengubah data?", "Ya", "Tidak").then(x=>{
                penilaianServices.put(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $("#formNilai").modal('hide');
                    $scope.model = {};
                })
            })
        }else{
            message.dialog("Anda yakin ingin menyimpan data?", "Ya", "Tidak").then(x=>{
                penilaianServices.post(item).then(res=>{
                    message.info('Proses Berhasil !!!');
                    $("#formNilai").modal('hide');
                    $scope.model = {};
                })
            })
        }
    }

    $scope.delete = (item)=>{
        message.dialog("Yakin ingin menghapus?", "Ya", "Tidak").then(x=>{
            penilaianServices.deleted(item).then(res=>{
                message.info("Berhasil menghapus Kriteria");
            })
        })
    }
}

function analysisController($scope, analysisServices, message) {
    $scope.$emit("SendUp", "Penilaian");
    $scope.datas = [];
    $scope.model = {};
    $scope.setEdit =  false;
    analysisServices.get().then(res=>{
        $scope.datas = res;
        console.log($scope.datas);
    })
    $scope.print = () => {
        $("#print").printArea();
    }
}