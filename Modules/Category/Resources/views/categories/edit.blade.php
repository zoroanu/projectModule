@extends('category::layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">

        @if(session('status'))
        <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif

            <div class="card">
                <div class="card-header">
                    <h4>Edit Product
                    <a href="{{ url('category/index-category') }}" class="btn btn-danger float-end">BACK</a></h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('category/update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                       <div class="form-group mb-3">
                           <label for="">Category Name</label>
                           <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                       </div> 

                       <div class="form-group mb-3">
                           <label for="">Category description</label>
                           <input type="text" name="description" value="{{ $category->description }}" class="form-control">
                       </div>
                       
                       <div class="form-group mb-3">
                        <label for="">Category Image</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ asset('uploads/categories/'.$category->image) }}" width="40px" height="40px" alt="Image">
                    </div>
                       <div class="form-group mb-3">
                           <button type="submit" class="btn btn-primary">Update Category</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection