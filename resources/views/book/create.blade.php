@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2>New Book</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('b_store')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Price</span>
                            <input type="text" name="price" class="form-control" value="{{old('price')}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Release date</span>
                            <input type="text" name="release" class="form-control" value="{{old('release')}}">
                        </div>
                        <select name="author_id" class="form-select mt-3">
                            <option value="0">Choose Author</option>
                            @foreach($authors as $author)
                            <option value="{{$author->id}}" @if($author->id == old('author_id')) selected @endif>{{$author->title}}</option>
                            @endforeach
                        </select>
                        <div data-clone class="input-group mt-3">
                            <span class="input-group-text">Photo</span>
                            <input type="file" name="photo[]" multiple class="form-control">
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-secondary mt-4">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection