@extends('product::layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-10">

        @if(session('status'))
        <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif

            <div class="card">
                <div class="card-header">
                    <h4>Edit Product
                    <a href="{{ url('product/product') }}" class="btn btn-danger float-end">BACK</a></h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('product/update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                       <div class="form-group mb-3">
                           <label for="">Product Name</label>
                           <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                       </div> 

                       <div class="form-group mb-3">
                        <label for="">Category Id</label>
                        
                        <select name="category_id" class="form-control ">
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}" 
                                    {{ $product->category_id == $item->id ? 'selected': '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div> 

                       <div class="form-group mb-3">
                           <label for="">Product Status</label>
                           <input type="text" name="status" value="{{ $product->status }}" class="form-control">
                       </div>
                       
                       <div class="form-group mb-3">
                        <label for="">Product Image</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ asset('uploads/products/'.$product->image) }}" width="40px" height="40px" alt="Image">
                    </div>
                       <div class="form-group mb-3">
                           <button type="submit" class="btn btn-primary">Update Product</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection