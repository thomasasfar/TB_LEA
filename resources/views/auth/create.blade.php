<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link href={{ asset('../css/loginstyle.css') }} rel="stylesheet">
</head>

<body>
    <section class="ftco-section">

        <div class="container">
            <div class="row justify-content-center">
                <!-- <div class="col-md-6 text-center mb-5">
     <h2 class="heading-section">Login #08</h2>
    </div> -->
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Register</h3>

                        <form action="/inventaris/register" class="login-form" method="post">

                            @csrf
                            <div>
                                <div class="form-group">
                                    <label for="name" class="form-labe" id="name">Name :</label>
                                    <input type="text" class="form-control rounded-left" placeholder="name"
                                        name="name" required />
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-labe" id="email">Email :</label>
                                    <input type="email" class="form-control rounded-left" placeholder="email "
                                        name="email" required />
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-labe" id="password">Password : </label>
                                    <input type="password" class="form-control rounded-left" name="password"
                                        placeholder="Password" required />
                                </div>
                                <div>
                                    <label for="alamat" class="form-labe" id="alamat">Alamat :</label>
                                    <input type="text" class="form-control rounded-left" placeholder="alamat"
                                        name="alamat" />
                                </div>
                                <div>
                                    <label for="no_hp" class="form-labe" id="no_hp">No. HP :</label>
                                    <input type="number" class="form-control rounded-left" placeholder="no.hp"
                                        name="no_hp" />
                                </div>
                                <div>
                                    <label for="jenis_kelamin" class="form-labe" id="jenis_kelamin">Jenis Kelamin
                                        :</label>
                                    <select name="jenis_kelamin" class="form-control rounded-left" id="jenis_kelamin">
                                        <option value="admin">Laki-laki</option>
                                        <option value="staff">Perempuan</option>
                                    </select>

                                </div>
                                <div class="form-group d-md-flex">
                                    <!-- <div class="w-50">
                                        <label
                                            class="checkbox-wrap checkbox-primary"
                                            >Remember Me
                                            <input type="checkbox" checked />
                                            <span class="checkmark"></span>
                                        </label>
                                    </div> -->
                                    <!-- <div class="w-30 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary rounded submit p-3 px-5">
                                        Register
                                    </button>
                                </div>
                                <br>
                                <br>
                                <br>
                                <div>
                                    <a href="/login">Sudah punya akun? login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
