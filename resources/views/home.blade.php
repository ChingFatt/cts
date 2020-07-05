@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                {!! Form::open(['route' => 'visitor.store', 'method' => 'post', 'files' => true]) !!}
                <div class="card">
                    <div class="card-header">
                        Visitor Form
                    </div>
                    <div class="card-body">
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
                </div>
                <div class="justify-content-center">
                    <button type="submit" class="btn btn-sm btn-success font-weight-bold w-100 d-block p-2 text-uppercase rounded-pill">
                        <h5 class="mb-0">Check In</h5>
                    </button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection
