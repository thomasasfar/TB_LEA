@extends('template')

@section('title')
    Barang
@endsection

@section('konten')

<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <div class="card-body p-3 text-center">
                <h3 class="mb-5">Register</h3>
              </div>
            <form id="register" action="/auth/register" method="post">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-1">
              <label class="form-label" for="form3Example3">Name</label>
              <input
                type="text"
                id="name"
                class="form-control form-control-lg"
                placeholder="Please enter your name"
                name="nama"
                required
              />
            </div>

            <!-- Email input -->
            <div class="form-outline mb-1">
                <label class="form-label" for="form3Example3">Email</label>
                <input
                  type="email"
                  id="email"
                  class="form-control form-control-lg"
                  placeholder="Please enter your name"
                  name="email"
                  required
                />
              </div>

            <div class="form-outline mb-1">
              <label class="form-label" for="form3Example3">Username</label>
              <input
                type="text"
                id="username"
                class="form-control form-control-lg"
                placeholder="Create a username"
                name="username"
                required
              />
            </div>

            <div class="form-outline mb-1">
                <label class="form-label" for="form3Example3">Phone Number</label>
                <input
                  type="text"
                  id="username"
                  class="form-control form-control-lg"
                  placeholder="Enter your phone number"
                  name="no_hp"
                  required
                />
              </div>

            <div class="form-outline mb-1">
              <label class="form-label" for="form3Example3">Password</label>
              <input
                type="password"
                id="password"
                class="form-control form-control-lg"
                placeholder="Enter a password"
                name="password"
                required
              />
            </div>

            <div class="text-center text-lg-start mt-0 pt-0">
              <div class="card-body p-3 text-center">
                <button
                  type="submit"
                  class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem"
                >
                  Register
                </button>
                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Already have an account?
                  <a href="login.html" class="link-danger">Login</a>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


@endsection
