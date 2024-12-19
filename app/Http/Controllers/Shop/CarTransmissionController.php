<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarTransmission;

class CarTransmissionController extends Controller
{

    public function __construct(private CarTransmission $transmission)
    {
        // You can initialize or use $transmission here if needed
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transmissions = $this->transmission->latest()->paginate(10);
        return view('shop.transmission.index', compact('transmissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //IMPLEMENT
        $this->validate($request, [
            'name' => 'required|unique:car_transmissions',
        ]);

        $transmission = $this->transmission->create([
            'name' => $request->name,
        ]);

        return redirect()->route('shop.transmission.index')->with('success', 'Drive Train created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //IMPLEMENT

        $this->validate($request, [
            'name' => 'required|unique:car_transmissions,name,' . $id,
        ]);

        $transmission = $this->transmission->find($id);
        $transmission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('shop.transmission.index')->with('success', 'Drive Train updated successfully');
    }


    public function statusToggle( $id)
    {
        $unit = $this->transmission->find($id);
        $unit->update([
            'is_active' => ! $unit->is_active,
        ]);

        return back()->withSuccess(__('Status updated successfully'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $transmission = $this->transmission->find($id);
        $transmission->delete();

        return redirect()->route('shop.transmission.index')->with('success', 'Drive Train deleted successfully');
    }
}
