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
                <li class="breadcrumb-item"><a href="{{ route('shipments') }}">Shipments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit shipment</li>
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
              <div class="col-12">
                <h3 class="mb-0">Edit shipment</h3>
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
            <form action="{{ route('shipments.edit', $shipment->id) }}" method="POST" name="form">
                @method('PATCH')
                @csrf
                <h6 class="heading-small text-muted mb-4">Shipment information</h6>
                <div class="pl-lg-4"> 
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="datePicker">Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input id="datePicker" type="text" class="form-control datepicker" placeholder="yyyy-mm-dd"  name="date" value="{{ $shipment->date }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="shipment-type">Shipment type</label>
                              <select class="form-control" id="shipment-type" name="shipment_type_id">
                                  <option value="-1" disabled>--Select Type--</option>
                                  @foreach ($shipmentTypes as $shipmentType)
                                    @if ($shipmentType->id == $shipment->shipment_type_id)
                                        <option value="{{ $shipmentType->id }}" selected>{{ $shipmentType->type }}</option>
                                    @else
                                        <option value="{{ $shipmentType->id }}">{{ $shipmentType->type }}</option>
                                    @endif                          
                                  @endforeach 
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-lg-4"> 
                    <div class="row"> 
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="product">Product</label>
                                <select class="form-control" id="product" name="product_id">
                                  <option value="0" disabled>--Select Product--</option>
                                      @foreach ($products as $product)
                                        @if ($product->id == $shipment->product_id)
                                            <option value="{{ $product->id }}" selected>{{ $product->label }}</option>
                                        @else
                                            <option value="{{ $product->id }}">{{ $product->label }}</option>
                                        @endif
                                      @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="quantity">Quantity</label>
                              <input id="quantity" type="number" min="1" class="form-control" placeholder="Quantity" name="quantity" value="{{ $shipment->quantity }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-lg-4">               
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="price">Total price</label>
                              <input type="number" min="1" step=".01" id="price" class="form-control" placeholder="Total price" name="total_price" value="{{ $shipment->total_price }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-lg-4">               
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary px-4 mt-2">Save changes</button>
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
@endsection
      