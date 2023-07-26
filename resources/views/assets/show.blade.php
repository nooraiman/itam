@extends('layouts.page')

@section('title', 'Asset: ' . $asset->name . ' ' . $asset->tag)

@section('content_header')
    <h1>Asset: {{ $asset->name }} {{ $asset->tag }} </h1>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12 col-md-6 mx-auto justify-content-center">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="form-group">
          <label>Asset Name</label>
          <input type="text" class="form-control" value="{{ $asset->name }}" readonly>
        </div>
        <div class="form-group">
            <label>Asset Tag</label>
            <input type="text" class="form-control" value="{{ $asset->tag }}" readonly>
        </div>
        <div class="form-group">
            <label>Serial Number</label>
            <input type="text" class="form-control" value="{{ $asset->serial_number }}" readonly>
        </div>
        <div class="form-group">
            <label>Model</label>
            <input type="text" class="form-control" value="{{ $asset->assetModel->manufacturer->name }} {{ $asset->assetModel->name }} {{ $asset->assetModel->number }}" readonly>
        </div>
        <div class="form-group">
            <label>Status</label>
            <input type="text" class="form-control" value="{{ $asset->getStatus() }}" readonly>
        </div>
        <div class="form-group">
          <a href="{{ route('assets.index') }}" class="btn btn-info float-right">Back</a>
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

@stop
