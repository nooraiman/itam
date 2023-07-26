@extends('layouts.page')

@section('title', 'Model: ' . $model->name . ' ' . $model->number)

@section('content_header')
    <h1>Model: {{ $model->name }} {{ $model->number }} </h1>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12 col-md-6 mx-auto justify-content-center">
    <div class="card card-outline card-primary">
      <div class="card-body">
          <div class="form-group">
              <label>Model Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Model Name" value="{{$model->name}}" readonly>
          </div>
          <div class="form-group">
              <label>Model Number</label>
              <input type="text" class="form-control" id="number" name="number" placeholder="Model Number" value="{{$model->number}}" readonly>
          </div>
          <div class="form-group">
              <label>Category</label>
              <input type="text" class="form-control" value="{{$model->category->name}}" readonly> 
          </div>
          <div class="form-group">
            <a href="{{ route('models.index') }}" class="btn btn-info float-right">Back</a>
          </div>
      </div>
    </div>
  </div>  
</div>
@stop

{{-- Custom CSS --}}
@section('css')
<style>

</style>
@stop

{{-- Custom Javascript --}}
@section('js')
<script>
$('#list').DataTable({
  "responsive": false,
  "scollX": true
})
</script>
@stop
