@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Books</div>

                    <div class="card-body">
                        @can('canEdit')
                            <a href="{{route('books.create')}}" class="btn btn-success">Add Book</a>
                        @endcan
                        <hr>
                        @can('reader')
                            <h5>Filter by Category</h5>

                            <form method="post" action="{{route('books.filter')}}">
                                @csrf
                                <div class="mb-3">
                                    <label>Choose Category</label>
                                    <select class="form-select" name="category_id">
                                        <option value="" {{ ($filter_category_id==null)?'selected':'' }}>all</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ ($filter_category_id==$category->id)?'selected':''}}>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-success">Filter</button>
                            </form>
                            <hr>
                            <h5>Find Book</h5>
                            <form method="post" action="{{route('books.find')}}">
                                @csrf
                                <div class="mb-3">
                                    <label>Find by text:</label>
                                    <input class="form-control" name="name" type="text" value="{{$findBook}}">
                                </div>
                                <button class="btn btn-success">Find</button>
                            </form>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Pages</th>
                                <th>ISBN</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>
                                        @if($book->photo!=null)
                                            <img src="{{route('image.bookImage', $book->id)}}" style="width: 300px;">
                                        @endif
                                    </td>
                                    <td>{{$book->name}}</td>
                                    <td>{{$book->description}}</td>
                                    <td>{{$book->category->category_name}}</td>
                                    <td>{{$book->pages}}</td>
                                    <td>{{$book->ISBN}}</td>
                                    @can('canEdit')
                                        <td>
                                            <a href="{{route('books.edit', $book->id)}}"
                                               class="btn btn-success">Edit</a>
                                        </td>
                                    @endcan
                                    <td>
                                        @can('canEdit')
                                            <form method="post" action="{{route('books.destroy', $book->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('reader')
                                            @if($orders->where('user_id'. Auth::user()->id)->where('book_id', $book->id)->isEmpty())
                                                <form action="{{route('reserve', $book->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="reserved">
                                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                    <input type="hidden" name="book_id" value="{{$book->id}}">
                                                    <button class="btn btn-info">Reserve</button>
                                                </form>
                                            @else
                                                <p>Book Reserved!</p>
                                            @endif
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


