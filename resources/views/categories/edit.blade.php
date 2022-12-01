@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        <form method="POST" action="{{isset($category)?route('categories.update',$category->id):route('categories.store')}}">
                            @csrf
                            @if(isset($category))
                                @method('put')
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input class="form-control" type="text" name="category_name" value="{{isset($category)?$category->category_name:''}}">
                            </div>
                            <button type="submit" class="btn btn-success"> {{isset($category)?'Save':'Add'}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



