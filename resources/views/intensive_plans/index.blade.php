@extends('admin.layouts.main')
@section('main-section')
<style>
    .main-content{
        margin-top: 5rem !important;
        margin-left:18rem !important;
    }
</style>
<div class="main-content">
    <h2>Intensive Plans</h2>
    <a href="{{ route('intensive_plans.create') }}" class="btn btn-success">Add New Plan</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Detail</th>
                <th>No of Class</th>
                <th>Plan Amount</th>
                <th>Admin Amount</th>
                <th>Instructor Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
            <tr>
                <td>{{ $plan->name }}</td>
                <td>{{ $plan->detail }}</td>
                <td>{{ $plan->no_of_class }}</td>
                <td>£{{ $plan->rate }}</td>
                <td>£{{ $plan->admin_amount }}</td>
                <td>£{{ $plan->driver_amount }}</td>
                <td>
                    <a href="{{ route('intensive_plans.edit', $plan->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('intensive_plans.destroy', $plan->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
