@extends('layouts.page')

@section('title', 'Create Model')

@section('content_header')
    <h1>Create Model</h1>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12 col-md-6 mx-auto justify-content-center">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form id="create" action="{{ route('models.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>Manufacturer</label>
            <a href="{{ route('manufacturers.create') }}" target="_blank" class="btn btn-sm btn-info float-right"> + </a>
            <select class="form-control selectpicker"  id="manufacturer_id" name="manufacturer_id" data-live-search="true" style="width: 100%;" required>
                <option disabled selected="selected" value="">Select Manufacturer</option>
                @php
                foreach ($manufacturers as $manufacturer) {
                    echo '<option value="'. $manufacturer->id .'">'.$manufacturer->name.'</option>';
                }
                @endphp
              </select>
          </div>
          <div class="form-group">
              <label>Model Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Model Name" required>
          </div>
          <div class="form-group">
              <label>Model Number</label>
              <input type="text" class="form-control" id="number" name="number" placeholder="Model Number" required>
          </div>
          <div class="form-group">
              <label>Category</label>
              <a href="{{ route('categories.create') }}" target="_blank" class="btn btn-sm btn-info float-right"> + </a>
              <select class="form-control selectpicker"  id="category_id" name="category_id" data-live-search="true" style="width: 100%;" required>
                  <option disabled selected="selected" value="">Select Category</option>
                  @php
                  foreach ($categories as $category) {
                      echo '<option value="'. $category->id .'">'.$category->name.'</option>';
                  }
                  @endphp
                </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary float-right btn-add">Add Model</button>
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
$('.btn-add').click(function(e){
  e.preventDefault();

  if($('#manufacturer_id').val() && $('#category_id').val() && $('#name').val() && $('#number').val()) {
      Swal.fire({
        title: 'Are you sure?',
        text: "To add this asset model?",
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
