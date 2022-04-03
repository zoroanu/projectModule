@extends('category::layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-2"></div> 
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Category list
                    <a href="{{ url('category/add-category') }}" class="btn btn-primary float-end">Add Category</a></h4>
                </div>
                <div class="card-body">
                        <table class="table brodered tabler-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>description</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/categories/'.$item->image) }}" width="40px" height="40px" alt="Image">
                                    </td>
                                    <td>
                                        <a href="{{ url('category/edit-category/'.$item->id) }}"  class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        {{-- <a href="{{ url('delete-category/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}

                                        <form action="{{ url('category/delete-category/'.$item->id) }}" method="POST" accept-charset="UTF-8" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot are you sure you want to delete your product list also;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>

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