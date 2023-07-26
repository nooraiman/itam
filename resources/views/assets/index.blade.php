@extends('layouts.page')

@section('title', 'Asset List')

@section('content_header')
    <h1>Asset List</h1>
@stop


@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <div class="card-title">
            <a href="{{ url()->route('assets.create') }}" target="_blank" class="btn btn-primary">Add Asset</a>
          </div>
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table id="list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Asset Name</th>
                  <th>Serial Number</th>
                  <th>Asset Model</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Assigned To</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($assets as $asset)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->serial_number }}</td>
                    <td>{{ $asset->assetModel->manufacturer->name }} {{ $asset->assetModel->name }} {{ $asset->assetModel->number }}</td>
                    <td>{{ $asset->assetModel->category->name }}</td>
                    <td>
                    {{ $asset->getStatus() }}
                    </td>
                    <td>
                    {{ $asset->assignedTo ? $asset->assignedTo->name : '' }}
                    </td>
                    <td>
                      <form id="{{ $asset->id }}" action="{{ route('assets.destroy', $asset->id) }}" method="POST">
                          <a href="{{ route('assets.show', $asset->id) }}" target="" class="btn btn-info btn-sm"  title="View Asset"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      <a href="{{ route('assets.edit', $asset->id) }}"  target="" class="btn btn-primary btn-sm"  title="Edit Asset"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i></a>
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-sm btn-danger btn-remove" title="Delete Asset"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
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
        text: "To remove this asset?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result)=>{
        if(result){
            $('form#'+this.form.id).submit();
        }
    })
})
</script>
@stop
