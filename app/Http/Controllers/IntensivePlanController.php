<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntensivePlan;

class IntensivePlanController extends Controller {
    
    public function index() {
        $plans = IntensivePlan::all();
        return view('intensive_plans.index', compact('plans'));
    }

    public function create() {
        return view('intensive_plans.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'no_of_class' => 'required|integer',
            'rate' => 'required|numeric',
            'admin_amount' => 'required|numeric',
            'driver_amount' => 'required|numeric',
            
        ]);

        IntensivePlan::create($request->all());
        return redirect()->route('intensive_plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(IntensivePlan $intensive_plan) {
        return view('intensive_plans.edit', compact('intensive_plan'));
    }

    public function update(Request $request, IntensivePlan $intensive_plan) {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'no_of_class' => 'required|integer',
            'rate' => 'required|numeric',
        ]);

        $intensive_plan->update($request->all());
        return redirect()->route('intensive_plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(IntensivePlan $intensive_plan) {
        $intensive_plan->delete();
        return redirect()->route('intensive_plans.index')->with('success', 'Plan deleted successfully.');
    }
}
