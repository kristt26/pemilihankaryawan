<div class="row" ng-controller="periodeController">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="far fa-plus-square fa-1x"></i>&nbsp;&nbsp; Input Periode</h5>
            </div>
            <div class="card-body">
                <form role="form" ng-submit="save(model)">
                    <div class="form-group">
                        <label for="periode" class="col-form-label col-form-label-sm">Periode</label>
                        <input type="text" class="form-control  form-control-sm" id="periode" ng-model="model.periode"
                            placeholder="Periode Penilaian" required>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label col-form-label-sm">Status</label>
                        <select id="status" class="form-select form-select-sm" ng-model="model.status" required>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
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
                                    Peridoe</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status</th>
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
                                    <p class="text-sm font-weight-bold mb-0">{{item.periode}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                        {{item.status=='0' ? 'Tidak Aktif' : 'Aktif'}}</p>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" ng-click="edit(item)"><i
                                            class="fas fa-edit fa-5x"></i></button>
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
</div>