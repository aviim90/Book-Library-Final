@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        @can('canEdit')
                            <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        @can('canEdit')
                                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-success">Edit</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('canEdit')
                                            <form method="post" action="{{route('categories.destroy', $category->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
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


