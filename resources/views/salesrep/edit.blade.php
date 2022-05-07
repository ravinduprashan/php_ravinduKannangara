@extends('layouts.app')

@section('content')
<script>
    $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ isset($salesrep) ? "Edit Sales Rep" : "Create Sales Representative" }}</h2></div>
                <div class="card-body">
                    <div class="align-items-right mb-3">
                        <a class="btn btn-secondary" href="{{ route('salesrep.list') }}">Back to List</a>
                    </div>
                <form id="itemFrom" role="form" method="POST"
                    action="{{ isset($salesrep) ? route('salesrep.update',$salesrep->id) : route('salesrep.create') }}">
                  @csrf
                  @isset($salesrep)
                      @method('PUT')
                  @endisset
  
                  <div class="card-body">

                    <div class="form-group">
                        <label for="first_name" class="col-form-label">First Name<em>*</em></label>
                        @error('first_name')
        <div class="alert alert-danger" style="color: red">{{ $message }}</div>
        @enderror
                        <input type="text" class="form-control" name="first_name" value="{{ $salesrep->first_name ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="col-form-label">Last Name<em>*</em></label>
                        @error('last_name')
        <div class="alert alert-danger" style="color: red">{{ $message }}</div>
        @enderror
                        <input type="text" class="form-control" name="last_name" value="{{ $salesrep->last_name ?? '' }}">
                    </div>
                       
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email<em>*</em></label>
                        @error('email')
        <div class="alert alert-danger" style="color: red">{{ $message }}</div>
        @enderror
                        <input type="email" required class="form-control" name="email" value="{{ $salesrep->email ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="telephone" class="col-form-label">Telephone</label>
                        <input type="number" class="form-control" name="telephone" value="{{ $salesrep->telephone ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="joined_date" class="col-form-label">Joined date</label>
                        <input type="text" required class="form-control datepicker" id="datepicker" name="joined_date" value="{{ isset($salesrep) ? dateSql2Uk($salesrep->joined_date) : ""}}">
                    </div>

                    <div class="form-group">
                        <label for="working_routes" class="col-form-label">Route</label>
                        <select name="working_routes" id="routes" value="{{ $salesrep->working_routes ?? '' }}">
                            <option value="">----- Please select -----</option>
                            @foreach ($routes as $route)
                            {{-- <option value="{{$route->id}}"
                                {{ $route->id == $salesrep->working_routes ? 'selected' : '' }}>{{ $route->name }}
                            </option> --}}
                            <option value="{{$route->id}}">{{ $route->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comments" class="col-form-label">Manager Comments</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="comments" value="{{ $salesrep->comments ?? '' }}"  rows="4"></textarea>
                    </div>
                    
                    <div class="align-items-right mb-3">
                      <button type="submit" class="btn btn-primary mt-4">
                          @isset($salesrep)
                              <i class="fas fa-arrow-circle-up"></i>
                              <span>Update</span>
                          @else
                              <i class="fas fa-plus-circle"></i>
                              <span>Create</span>
                          @endisset
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