@extends('layouts.page')

@section('title', 'Model List')

@section('content_header')
    <h1>Model List</h1>
@stop


@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <div class="card-title">
            <a href="{{ url()->route('models.create') }}" target="_blank" class="btn btn-primary">Add Model</a>
          </div>
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table id="list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Manufacturer</th>
                  <th>Model Name</th>
                  <th>Model Number</th>
                  <th>Category</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $model->manufacturer->name }}</td>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->number }}</td>
                    <td>{{ $model->category->name }}</td>
                    <td>
                        <form id="{{$model->id}}" action="{{ route('models.destroy', $model->id) }}" method="POST">
                            <a href="{{ route('models.show',$model->id) }}" target="" class="btn btn-info btn-sm"  title="View Model"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ route('models.edit',$model->id) }}"  target="" class="btn btn-primary btn-sm"  title="Edit Model"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i></button></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-remove" title="Delete Model"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
              @endforeach
              </tbody>
            </table>
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

$('.btn-remove').click(function(e){
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "To remove this model?",
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
