<div class="row" ng-controller="analysisController">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Bobot Kriteria</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm table-hover table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width: 20%;">Kode</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.wp.bobot">
                                    <td><p class="text-sm font-weight-bold mb-0">{{item.kode}}</p></td>
                                    <td><p class="text-sm font-weight-bold mb-0">{{item.bobot}}</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Normalisasi Bobot</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm table-hover table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width: 20%;">Kode</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.wp.normalisasibobot">
                                    <td><p class="text-sm font-weight-bold mb-0">{{item.kode}}</p></td>
                                    <td><p class="text-sm font-weight-bold mb-0">{{item.bobot}}</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Data Matriks</h5>
                    </div>
                    <div class="card-body table-responsive p-0" style="height: 200px;">
                        <table class="table table-sm table-hover table-bordered text-nowrap table-head-fixed ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                    <th ng-repeat="item in datas.matriks[0].nilai" style="width: 15%;"
                                        class="text-center">
                                        {{item.kode}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.matriks">
                                    <td><p class="text-sm font-weight-bold mb-0">{{$index+1}}</p></td>
                                    <td><p class="text-sm font-weight-bold mb-0">{{item.nama}}</p></td>
                                    <td ng-repeat="nilaiKriteria in item.nilai" class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{nilaiKriteria.bobot}}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Nilai Vektor</h5>
                    </div>
                    <div class="card-body table-responsive p-0" style="height: 200px;">
                        <table class="table table-sm table-hover table-bordered text-nowrap table-head-fixed ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ng-repeat="item in datas.matriks[0].nilai" style="width: 15%;"
                                        class="text-center">
                                        {{item.kode}}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vector</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.wp.vector">
                                    <td><p class="text-sm font-weight-bold mb-0">{{$index+1}}</p></td>
                                    <td><p class="text-sm font-weight-bold mb-0">{{item.nama}}</p></td>
                                    <td ng-repeat="nilaiKriteria in item.nilai" class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{nilaiKriteria.bobot | number : 3}}</p>
                                    </td>
                                    <td><p class="text-sm font-weight-bold mb-0">{{item.vector | number : 3}}</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-danger">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Hasil Analisa</h5>
                        <button class="btn btn-info btn-sm" ng-click="print()"><i class="fas fa-print"></i> Print</button>
                    </div>
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <div id="print">
                            <div class="screen">
                                <center>
                                    <h4>HASIL ANALISA KARYAWAN TERBAIK</h4>
                                    <h5 class="font-italic">HOTEL PERMATA</h5>
                                    <!-- <h5>PERIODE {{periode.periode}}</h5> -->
                                    <hr class="style2" style="margin-bottom:12px"><br>
                                </center>                                
                            </div>
                            <table class="table table-sm table-hover table-bordered text-nowrap table-head-fixed ">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        ng-repeat="item in datas.wp.ranking | limitTo: (jumlahRanking==0 || jumlahRanking < 0) ? '' : jumlahRanking">
                                        <td><p class="text-sm font-weight-bold mb-0">{{$index+1}}</p></td>
                                        <td><p class="text-sm font-weight-bold mb-0">{{item.nama}}</p></td>
                                        <td><p class="text-sm font-weight-bold mb-0">{{item.preferensi}}</p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>