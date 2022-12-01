@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Books</div>

                    <div class="card-body">
                        <form method="POST" action="{{isset($book)?route('books.update',$book->id):route('books.store')}}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($book))
                                @method('put')
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input class="form-control" type="file" name="image" value="{{isset($book)?$book->photo:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" value="{{isset($book)?$book->name:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input class="form-control" type="text" name="description" value="{{isset($book)?$book->description:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{isset($book)&&($category->id==$book->category_id)?'selected':''}}>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pages</label>
                                <input class="form-control" type="number" name="pages" value="{{isset($book)?$book->pages:''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input class="form-control" type="text" name="description" value="{{isset($book)?$book->ISBN:''}}">
                            </div>
                            <button type="submit" class="btn btn-success"> {{isset($book)?'Save':'Add'}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



