 @extends('product::layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-2"></div> 
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>product list
                    <a href="{{ url('product/add-product') }}" class="btn btn-primary float-end">Add Product</a></h4>
                </div>
                <div class="card-body">
                        <table class="table brodered tabler-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td >{{ $item->category->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/products/'.$item->image) }}" width="40px" height="40px" alt="Image">
                                    </td>
                                    <td>
                                        <a href="{{ url('edit-product/'.$item->id) }}"  class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        {{-- <a href="{{ url('delete-product/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                                        
                                        <form action="{{ url('delete-product/'.$item->id) }}" method="POST" accept-charset="UTF-8" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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