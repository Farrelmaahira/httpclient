@extends('layouts.app')

@section('content')
    <div class="container">
        <a href=" {{ route('home') }} ">Back</a>
        <form action=" {{ route('update', $res['id']) }} " method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Title"
                    value=" {{ $res['title'] }} ">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Author</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="author" placeholder="Author"
                    value=" {{ $res['author'] }} ">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"> {{ $res['description'] }} </textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Released</label>
                <input type="date" class="form-control" name="released" id="released">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <img src=" {{ $res['image'] }} " height="200" width="200">
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </div>
@endsection
