@extends('layouts.page')

@section('title', 'Update Manufacturer: ' . $manufacturer->name)

@section('content_header')
    <h1>Update Manufacturer: {{ $manufacturer->name }}</h1>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12 col-md-4 mx-auto justify-content-center">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form id="update" action="{{ route('manufacturers.update', $manufacturer->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label>Manufacturer Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$manufacturer->name}}" placeholder="Manufacturer Name" required>
          </div>
          <div class="form-group">
              <label>Manufacturer Website</label>
              <input type="text" class="form-control" id="website" name="website" value="{{$manufacturer->website}}" placeholder="Manufacturer Website" required>
          </div>
          <div class="form-group float-right">
            <a href="{{ route('manufacturers.index') }}" class="btn btn-info mr-2">Back</a>
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

    Swal.fire({
        title: 'Are you sure?',
        text: "To update this manufacturer?",
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
})
</script>
@stop
