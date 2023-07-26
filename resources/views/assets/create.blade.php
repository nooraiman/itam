@extends('layouts.page')

@section('title', 'Create Asset')

@section('content_header')
<h1>Create Asset</h1>
@stop


@section('content')
<div class="row">
    <div class="col-sm-12 col-md-6 mx-auto justify-content-center">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form id="create" action="{{{ route('assets.store')}}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>Asset Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Asset Name">
                    </div>
                    <div class="form-group">
                        <label>Asset Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag" placeholder="Asset Tag">
                    </div>
                    <div class="form-group">
                        <label>Serial Number</label>
                        <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Serial Number">
                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <a href="{{route('models.create')}}" target="_blank" class="btn btn-sm btn-secondary float-right" title="Add Model"> + </a>
                        <select class="form-control selectpicker" id="model_id" name="model_id" data-live-search="true" style="width: 100%;">
                            <option disabled selected="selected" value="">Select Asset Model</option>
                            @php
                            foreach ($models as $model) {
                            echo '<option value="'.$model->id.'">'. $model->manufacturer->name . ' ' .$model->name . ' - ' . $model->number.'</option>';
                            }
                            @endphp
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control selectpicker" name="status" id="status" data-live-search="true" style="width: 100%;">
                            <option disabled readonly selected="selected" value="">Select Status</option>
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
                    <div class="form-group">
                        <button type="submit" id="btn-submit" class="btn btn-primary btn-add float-right">Add Asset</button>
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

$('#status').change(function() {
    if($(this).val() == 2) {
        $('.assignedTo').show();
    } else {
        $('.assignedTo').hide();
        $('#assigned_to').val(null);
        $('#assigned_to').selectpicker('refresh');
    }
})

$('.btn-add').click(function(e) {
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
    text: "To add this asset?",
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
