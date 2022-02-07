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
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">New product</li>
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
                <h3 class="mb-0">Add product</h3>
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
            <form action="{{ route('products.store') }}" method="POST" name="form">
              @csrf
              <h6 class="heading-small text-muted mb-4">Product information</h6>
              <div class="pl-lg-4"> 
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="label">Label</label>
                      <input type="text" id="label" class="form-control" placeholder="Label" name="label" value="{{ old('label') }}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="categories">Category</label>
                      <select class="form-control" id="categories" name="category_id">
                          <option value="0" disabled>--Select Category--</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
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
                      <label class="form-control-label" for="quantity">Quantity</label>
                      <input type="number" min="1" id="quantity" class="form-control" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="suppliers">Supplier</label>
                    <select class="form-control" id="suppliers" name="supplier_id">
                      <option value="0" disabled>--Select Supplier--</option>
                          @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->first_name }} {{ $supplier->last_name }}</option>
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
                      <label class="form-control-label" for="basePrice">Base price</label>
                      <input type="number" min="1" id="basePrice" class="form-control" placeholder="Base price" name="buying_cost" value="{{ old('buying_cost') }}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="sellingPrice">Selling price</label>
                      <input type="number" min="1" id="sellingPrice" class="form-control" placeholder="Selling price" name="selling_cost" value="{{ old('selling_cost') }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="pl-lg-4">
                <div class="form-group">
                  <label class="form-control-label" for="description">Description</label>
                  <textarea rows="4" id="description" class="form-control" placeholder="Product details" name="description" value="{{ old('description') }}">{{ old('description') }}</textarea>
                </div>
              </div>
              <div class="pl-lg-4">               
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
@endsection
      