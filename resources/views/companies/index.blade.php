@extends('layouts.main')
@section('title' , 'List Companies')

@section('content')
<main class="py-5">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-title">
                <strong>List companies</strong>
              </div>           
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="first_name" class="col-md-3 col-form-label">Name</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{$companies['name']}}</p>
                      </div>
                    </div>

                    {{-- <div class="form-group row">
                      <label for="first_name" class="col-md-3 col-form-label">Last Name</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{$companies->last_name}}</p>
                      </div>
                    </div> --}}

                    <div class="form-group row">
                      <label for="email" class="col-md-3 col-form-label">Email</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{$companies->email}}</p>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="phone" class="col-md-3 col-form-label">Address</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{$companies->address}}</p>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-md-3 col-form-label">Website</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{$companies->website}}</p>
                      </div>
                    </div>
                    
                    <hr>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

@endsection