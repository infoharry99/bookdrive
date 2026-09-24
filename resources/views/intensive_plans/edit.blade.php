@extends('admin.layouts.main')
@section('main-section')
<style>
    .main-content{
        margin-top: 5rem !important;
        margin-left:18rem !important;
    }
</style>
<div class="main-content">
    <h2>Edit Intensive Plan</h2>
    <form action="{{ route('intensive_plans.update', $intensive_plan->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $intensive_plan->name }}" required>
        </div>
        <div>
                <label>Category</label>
                <select name="category" class="form-control" required>
                    <option value="manual" {{ $intensive_plan->category == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="automatic" {{ $intensive_plan->category == 'automatic' ? 'selected' : '' }}>Automatic</option>
                </select>
        </div>
        
        <div class="mb-3">
            <label>Detail</label>
            <textarea name="detail" class="form-control" required>{{ $intensive_plan->detail }}</textarea>
        </div>
        <div class="mb-3">
            <label>No of Class</label>
            <input type="number" name="no_of_class" class="form-control" value="{{ $intensive_plan->no_of_class }}" required>
        </div>
        <div class="mb-3">
             <label>Plan Amount</label>
            <input type="number" step="0.01" name="rate" class="form-control" value="{{ $intensive_plan->rate }}"  required>
        </div>
         <div class="mb-3">
            <label>Admin  Amount</label>
            <input type="number" step="0.01" name="admin_amount" class="form-control" value="{{ $intensive_plan->admin_amount }}"  required>
        </div>
         <div class="mb-3">
            <label>Instructor Amount</label>
            <input type="number" step="0.01" name="driver_amount" class="form-control" value="{{ $intensive_plan->driver_amount }}"  required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
