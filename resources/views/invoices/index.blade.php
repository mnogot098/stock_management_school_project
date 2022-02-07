@extends('templates.layout')

@section('content')
    <style>
      .d-icones{
        font-size : 40px;
      }
      .hover-red:hover{
            color : #f40f02;
      }
      .hover-green:hover{
            color : #1d6f42;
      }
    </style>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-7">
              <nav aria-label="breadcrumb" class="d-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark py-2">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('invoices') }}">Invoices</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Index</li>
                </ol>
              </nav>
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
                    <th scope="col" class="sort" data-sort="to">To</th>
                    <th scope="col" class="sort" data-sort="amount">Amount</th>
                    <th scope="col" class="sort" data-sort="status">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($invoices as $invoice)
                     <tr>
                        <th>{{ $invoice->id }}</th>
                        <td>{{ $invoice->date }}</td>                              
                        <td>{{ $invoice->supplier->first_name.' '.$invoice->supplier->last_name }}</td>
                        <td>&dollar;{{ $invoice->amount }}</td>
                        <td>
                          @if ($invoice->finalized == 0)
                              On hold
                          @else
                              Paid
                          @endif                 
                        </td>
                        <td class="text-right">
                          <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              {{-- <a class="dropdown-item" href="{{ route('invoice.print', $invoice->id) }}">Download</a> --}}
                              <button class="dropdown-item" data-toggle="modal" data-target="{{'#downloadInvoice'.$invoice->id}}" >Download</button>
                              <form action="{{ route('invoice.markAsPaid', $invoice->id) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="dropdown-item">Mark as paid</button>
                              </form>
                              <button class="dropdown-item" data-toggle="modal" data-target="{{'#markAsPaid'.$invoice->id}}" >Delete</button>
                            </div>
                            <!-- Download dialog -->
                            <div class="modal fade" id="{{'downloadInvoice'.$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Download invoice</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-center">
                                    <div class="d-flex justify-content-around px-sm-9 mt-4">
                                      <a href="{{ route('invoice.print', $invoice->id) }}" class="d-block text-muted"><i class="fas fa-file-pdf d-icones hover-red"></i></a>
                                      <a href="#" onclick="alert('This feature is not available yet')" class="d-block text-muted"><i class="fas fa-file-excel d-icones hover-green "></i></a>
                                    </div>
                                  </div>
                                  <div class="modal-footer"></div>
                                </div>
                              </div>
                            </div>
                            <!-- Confirm Delete dialog -->
                            <div class="modal fade" id="{{'markAsPaid'.$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete invoice</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-left">
                                    Are you sure you want to delete this invoice?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('shipments.delete', $invoice->id) }}" method="POST">
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
              {{ $invoices->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection