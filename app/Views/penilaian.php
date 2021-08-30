<div class="row" ng-controller="penilaianController">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-th-list"></i>&nbsp;&nbsp; Data Periode</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" ng-click="edit(item)"><i
                                            class="fas fa-check fa-5x"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="modal fade" id="formNilai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Input/Edit data karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" ng-submit="save(model)">
                    <div class="modal-body">
                        <div class="form-group" ng-repeat = "item in model.nilai">
                            <label for="{{item.id}}" class="col-form-label col-form-label-sm">{{item.nama}}</label>
                            <select id="{{item.id}}" class="form-select form-select-sm" ng-options="items as (items.nama + '|' + items.bobot) for items in item.subKriteria" ng-model="item.setNilai" required></select>
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