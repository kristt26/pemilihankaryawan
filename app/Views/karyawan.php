<div class="row" ng-controller="karyawanController">
    <!-- <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="far fa-plus-square fa-1x"></i>&nbsp;&nbsp; Input data karyawan</h5>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div> -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Data Karyawan</h5>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#inputKaryawan">Tambah </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">#
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nama Karyawan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Kontak</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Alamat</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status</th>
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
                                    <p class="text-sm font-weight-bold mb-0">{{item.nama}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{item.hp}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{item.email}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{item.alamat}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                        {{item.status=='0' ? 'Tidak Aktif' : 'Aktif'}}</p>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" ng-click="edit(item)"><i
                                            class="fas fa-edit fa-5x"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        ng-click="delete(item)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="modal fade" id="inputKaryawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Input/Edit data karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" ng-submit="save(model)">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="col-form-label col-form-label-sm">Nama Karyawan</label>
                            <input type="text" class="form-control  form-control-sm" id="nama" ng-model="model.nama"
                                placeholder="Nama Karyawan" required>
                        </div>
                        <div class="form-group">
                            <label for="hp" class="col-form-label col-form-label-sm">Kontak</label>
                            <input type="text" class="form-control  form-control-sm" id="hp" ng-model="model.hp"
                                placeholder="No. Hp" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label col-form-label-sm">Email</label>
                            <input type="email" class="form-control  form-control-sm" id="email" ng-model="model.email"
                                placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label col-form-label-sm">Alamat</label>
                            <textarea id="alamat" rows="5" class="form-control  form-control-sm" ng-model="model.alamat"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jenis" class="col-form-label col-form-label-sm">Status</label>
                            <select id="jenis" class="form-select form-select-sm" ng-model="model.status" required>
                                <option value="0">Tidak Aktif</option>
                                <option value="1">Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"
                            class="btn btn-primary btn-sm pull-right">{{model.id ? 'Ubah': 'Simpan'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>