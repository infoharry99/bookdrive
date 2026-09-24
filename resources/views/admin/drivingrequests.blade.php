@extends('admin.layouts.main')
@section('main-section')
<div class="main-content">
    <h2>Driving Test Requests</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="page-content">
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle table-nowrap mb-0 users-table"">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name / Business</th>
                            <th>Phone</th>
                            <th>Test Centres</th>
                            <th>Earliest Date</th>
                            <th>Latest Date</th>
                            <th>License Number</th>
                            <th>Theory Number</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->phone }}</td>
                            <td>{{ $request->test_centres }}</td>
                            <td>{{ $request->earliest_date }}</td>
                            <td>{{ $request->latest_date ?? 'N/A' }}</td>
                            <td>{{ $request->license_number }}</td>
                            <td>{{ $request->theory_number ?? 'N/A' }}</td>
                            <td>{{ $request->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
