@extends('layouts.page')

@section('title', 'Update Category: ' . $category->name)

@section('content_header')
    <h1>Update Category: {{ $category->name }}</h1>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12 col-md-4 mx-auto justify-content-center">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form id="update" action="{{ route('categories.update', $category->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label>Category Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="Category Name">
          </div>
          <div class="form-group float-right">
            <a href="{{ route('categories.index') }}" class="btn btn-info mr-2">Back</a>
            <button type="submit" class="btn btn-primary btn-update">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>  
</div>
@stop

{{-- Custom CSS --}}
@section('css')
@stop

{{-- Custom Javascript --}}
@section('js')
<script>
$('.btn-update').click(function(e){
    e.preventDefault();

  if($('#name').val()) {
      Swal.fire({
        title: 'Are you sure?',
        text: "To update this category?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result)=>{
        if(result.isConfirmed){
            $('form#'+this.form.id).submit();
        }
      })
  } else {
      Swal.fire({
          title: 'Error!',
          text: 'Please fill up all the fields.',
          icon: 'error',
          confirmButtonText: 'OK'
      })
  }
})
</script>
@stop
