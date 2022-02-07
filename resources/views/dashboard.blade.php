@extends('templates.layout')

@section('content')   
<!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-8">
            <nav aria-label="breadcrumb" class="d-md-inline-block">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark py-2">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item" ><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Overview</li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- Content -->
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h6 class="card-title text-uppercase text-muted mb-1">Total products</h6>
                      <span class="h2 font-weight-bold mb-0">{{ $productsInStock }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="fas fa-boxes"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-1 mb-0 text-xs small">
                    <span class="badge badge-dot text-xs small"><i class="bg-warning mr-0"></i> {{ $lowInStock }}</span>
                    <span class="text-nowrap small">Low in stock</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h6 class="card-title text-uppercase text-muted mb-0">Pending shipments</h6>
                      <span class="h2 font-weight-bold mb-0">{{ $pendingShipments }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-delivery-fast"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h6 class="card-title text-uppercase text-muted mb-0">Current month sales</h6>
                      <span class="h2 font-weight-bold mb-0">{{ $currentMonthSales }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  {{-- <p class="mt-3 mb-0 text-xs">
                    <span class="text-success mr-1"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Compared to last month</span>
                  </p> --}}
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h6 class="card-title text-uppercase text-muted mb-1">Current month profit</h6>
                      <span class="h2 font-weight-bold mb-0">@moneyformat($currentMonthProfit)k</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-1 mb-0 text-xs small">
                    @if ($growth > 0)
                        <span class="text-success mr-1"><i class="fa fa-arrow-up"></i></span>
                    @else
                        <span class="text-danger mr-1"><i class="fa fa-arrow-down"></i></span>
                    @endif
                    <span class="font-weight-bold">{{ $growth }}%</span>
                    <span class="text-nowrap small">Compared to last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card bg-default">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">Sales value</h5>
                </div>
                <div id="monthlyData" class="col" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":{{ $currentYearProfits }}}]}}' data-prefix="$" data-suffix="k">
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Pending shipments</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ route('shipments') }}" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
          <div class="table-responsive">
          <!-- Projects table -->
            <table class="table align-items-center table-flush table-striped">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Type</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($lastShipments as $shipment)
                    <tr>
                      <th scope="row">{{ $shipment->id }}</th>
                      <td>{{ $shipment->date }}</td>
                      <td>{{ $shipment->product->label }}</td>
                      <td>{{ $shipment->quantity }}</td>
                      <td>
                        @if($shipment->shipment_type->type == 'Outgoing')
                          <i class="fas fa-arrow-up text-info mr-3"></i> 
                        @else
                          <i class="fas fa-arrow-down text-info mr-3"></i>
                        @endif
                        {{ $shipment->shipment_type->type }}
                      </td>
                    </tr>
                  @endforeach                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection