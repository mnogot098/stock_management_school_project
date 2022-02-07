@extends('templates.layout')

@section('content')
    
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark py-2">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('suppliers') }}">Suppliers</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Index</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('suppliers.add') }}" class="btn btn-sm btn-neutral">New supplier</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0"></div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush table-striped">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="id">#ID</th>
                    <th scope="col" class="sort" data-sort="supplier">Supplier</th>
                    <th scope="col" class="sort" data-sort="email">Email</th>
                    <th scope="col" class="sort" data-sort="phone">Phone number</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($suppliers as $supplier)
                     <tr>
                        <th>{{ $supplier->id }}</th>
                        <td>{{ $supplier->first_name }} {{ $supplier->last_name }}</td>                
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->phone_number }}</td>
                        <td>
                          <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a class="dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}">Edit</a>
                              <button class="dropdown-item" data-toggle="modal" data-target="{{'#confirmDelete'.$supplier->id}}">Delete</button>
                            </div>
                            <!-- Confirm Delete window -->
                            <div class="modal fade" id="{{'confirmDelete'.$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-left">
                                    Are you sure you want to delete {{ $supplier->first_name.' '.$supplier->last_name }}?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('suppliers.delete', $supplier->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                    </form> 
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr> 
                  @endforeach
                  
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              <!--Pagination links(defined in views/vendor/pagination/bootstrap-4.blade.php)-->
              {{ $suppliers->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection