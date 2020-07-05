@extends('layouts.app')

@section('content')
<section class="py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                {{ $unit->unit_number }}
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('block.show', $unit->block_id) }}" class="mr-4">Back</a>
                                <a href="#" data-toggle="modal" data-target="#exampleModal2" class="btn btn-secondary btn-sm">Edit Unit</a>
                                <form method="POST" class="d-inline mr-1" action="{{ route('unit.destroy', $unit) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                {{ Form::hidden('block_id', $unit->block_id) }}
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm">Create Occupant</a>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover card-table bg-white">
                        <thead>
                            <tr>
                                <th>Occupants</th>
                                <th>Contact</th>
                                <th>NRIC</th>
                            </tr>
                        </thead>
                        @isset ($unit->occupants)
                        <tbody>
                            @foreach ($unit->occupants as $occupant)
                            <tr>
                                <td>
                                    {{ $occupant->name }}
                                </td>
                                <td>
                                    {{ $occupant->contact }}
                                </td>
                                <td>
                                    {{ $occupant->nric }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endisset
                    </table>
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
                            @foreach ($unit->visitors as $visitor)
                            <tr>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->contact }}</td>
                                <td>{{ $visitor->nric }}</td>
                                <td>{{ $visitor->unit->unit_number }}</td>
                                <td>{{ $visitor->visit_start }}</td>
                                <td>{{ $visitor->visit_end }}</td>
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
            {!! Form::open(['route' => 'occupant.store', 'method' => 'post', 'files' => true, 'class' => 'modal-content']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Occupant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group required">
                        <label>Name</label>
                        {{ Form::hidden('unit_id', $unit->id) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
                    </div>
                    <div class="col-md-6 form-group required">
                        <label>Contact</label>
                        {{ Form::text('contact', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
                    </div>
                    <div class="col-md-6 form-group required">
                        <label>Last 3 Digit of NRIC</label>
                        {{ Form::text('nric', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
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
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::model($unit, ['route' => ['unit.update', $unit], 'method' => 'put', 'files' => true]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group required">
                        <label>Unit Number</label>
                        {{ Form::text('unit_number', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
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