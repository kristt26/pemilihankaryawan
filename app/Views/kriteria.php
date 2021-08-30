<div class="row" ng-controller="kriteriaController">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="far fa-plus-square fa-1x"></i>&nbsp;&nbsp; Input Kriteria</h5>
            </div>
            <div class="card-body">
                <form role="form" ng-submit="save(model)">
                    <div class="form-group">
                        <label for="kode" class="col-form-label col-form-label-sm">Kode</label>
                        <input type="text" class="form-control  form-control-sm" id="kode" ng-model="model.kode"
                            placeholder="ex. C1" required>
                    </div>
                    <div class="form-group">
                        <label for="kriteria" class="col-form-label col-form-label-sm">Kriteria</label>
                        <input type="text" class="form-control  form-control-sm" id="kriteria" ng-model="model.nama"
                            placeholder="Nama Kriteria" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis" class="col-form-label col-form-label-sm">Jenis Kriteria</label>
                        <select id="jenis" class="form-select form-select-sm" ng-model="model.type" required>
                            <option value="Benefits">Benefit</option>
                            <option value="Cost">Cost</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bobot" class="col-form-label col-form-label-sm">Bobot</label>
                        <input type="number" class="form-control  form-control-sm" id="bobot" ng-model="model.bobot"
                            placeholder="bobot" required>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit"
                            class="btn btn-primary btn-sm pull-right">{{model.id ? 'Ubah': 'Simpan'}}</button>
                        <button type="button" ng-show="!simpan" class="btn btn-warning btn-sm pull-right"
                            ng-click="clear()">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Data Kriteria</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        #</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kode</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kriteria</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bobot Kriteria</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jenis</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        <i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.kode}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.nama}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.bobot}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.type}}</p>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" ng-click="edit(item)"><i
                                                class="fas fa-edit fa-5x"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" ng-click="showSub(item)"><i
                                                class="fas fa-list"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            ng-click="deleteKriteria(item)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-12 mt-3" ng-if="sub==true">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Data Sub Kriteria
                        {{subKriteria.nama}}</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#inputSubKriteria">Tambah</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        #</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Sub Kriteria</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bobot</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        <i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in subKriteria.subKriteria">
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.nama}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.bobot}}</p>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" ng-click="editSub(item)"><i
                                                class="fas fa-edit fa-5x"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            ng-click="deleteSub(item)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="inputSubKriteria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Input/Edit data karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" ng-submit="saveSub(modelSub)">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="col-form-label col-form-label-sm">Sub Kriteria</label>
                            <input type="text" class="form-control  form-control-sm" id="nama" ng-model="modelSub.nama"
                                placeholder="Sub Kriteria" required>
                        </div>
                        <div class="form-group">
                            <label for="bobott" class="col-form-label col-form-label-sm">Bobot</label>
                            <input type="number" class="form-control  form-control-sm" id="bobott" ng-model="modelSub.bobot"
                                placeholder="bobot" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"
                            class="btn btn-primary btn-sm pull-right">{{modelSub.id ? 'Ubah': 'Simpan'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>