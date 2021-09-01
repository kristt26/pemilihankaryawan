<!DOCTYPE html>
<html lang="en" ng-app="auth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <title>
        User Login
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body ng-controller="userLogin">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form ng-submit="login()">
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" ng-model="model.username" placeholder="Username"
                                                aria-label="Username" aria-describedby="email-addon" required>
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" ng-model="model.password" placeholder="Password"
                                                aria-label="Password" aria-describedby="password-addon" required>
                                        </div>
                                        <!-- <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div> -->
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign
                                            up</a>
                                    </p>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../../assets/img/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mx-auto text-center">
                    &nbsp;
                </div>
                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                        document.write(new Date().getFullYear())
                        </script> Hotel Permata Jayapura
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="../../libs/jquery/dist/jquery.min.js"></script>
    <script src="../../libs/angular/angular.min.js"></script>
    <script src="../../js/services/helper.services.js"></script>
    <script src="../../js/services/message.services.js"></script>
    <script src="../../libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../../libs/swangular/swangular.js"></script>
    <script src="../../libs/loading/dist/loadingoverlay.min.js"></script>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Github buttons -->

    <script>
    angular.module('auth', ['helper.service', 'swangular', 'message.service'])
        .controller('userLogin', userLogin);

    function userLogin($scope, $http, helperServices, message) {
        $(".message a").click(function() {
            $("form").animate({
                height: "toggle",
                opacity: "toggle"
            }, "slow");
        });
        if ('<?=session()->getFlashdata('pesan')?>') {
            message.info('<?=session()->getFlashdata('pesan')?>');
        }
        $scope.model = {};
        $scope.setForm = "";
        $scope.error = false
        $scope.model.username = 'Administrator';
        $scope.model.password = 'Admin@123';
        $scope.Form = (set) => {
            $scope.setForm = set;
        }
        $scope.login = () => {
            $http({
                method: "post",
                url: "<?=base_url('auth/login')?>",
                data: $scope.model
            }).then(res => {
                document.location.href = helperServices.url + '/home';
            }, err => {
                $scope.error = true;
                message.error(err.data.messages.error, "Ok");
            })
        }
        $scope.save = () => {
            if ($scope.setForm == 'create') {
                message.dialogmessage('Anda Yakin?', 'Ya', 'Tidak').then(x => {
                    $.LoadingOverlay("show");
                    $http({
                        method: "post",
                        url: "<?=base_url('auth/register')?>",
                        data: $scope.model
                    }).then(res => {
                        $.LoadingOverlay("hide");
                        message.info("Silahkan periksa email anda untuk confirmasi account", "Ok");
                    }, err => {
                        $.LoadingOverlay("hide");
                        message.error(err.data.messages.message, "Ok");
                        console.log(err.data.messages);
                    })
                })
            } else {
                message.dialogmessage('Anda Yakin ingin mereset password?', 'Ya', 'Tidak').then(x => {
                    $.LoadingOverlay("show");
                    $http({
                        method: "get",
                        url: "<?=base_url('auth/reset/')?>/" + $scope.model.email
                    }).then(res => {
                        $.LoadingOverlay("hide");
                        message.info("Silahkan periksa email anda", "Ok");
                    }, err => {
                        $.LoadingOverlay("hide");
                        message.error(err.data.messages.message, "Ok");
                        console.log(err.data.messages);
                    })
                })
            }
        }
    }
    </script>
</body>

</html>