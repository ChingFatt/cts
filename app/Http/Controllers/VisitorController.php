<?php

namespace App\Http\Controllers;

use App\Occupant;
use App\Visitor;
use App\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::orderBy('visit_end')
            ->orderBy('visit_start', 'desc')
            ->paginate();
            
        $units = Unit::has('occupants')->pluck('unit_number', 'id');

        return view('visitor.index')->with(compact('visitors', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existing_visitor = Visitor::where('contact', $request->contact)
            ->where('nric', $request->nric)
            ->whereNull('visit_end')
            ->get();

        $existing_occupant = Occupant::where('contact', $request->contact)
            ->orWhere('nric', $request->nric)
            ->get();

        if (count($existing_visitor) > 0 || count($existing_occupant) > 0) {
            toastr()->warning('You are not authorized to visit this unit.', 'Warning');
            return redirect()->route('home');
        } else {
            $visitors = Visitor::where('unit_id', $request->unit_id)
                ->where('visit_end', null)
                ->count();

            if ($visitors >= 5) {
                toastr()->warning('This unit having 5 visitors at the moment.', 'You are not allow to visit');
                return redirect()->route('home');
            }

            $request->merge([
                'codes' => Str::random(32),
                'visit_start' => Carbon::now()
            ]);
            $visitor = Visitor::create($request->all());
            toastr()->success('You are authorized to visit now.', 'Success');
            return redirect()->route('visitor.visiting', $visitor->codes);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        $request->merge([
            'visit_end' => Carbon::now()
        ]);
        $visitor->update($request->except('_method', '_token'));
        toastr()->success('Successfully check out. Please stay safe.', 'Success');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }

    public function visiting(Visitor $visitor, $codes)
    {
        $visitor = Visitor::where('codes', $codes)
            ->whereNull('visit_end')
            ->first();

        if (empty($visitor)) {
            toastr()->warning('Invalid visiting.', 'Warning');
            return redirect()->route('home');
        } else {
            $visitors = Visitor::where('unit_id', $visitor->unit_id)
            ->where('codes', '!=', $visitor->codes)
            ->whereNull('visit_end')
            ->count();

            return view('visitor.visiting')->with(compact('visitor', 'visitors'));
        }
    }

    public function form()
    {
        $units = Unit::has('occupants')->pluck('unit_number', 'id');
        return view('visitor.form')->with(compact('units'));
    }

    public function checkout(Request $request, Visitor $visitor)
    {
        $request->merge([
            'visit_end' => Carbon::now()
        ]);
        $visitor->update($request->except('_method', '_token'));
        toastr()->success('Successfully check out. Please stay safe.', 'Success');
        return redirect()->route('visitor.index');
    }

    public function checkin(Request $request)
    {
        $existing_visitor = Visitor::where('contact', $request->contact)
            ->where('nric', $request->nric)
            ->whereNull('visit_end')
            ->get();

        $existing_occupant = Occupant::where('contact', $request->contact)
            ->orWhere('nric', $request->nric)
            ->get();

        if (count($existing_visitor) > 0 || count($existing_occupant) > 0) {
            toastr()->warning('You are not authorized to visit this unit.', 'Warning');
            return redirect()->route('visitor.index');
        } else {
            $visitors = Visitor::where('unit_id', $request->unit_id)
                ->where('visit_end', null)
                ->count();

            if ($visitors >= 5) {
                toastr()->warning('This unit having 5 visitors at the moment.', 'You are not allow to visit');
                return redirect()->route('visitor.index');
            }

            $request->merge([
                'codes' => Str::random(32),
                'visit_start' => Carbon::now()
            ]);
            $visitor = Visitor::create($request->all());
            toastr()->success('You are authorized to visit now.', 'Success');
            return redirect()->route('visitor.index');
        }
    }
}
