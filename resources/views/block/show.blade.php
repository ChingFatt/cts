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
                                {{ $block->title }}
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('block.index') }}" class="mr-4">Back</a>
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm">Create Unit</a>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover card-table bg-white">
                        <thead>
                            <tr>
                                <th>Unit Number</th>
                                <th>No. of Occupants</th>
                                <th>No. of Visits</th>
                            </tr>
                        </thead>
                        @isset ($block->units)
                        <tbody>
                            @foreach ($block->units as $unit)
                            <tr>
                                <td>
                                    <a href="{{ route('unit.show', $unit) }}">{{ $unit->unit_number }}</a>
                                </td>
                                <td>
                                    {{ $unit->occupants->count() }}
                                </td>
                                <td>
                                    {{ $unit->visitors->count() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endisset
                    </table>
                </div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::open(['route' => 'unit.store', 'method' => 'post', 'files' => true, 'class' => 'modal-content']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group required">
                        <label>Unit Number</label>
                        {{ Form::hidden('block_id', $block->id) }}
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