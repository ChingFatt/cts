@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Blocks
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm">Create</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover card-table bg-white">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>No. of Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blocks as $block)
                            <tr>
                                <td>
                                    <a href="{{ route('block.show', $block) }}">{{ $block->title }}</a>
                                </td>
                                <td>
                                    {{ $block->units->count() }}
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
            {!! Form::open(['route' => 'block.store', 'method' => 'post', 'files' => true, 'class' => 'modal-content']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group required">
                        <label>Block Title</label>
                        {{ Form::text('title', null, ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) }}
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
