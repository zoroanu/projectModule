@extends('product::layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">

            @if(session('status'))
        <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif

            <div class="card">
                <div class="class card header">
                    <h4> add product
                        <a href="{{ url('product/index-product') }}" class="btn btn-danger float-end">BACK</a></h4>
                </div>

                <div class="card-body">
                    <form action="{{ url('product/add-product') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div> 

                        <div class="form-group mb-3">
                            <label for="">Category Id</label>
                            {{-- <input type="text" name="catagory_id" class="form-control"> --}}

                            <select name="category_id" class="form-control ">
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>


                        </div> 

                        <div class="form-group mb-3">
                            <label for="">Product Status</label>
                            <input type="text" name="status" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Product Image</label>
                            <input type="file" name="image" class="form-control">
                        </div> 

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                        
                        
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection 