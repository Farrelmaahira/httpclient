@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (\Session::has('message'))
                    <div class="alert alert-danger">
                        {!! \Session::get('message') !!}
                    </div>
                @endif
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Input
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Input</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action=" {{ route('input') }} " method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Author" name="author">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Released</label>
                                        <input type="date" class="form-control" name="released">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Released</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($response->get('data') as $data)
                            <tr>
                                <td> </td>
                                <td> {{ $data['title'] }} </td>
                                <td> {{ $data['author'] }} </td>
                                <td> {{ $data['description'] }} </td>
                                <td> {{ $data['released'] }} </td>
                                <td> <img src="{{ $data['image'] }}" alt="pict" width="100" height="100"> </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <form action=" {{ route('delete', $data['id']) }} " method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <a href=" {{ route('edit', $data['id']) }} ">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
