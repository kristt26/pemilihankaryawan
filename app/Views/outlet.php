<div class="row" ng-controller="outletController">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="far fa-plus-square fa-1x"></i>&nbsp;&nbsp; Input Outlet</h5>
            </div>
            <div class="card-body">
                <form role="form" ng-submit="save(model)">
                    <div class="form-group">
                        <label for="outlet" class="col-form-label col-form-label-sm">Outlet/Bagian</label>
                        <input type="text" class="form-control  form-control-sm" id="outlet" ng-model="model.outlet"
                            placeholder="Outlet/Bagian" required>
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
                    <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Data Outlet</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        #
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Outlet</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.outlet}}</p>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" ng-click="edit(item)"><i
                                                class="fas fa-edit fa-5x"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" ng-click="showKar(item)"><i
                                                class="fas fa-list"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(item)"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-12 mt-3" ng-if="kar==true">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Karyawan
                        {{subKriteria.nama}}</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#inputSubKriteria">Tambah</button>
                </div>
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
                                        Nama Karyawan</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in outletKar.karyawan">
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{item.nama}}</p>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            ng-click="deleteKar(item, outletKar)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                <form role="form" ng-submit="saveKar(modelKar)">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="col-form-label col-form-label-sm">Karyawan</label>
                            <select id="jenis" class="form-select form-select-sm"
                                ng-options="item as item.nama for item in karyawans" ng-model="Itemkaryawan"
                                ng-change="modelKar.outletid = outletKar.id; modelKar.karyawanid = Itemkaryawan.id"
                                required></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm pull-right">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>