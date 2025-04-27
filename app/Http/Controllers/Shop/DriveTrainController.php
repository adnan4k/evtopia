<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DriveTrain;


class DriveTrainController extends Controller
{
    public function __construct(private DriveTrain $drivetrain)
    {
        // You can initialize or use $drivetrain here if needed
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivetrains = $this->drivetrain->latest()->paginate(10);

        return view('shop.drivetrain.index', compact('drivetrains'));
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
            'name' => 'required|unique:drive_trains',
        ]);

        $drivetrain = $this->drivetrain->create([
            'name' => $request->name,
        ]);

        return redirect()->route('shop.drive_train.index')->with('success', 'Power Train created successfully');
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
            'name' => 'required|unique:drive_trains,name,' . $id,
        ]);

        $drivetrain = $this->drivetrain->find($id);
        $drivetrain->update([
            'name' => $request->name,
        ]);

        return redirect()->route('shop.drive_train.index')->with('success', 'Power Train updated successfully');
    }


    public function statusToggle( $id)
    {
        $unit = $this->drivetrain->find($id);
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
        $drivetrain = $this->drivetrain->find($id);
        $drivetrain->delete();

        return redirect()->route('shop.drive_train.index')->with('success', 'Power Train deleted successfully');
    }
}
