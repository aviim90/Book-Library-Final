@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5 mb-5">
                <div class="card">
                    <div class="card-header"> My Reservation List </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Book Name</th>
                                <th>Status</th>
                                @can('edit')
                                    <th>Reader</th>
                                @endcan
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($orders as $order)
                                    <td> {{ $order->book->name }}  </td>
                                    <td> {{ $order->status}}  </td>
                                    @can('edit')
                                        <td> {{ $order->user->name}}</td>
                                    @endcan
                                    <td>
                                        @if ($order->status == 'reserved' )
                                            <form action="{{ route('cancel', $order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="book_id" value="{{$order->book_id}}">
                                                <button class="btn btn-info">Cancel</button>
                                            </form>
                                        @endif
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
