@extends('layouts.login')
@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="row">
        <div
          class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 mt-5">
          <div class="card card-primary">
            <div class="card-header text-center">
                <h2 class="text-center mx-auto">Login</h2>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control @error('email') ? is-invalid @enderror" name="email" tabindex="1" value="{{ old('email') }}" required autofocus />
                   @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" tabindex="2" required />
                  <div class="float-right my-3">
                    <a href="#" class="text-small" >
                      Forgot Password?
                    </a>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Login</button>
                </div>
              </form>
            </div>
          </div>
          <div class="mt-5 text-muted text-center">
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
          </div>
          <div class="simple-footer">Hak Cipta &copy; 2024. MSIB Fullstack Web Depelover <br/>
            Dibuat dan dikembangkan oleh <a href="#"> Kelompok 5.</a>
        </div>
        </div>
      </div>
    </div>
  </section>
@endsection
