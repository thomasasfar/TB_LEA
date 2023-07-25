@extends('template')

@section('title')
    Barang
@endsection

@section('konten')

<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <div class="card-body p-1 text-center">
                <h3 class="mb-5">Sign in</h3>
              </div>
          <form action="/auth/login" method="post">
            @csrf
            <!-- Username input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Username</label>
              <input
                type="text"
                id="username"
                class="form-control form-control-lg"
                placeholder="Enter your username"
                name="username"
              />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Password</label>
              <input
                type="password"
                id="password"
                class="form-control form-control-lg"
                placeholder="Enter password"
                name="password"
              />
            </div>

            @if ($errors->any())
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
								<p>{{ $error }}</p>
							@endforeach
						</div>
            @endif

            <div class="text-center text-lg-start mt-4 pt-2">
              <div class="card-body p-5 text-center">
                <a href="dash.html">
                  <button
                    type="submit"
                    class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem"
                  >
                    Sign In
                  </button>
                </a>
                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Don't have an account?
                  <a href="/register" class="link-danger">Register</a>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


@endsection
