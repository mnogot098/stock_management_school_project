@extends('templates.layout')

@section('content')
    <!--Header--> 
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-7">
              <nav aria-label="breadcrumb" class="d-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark py-2">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employees</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add employee</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center"> 
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Add employee</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary d-none">Save</a>
                </div>
              </div>
            </div>
            <div class="card-body">
                      @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach 
                        </div>
                      @elseif(Session::get('success'))
                              <div class="alert alert-success" role="alert">
                              {{Session::get('success')}}
                              </div>
                      @endif
              <form action="{{ route('employees.store') }}" method="POST" name="form">
                @csrf
                <h6 class="heading-small text-muted mb-4">Employee information</h6>
                <div class="pl-lg-4">    
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="first-name">First name</label>
                        <input type="text" id="first-name" class="form-control" placeholder="First name" name="first_name" value="{{ old('first_name') }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="last-name">Last name</label>
                        <input type="text" id="last-name" class="form-control" placeholder="Last name" name="last_name" value="{{ old('last_name') }}">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="email">Email address</label>
                        <input type="email" id="email" class="form-control" placeholder="Example@example.com" name="email" value="{{ old('email') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="address">Address</label>
                        <input type="text" id="address" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="phone">Phone number</label>
                        <input type="text" id="phone" class="form-control" placeholder="Phone number" name="phone_number" value="{{ old('phone_number') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="password">Password</label>
                        <input type="text" id="password" class="form-control" placeholder="Password" name="password">
                      </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="role">Role</label>
                          <select class="form-control" id="role" name="role_id">
                            <option disabled>--Select Role--</option>
                            <option value="1">Admin</option>
                            <option value="2">Employee</option>
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 mt-2">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      //A function to generate passwords so the admin doesn't have to enter them manually
      function generatePassword(){
        var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%&^*()";
        var length = 10;
        var password  = "";
        for (let i = 0, n = chars.length; i < length; i++) {
          password += chars.charAt(Math.floor(Math.random() * n));
        }
        return password;
      }

      window.onload = function(){
        var passwordField = document.getElementById('password');
        password.setAttribute('value', generatePassword());
      }
    </script>
@endsection
      