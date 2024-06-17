@extends('layouts.login')
<section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2 mt-5">
          <div class="card card-primary">
            <div class="card-header mx-auto"><h2 class="mx-auto">Register</h2></div>

            <div class="card-body">
              <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                      <label>Nama</label>
                      <input type="text" name="name" class="form-control @error('name') ? is-invalid @enderror" required=""  value="{{ old('name') }}">
                      @error('name')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                <div class="form-group">
                  <label>Email*</label>
                      <input type="email" name="email" class="form-control @error('email') ? is-invalid @enderror" value="{{ old('email') }}" required="">
                      @error('email')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                </div>

                <div class="row">
                  <div class="form-group col-6">
                      <label>Password*</label>
                      <input type="password" name="password" class="form-control @error('password') ? is-invalid @enderror" value="" required="">
                      @error('password')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                  <div class="form-group col-6">
                    <label for="passwordConfirmation" class="d-block">Konfirmasi Password</label>
                    <input id="passwordConfirmation" type="password" class="form-control" name="password_confirmation">
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="mt-5 text-muted text-center">
              Do you have an account?
              <a href="{{ route('login') }}">Login</a>
              </div>
          <div class="simple-footer">
            Hak Cipta &copy; 2023. MSIB Fullstack Web Depelover <br>
            Dibuat dan dikembangkan oleh <a href="#">Kelompok 5</a>
          </div>
        </div>
      </div>
    </div>
  </section>
