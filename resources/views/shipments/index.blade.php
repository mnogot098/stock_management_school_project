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
                  <li class="breadcrumb-item"><a href="{{ route('shipments') }}">Shipments</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Index</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('shipments.add') }}" class="btn btn-sm btn-neutral">New shipment</a>
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
                    <th scope="col" class="sort" data-sort="date">Date</th>
                    <th scope="col" class="sort" data-sort="type">Type</th>
                    <th scope="col" class="sort" data-sort="product">Product</th>
                    <th scope="col" class="sort" data-sort="quantity">Quantity</th>
                    <th scope="col" class="sort" data-sort="total">Total</th>
                    <th scope="col" class="sort" data-sort="status">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($shipments as $shipment)
                     <tr>
                        <th>{{ $shipment->id }}</th>
                        <td>{{ $shipment->date }}</td>                
                        <td>{{ $shipment->shipment_type->type }}</td>                
                        <td>{{ $shipment->product->label }}</td>
                        <td>{{ $shipment->quantity }}</td>
                        <td>&dollar;{{ $shipment->total_price }}</td>
                        <td>
                          @if ($shipment->finalized == 0)
                              Pending
                          @else
                              Complete
                          @endif                 
                        </td>
                        <td class="text-right">
                          <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a class="dropdown-item" href="{{ route('shipments.edit', $shipment->id) }}">Edit</a>
                              <form action="{{ route('shipments.markAsComplete', $shipment->id) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="dropdown-item">Mark as complete</button>
                              </form>
                              
                              <button class="dropdown-item" data-toggle="modal" data-target="{{'#markAsComplete'.$shipment->id}}" >Delete</button>
                            </div>
                            <!-- Confirm Delete window -->
                            <div class="modal fade" id="{{'markAsComplete'.$shipment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete shipment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-left">
                                    Are you sure you want to delete this shipment?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('shipments.delete', $shipment->id) }}" method="POST">
                                      @method('DELETE')
                                      @csrf
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
              {{ $shipments->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection