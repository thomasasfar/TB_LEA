<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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

                        <h3 class="text-center mb-4">LOGIN</h3>

                        <form action="/inventaris/login" class="login-form" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control rounded-left" placeholder="Email "
                                    value="{{ Session::get('email') }}" name="email" required />
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password"
                                    placeholder="Password" required />
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
                                    Login
                                </button>
                                <br>
                                <br>
                                <br>
                                <a href="http://127.0.0.1:8000/register">don't have an account? create akun</a>
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
