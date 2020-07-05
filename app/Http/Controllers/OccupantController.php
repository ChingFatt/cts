<?php

namespace App\Http\Controllers;

use App\Occupant;
use Illuminate\Http\Request;

class OccupantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $existing_occupant = Occupant::where('contact', $request->contact)
            ->orWhere('nric', $request->nric)
            ->get();

        if (count($existing_occupant) > 0) {
            toastr()->warning('Occupant is already exist.', 'Warning');
            return redirect()->route('unit.show', $request->unit_id);
        } else {
            $occupant = Occupant::create($request->all());
            toastr()->success('Occupant has been created.', 'Success');
            return redirect()->route('unit.show', $request->unit_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function show(Occupant $occupant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupant $occupant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupant $occupant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupant $occupant)
    {
        //
    }
}
