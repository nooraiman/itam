@extends('layouts.page')

@section('title', 'Update Model: ' . $model->name . ' ' . $model->number)

@section('content_header')
    <h1>Update Model: {{ $model->name }} {{ $model->number }} </h1>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12 col-md-6 mx-auto justify-content-center">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form id="update" action="{{ route('models.update', $model->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Manufacturer</label>
            <a href="{{ route('manufacturers.create') }}" target="_blank" class="btn btn-sm btn-info float-right"> + </a>
            <select class="form-control selectpicker"  id="manufacturer_id" name="manufacturer_id" data-live-search="true" style="width: 100%;" required>
                <option selected="selected" value="{{ $model->manufacturer->id}}">{{ $model->manufacturer->name}}</option>
                @php
                foreach ($manufacturers as $manufacturer) {
                    echo '<option value="'. $manufacturer->id .'">'.$manufacturer->name.'</option>';
                }
                @endphp
              </select>
          </div>
          <div class="form-group">
              <label>Model Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$model->name}}" placeholder="Model Name" required>
          </div>
          <div class="form-group">
              <label>Model Number</label>
              <input type="text" class="form-control" id="number" name="number" value="{{$model->number}}" placeholder="Model Number" required>
          </div>
          <div class="form-group">
              <label>Category</label>
              <a href="{{ route('categories.create') }}" target="_blank" class="btn btn-sm btn-info float-right"> + </a>
              <select class="form-control selectpicker"  id="category_id" name="category_id" data-live-search="true" style="width: 100%;" required>
                  <option selected="selected" value="{{ $model->category->id}}">{{ $model->category->name}}</option>
                  @php
                  foreach ($categories as $category) {
                      echo '<option value="'. $category->id .'">'.$category->name.'</option>';
                  }
                  @endphp
                </select>
          </div>
          <div class="form-group float-right">
            <a href="{{ route('models.index') }}" class="btn btn-info mr-2">Back</a>
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
<style>

</style>
@stop

{{-- Custom Javascript --}}
@section('js')
<script>
// Remove duplicate option
var opt = [];
var opt2 = [];
$("#category_id > option").each(function () {
    if(opt[$(this).text()]) {
        $(this).remove();
    } else {
        opt[$(this).text()] = $(this).val();
    }
});

$("#manufacturer_id > option").each(function () {
    if(opt2[$(this).text()]) {
        $(this).remove();
    } else {
        opt2[$(this).text()] = $(this).val();
    }
});

$('.btn-update').click(function(e){
  e.preventDefault();

  if($('#manufacturer_id').val() && $('#category_id').val() && $('#name').val() && $('#number').val()) {
      Swal.fire({
        title: 'Are you sure?',
        text: "To update this asset model?",
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
