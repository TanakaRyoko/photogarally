@extends('layouts.app')

@section('content')
<div class="container">
    
    <h2>Create new album</h2>
    
    <form method="post" action="{{ route('album-store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" name="description" id="description" placeholder="Enter description">
      </div>
      <div class="form-group">
        <label for="cover_image">Cover image</label>
        <input type="file" class="form-control" name="cover_image" id="cover_image">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
