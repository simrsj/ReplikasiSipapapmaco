<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-2">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form class="user" method="post" id="form_login">
                                    <div class="form-group">
                                        <input id='username_user' name='username_user' placeholder='Email/Username' class="form-control">
                                        <div class="text-xs text-danger text-center i blink mb-2" id="err_username"></div>
                                    </div>
                                    <div class="form-group input-group mb-0">
                                        <input type='password' id='password_user' name='password_user' placeholder='Password' class="form-control" aria-describedby="see_password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-white" id="see_password">
                                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs text-danger  text-center i blink mb-2" id="err_password"></div>
                                    <button class="btn btn-primary btn-user btn-block login">LOGIN</button>
                                </form>
                                <br>
                                <div class="text-center">
                                    <a class="small" href="?forgot_pass">Lupa Password</a>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="?reg">Lakukan Pendaftaran disini</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        const togglePassword = document.querySelector("#togglePassword");
                        const password = document.querySelector("#password_user");

                        togglePassword.addEventListener("click", function() {
                            // toggle the type attribute
                            const type = password.getAttribute("type") === "password" ? "text" : "password";
                            password.setAttribute("type", type);

                            // toggle the icon
                            this.classList.toggle("bi-eye");
                        });

                        // prevent form submit
                        const form = document.querySelector("form");
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
        // inisiasi klik modal login simpan
        $(document).on('click', '.login', function() {
            console.log("login");
            var data_login = $("#form_login").serializeArray();

            var username = $('#username_user').val();
            var password = $('#password_user').val();

            //Loading screen
            Swal.fire({
                title: 'Mohon Ditunggu . . .',
                // html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100" />',
                html: '<div class="loader mb-5 mt-5 text-center"></div>',
                allowOutsideClick: false,
                showConfirmButton: false,
            });

            //cek data from bila tidak diiisi
            if (
                username == "" ||
                password == ""
            ) {

                console.log("Data Tidak Terisi");
                if (username == "") $("#err_username").html("Username Harus Diisi");
                else $("#err_username").html("");

                if (password == "") $("#err_password").html("Password Harus Diisi");
                else $("#err_password").html("");

                Swal.fire({
                    allowOutsideClick: true,
                    icon: 'warning',
                    html: '<span class="text-lg b">Data Ada yang Belum Terisi</span>',
                    showConfirmButton: false,
                    timer: 10000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            }

            $.ajax({
                type: 'POST',
                url: "_log-sign/exc/x_login_cek.php",
                data: data_login,
                dataType: 'JSON',
                success: function(response) {
                    if (response.ket == 'Y') {
                        $.ajax({
                            type: 'POST',
                            url: "_log-sign/exc/x_login.php",
                            data: data_login,
                            dataType: 'JSON',
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: false,
                                    html: '<span class="text-xl b text-dark">LOGIN BERHASIL</span>',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    // didOpen: (toast) => {
                                    //     toast.addEventListener('mouseenter', Swal.stopTimer)
                                    //     toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    // }
                                }).then(
                                    function() {
                                        document.location.href = "?";
                                    }
                                );
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                    } else {
                        Swal.fire({
                            allowOutsideClick: true,
                            // isDismissed: false,
                            icon: 'warning',
                            html: '<span class="text-lg b">Cek Kembali Username dan Password</span>',
                            showConfirmButton: false,
                            timer: 10000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
</div>

<div class="container">
    <div class="row justify-content-center">
        <!-- <a href="panduan_aplikasi_sm.pdf" class="btn btn-danger" target="_blank"> APLIKASI</a> -->
    </div>
</div>