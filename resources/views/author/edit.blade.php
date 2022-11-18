@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Author</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('a_edit', $author)}}" method="post">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" name="title" class="form-control" value={{old('title', $author->title)}}>
                        </div>
                        {{-- <div class="input-group mb-3">
                            <span class="input-group-text">Address</span>
                            <input type="text" name="address" class="form-control" value="{{old('address', $author->address)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">City</span>
                            <input type="text" name="city" class="form-control" value="{{old('address', $author->city)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Working Hours</span>
                            <input type="text" name="hours" class="form-control" value="{{old('address', $author->hours)}}">
                        </div> --}}

                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-secondary mt-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
