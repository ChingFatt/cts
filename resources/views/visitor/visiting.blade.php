@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-muted mb-0">Name</label>
                                <div class="font-weight-bold">{{ $visitor->name }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="text-muted mb-0">Contact</label>
                                <div class="font-weight-bold">{{ $visitor->contact }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="text-muted mb-0">NRIC</label>
                                <div class="font-weight-bold">{{ $visitor->nric }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        You are now visiting 
                        <b>{{ $visitor->unit->unit_number }}</b> 
                        since 
                        <b>{{ date('l, d F Y H:i:s A', strtotime($visitor->visit_start)) }}</b> 
                        @if ($visitors > 0)
                        together with another {{ $visitors }} visitor(s).
                        @else
                        .
                        @endif
                    </div>
                </div>
                {!! Form::model($visitor, ['route' => ['visitor.update', $visitor], 'method' => 'put', 'files' => true]) !!}
                <div class="justify-content-center">
                    <button type="submit" class="btn btn-sm btn-success font-weight-bold w-100 d-block p-2 text-uppercase rounded-pill shadow-sm">
                        <h5 class="mb-0">Check Out</h5>
                    </button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection
