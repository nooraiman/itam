@extends('layouts.page')

@section('title', 'Update Asset: ' . $asset->name . ' ' . $asset->tag)

@section('content_header')
    <h1>Update Asset: {{ $asset->name }} {{ $asset->tag }} </h1>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12 col-md-6 mx-auto justify-content-center">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <form id="update" action="{{{ route('assets.update', $asset->id)}}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label>Asset Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $asset->name }}" placeholder="Asset Name" required>
          </div>
          <div class="form-group">
              <label>Asset Tag</label>
              <input type="text" class="form-control" id="tag" name="tag" value="{{ $asset->tag }}" placeholder="Asset Tag" required>
          </div>
          <div class="form-group">
              <label>Serial Number</label>
              <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $asset->serial_number }}" placeholder="Serial Number" required>
          </div>
          <div class="form-group">
              <label>Model</label>
              <a href="{{route('models.create')}}" target="_blank" class="btn btn-sm btn-secondary float-right" title="Add Model"> + </a>
              <select class="form-control selectpicker" name="model_id" id="model_id" data-live-search="true" style="width: 100%;" required>
                  <option selected="selected" value="{{$asset->model_id}}">{{$asset->assetModel->manufacturer->name}} {{$asset->assetModel->name}} {{$asset->assetModel->number}}</option>
                  @php
                  foreach ($models as $model) {
                      echo '<option value="'.$model->id.'">'. $model->manufacturer->name . ' ' .$model->name . ' - ' . $model->number.'</option>';
                  }
                  @endphp
                </select>
          </div>
          <div class="form-group">
              <label>Status</label>
              <select class="form-control selectpicker" id="status" name="status" data-live-search="true" style="width: 100%;">
                    <option readonly selected="selected" value="{{$asset->status}}">{{$asset->getStatus()}}</option>
                    <option value="1">Available</option>
                    <option value="2">Assigned</option>
                    <option value="3">Maintenance</option>
                    <option value="4">Defective</option>
                    <option value="5">Retired</option>
                </select>
          </div>
            <div class="form-group assignedTo" style="display: none">
                <label>Assigned To</label>
                <select class="form-control selectpicker" id="assigned_to" name="assigned_to" data-live-search="true" style="width: 100%;">
                    <option selected="selected" value="">Select User</option>
                    @php
                    foreach ($users as $user) {
                    echo '<option value="'.$user->id.'">'. $user->name . '</option>';
                    }
                    @endphp
                </select>
            </div>
          <div class="form-group float-right">
            <a href="{{ route('assets.index') }}" class="btn btn-info mr-2">Back</a>
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
// Remove duplicate option
var opt = [];
var opt2 = [];
$("#model_id > option").each(function () {
    if(opt[$(this).val()]) {
        $(this).remove();
    } else {
        opt[$(this).val()] = $(this).text();
    }
});

$("#status_id > option").each(function () {
    if(opt2[$(this).val()]) {
        $(this).remove();
    } else {
        opt2[$(this).val()] = $(this).text();
    }
});

$('#status').change(function() {
    if($(this).val() == 2) {
        $('.assignedTo').show();
        $('#assigned_to').selectpicker('refresh');
    } else {
        $('.assignedTo').hide();
        $('#assigned_to').val('');
        $('#assigned_to').selectpicker('refresh');
    }
})

$('.btn-update').click(function(e){
    e.preventDefault();

    if($('#name').val() && $('#tag').val() && $('#serial_number').val() && $('#model_id').val() && $('#status').val()) {

        if($('#status').val() == 2 && $('#assigned_to').val() == null) {
            Swal.fire({
                title: 'Error!',
                text: 'Please select user.',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }

        Swal.fire({
        title: 'Are you sure?',
        text: "To update this asset?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
        })
        .then((result)=>{
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
