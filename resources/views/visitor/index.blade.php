@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Visitors
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm">Create</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover card-table bg-white">
                        <thead>
                            <tr>
                                <th>Visitor</th>
                                <th>Contact</th>
                                <th>NRIC</th>
                                <th>Visiting Units</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $visitor)
                            <tr>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->contact }}</td>
                                <td>{{ $visitor->nric }}</td>
                                <td>{{ $visitor->unit->unit_number }}</td>
                                <td>{{ $visitor->visit_start }}</td>
                                <td>
                                    @isset($visitor->visit_end)
                                    {{ $visitor->visit_end }}
                                    @else
                                    {!! Form::model($visitor, ['route' => ['visitor.checkout', $visitor], 'method' => 'put', 'files' => true]) !!}
                                    <div class="justify-content-center">
                                        <button type="submit" class="btn btn-sm btn-success text-uppercase shadow-sm">
                                            Check Out
                                        </button>
                                    </div>
                                    {{ Form::close() }}
                                    @endisset
                                </td>
                                <td>
                                    @isset ($visitor->visit_end)
                                    <span class="text-danger">Visited</span>
                                    @else
                                    <span class="text-success">Visiting</span>
                                    @endisset
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::open(['route' => 'visitor.checkin', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group required">
                        <label>Name</label>
                        {{ Form::text('name', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
                    </div>
                    <div class="col-md-12 form-group required">
                        <label>Contact Number</label>
                        {{ Form::text('contact', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
                    </div>
                    <div class="col-md-12 form-group required">
                        <label>Last 3 Digit of NRIC</label>
                        {{ Form::text('nric', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Visiting Unit</label>
                        {{ Form::select('unit_id', $units, null, ['class' => 'form-control custom-select', 'required' => true, 'autocomplete' => 'off', 'placeholder' => '- Please Select -', 'id' => 'unit']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-success">Save</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
