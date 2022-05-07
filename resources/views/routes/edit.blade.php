@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            <p class="alert success">
                <span>{{ session()->get('success') }}</span>
            </p>
        </div>
    @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Add Area Routes</h2></div>

                <div class="card-body">
                    <div class="align-items-right mb-3">
                        <a class="btn btn-secondary" href="{{ route('salesrep.list') }}">Back to List</a>
                    </div>
                <form id="itemFrom" role="form" method="POST"
                    action="{{ route('routes.create') }}">
                  @csrf
  
                  <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Route Name<em>*</em></label>
                        @error('name')
                    <div class="alert alert-danger" style="color: red">{{ $message }}</div>
                    @enderror
                        <input type="text" class="form-control" name="name" value="{{ $salesrep->first_name ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="area" class="col-form-label">Route Area<em>*</em></label>
                        @error('area')
                    <div class="alert alert-danger" style="color: red">{{ $message }}</div>
                    @enderror
                        <input type="text" class="form-control" name="area" value="{{ $salesrep->last_name ?? '' }}">
                    </div>

                    <div class="align-items-right mb-3">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fas fa-plus-circle"></i>
                            <span>Create</span>
                    </button>
                    </div>
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection