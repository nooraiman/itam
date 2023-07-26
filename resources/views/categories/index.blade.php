@extends('layouts.page')

@section('title', 'Categories')

@section('content_header')
<div>
    <h1>Categories</h1>
</div>  
@stop


@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <div class="card-title">
            <a href="{{ url()->route('categories.create') }}" target="_blank" class="btn btn-primary">Add Category</a>
          </div>
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table id="list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 5%">#</th>
                  <th>Name</th>
                  <th style="width: 15%">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form id="{{$category->id}}" action="{{ route('categories.destroy', $category->id) }}" method="POST">
    
                            <a href="{{ route('categories.edit',$category->id) }}"  target="" class="btn btn-primary btn-sm"  title="Edit Category"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i></button></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-remove" title="Delete Category"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
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
          text: "To remove this category?",
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
