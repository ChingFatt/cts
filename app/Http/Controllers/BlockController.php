<?php

namespace App\Http\Controllers;

use App\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = Block::latest()->paginate();
        
        return view('block.index')->with(compact('blocks'));
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
        $block = Block::create($request->all());
        return redirect()->route('block.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BLock $block
     * @return \Illuminate\Http\Response
     */
    public function show(BLock $block)
    {
        $block = Block::with('units')
            ->where('id', $block->id)
            ->first();
        return view('block.show')->with(compact('block'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BLock $block
     * @return \Illuminate\Http\Response
     */
    public function edit(BLock $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BLock $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BLock $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BLock $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(BLock $block)
    {
        //
    }

    public function get_units(Request $request)
    {
        
    }
}
