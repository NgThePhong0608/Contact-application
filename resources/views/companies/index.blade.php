@extends('layouts.main')
@section('title' , 'Contact App | All Companies')
@section('content')
<main class="py-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-title">
            <div class="d-flex align-items-center">
              <h2 class="mb-0">All Companies</h2>
              <div class="ml-auto">
                <a href="{{route('admin.contacts.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- @include('contacts.filter', ['companies' => $companies])
            {{-- @includeIf('contacts.filter') --}}
            @if($message = session('message'))
            <div class="alert alert-success"> {{$message}} </div>
            @endif -->
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Address</th>
                  <th scope="col">Website</th>
                  <th scope="col">Email</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($companies as $index => $company)
                @include('companies.company', ['company' => $company, 'index' => $index ])
                @empty
                @include('companies.empty')
                @endforelse
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection