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
    @if (session()->has('error'))
        <div class="alert-warning" role="alert">
            <p class="warning">
                <span>{{ session()->get('error') }}</span><span><a href="{{ url('/salesrep/edit/'.Session::get('duplicate_client')) }}" target="_blank">{{ Session::get('duplicate_client_name') }}</a></span>
            </p>
        </div>
    @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Sales Team</h1></div>
                <div class="card-body">
                    <div class="align-items-right mb-3">
                        <a class="btn btn-primary" href="{{ route('salesrep.create') }}">Create Sales Rep</a>
                        <a class="btn btn-secondary" href="{{ route('routes.create') }}">Create Sales Area Route</a>
                    </div>
                    <table class="table table-striped table-inverse">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Currrent Route</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($salesReps as $item)
                                <tr>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->telephone }}</td>
                                    <td>{{ $item->working_routes }}</td>
                                    <td class="actions"><button class="btn-show" id="myBtn" href="#" data-modal-id="popup-show"
                                        data-fname="{{ $item->first_name }}"
                                        data-lname="{{ $item->last_name }}"
                                        data-email="{{ $item->email }}"
                                        data-route="{{ $item->working_routes }}"
                                        data-jdate="{{ $item->joined_date }}"
                                        data-comment="{{ $item->comments }}">View</button>
                                    <td>
                                        |
                                        <a href="{{ route('salesrep.edit',$item->id) }}">Edit</a> 
                                        |
                                        <a href="{{ route('salesrep.delete',$item->id) }}">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade myModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sales Representative Info</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <a href="#" class="btn btn-small js-modal-close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                        <strong><h4>Name: <span class="modal-fname"></span> <span class="modal-lname"></span></h4></strong>
                        <p>
                            <strong>Email: </strong><span class="modal-email"></span><br />
                            <strong>Route No: </strong><span class="modal-route"></span><br />
                            <strong>Joined date: </strong><span class="modal-jdate"></span><br />
                            <strong>Manager Comment: </strong><span class="modal-comment"></span><br />
                        </p>
                        <p>
                            <span class="modal-note"></span><br />
                        </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection