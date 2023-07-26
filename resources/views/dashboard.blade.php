@extends('layouts.page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-list"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Assets</span>
          <span class="info-box-number">
          {{$totalCount['assets']}}
          </span>
        </div>
      </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-black elevation-1"><i class="fa-solid fa-arrow-right-arrow-left"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Requests</span>
          <span class="info-box-number">
           {{$totalCount['assets']}}
          </span>
        </div>
      </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-primary elevation-1"><i class="fa-solid fa-list"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Asset Models</span>
          <span class="info-box-number">
           {{$totalCount['models']}}
          </span>
        </div>
      </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-hashtag"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Categories</span>
          <span class="info-box-number">
           {{$totalCount['categories']}}
          </span>
        </div>
      </div>
  </div>
</div>

<div class="row">
    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <div class="card-title">
            My Assets
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
</script>
@stop
