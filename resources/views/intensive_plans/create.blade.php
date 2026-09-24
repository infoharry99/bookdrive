@extends('admin.layouts.main')
@section('main-section')

<style>
    .main-content{
        margin-top: 5rem !important;
        margin-left:18rem !important;
    }
</style>

<div class="main-content" >
    <h2>Create Intensive Plan</h2>
    <form action="{{ route('intensive_plans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div>
            <label>Category</label>
            <select name="category" class="form-control" required>
                <option value="manual"}>Manual</option>
                <option value="automatic">Automatic</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Detail</label>
            <textarea name="detail" class="form-control" required></textarea>
        </div>
        
        <div class="mb-3">
            <label>No of Class</label>
            <input type="number" name="no_of_class" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Plan Amount</label>
            <input type="number" step="0.01" name="rate" class="form-control" required>
        </div>
         <div class="mb-3">
            <label>Admin  Amount</label>
            <input type="number" step="0.01" name="admin_amount" class="form-control" required>
        </div>
         <div class="mb-3">
            <label>Instructor Amount</label>
            <input type="number" step="0.01" name="driver_amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
