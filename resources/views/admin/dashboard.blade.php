{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1>Admin Dashboard</h1>

    <div class="placeholder-box" style="margin-bottom: 20px;">
        <h2>Announcements</h2>
        <p>Manage all announcements from here. <a href="{{ route('admin.announcements.index') }}">View Announcements</a></p>
    </div>

    <div class="placeholder-box" style="margin-bottom: 20px;">
        <h2>All Requests</h2>
        <p>View and manage all requests submitted by residents. <a href="{{ route('admin.all_requests') }}">View Requests</a></p>
    </div>

    <div class="placeholder-box">
        <h2>Create Announcement</h2>
        <p>Quickly create a new announcement. <a href="{{ route('admin.announcements.create') }}">Create Now</a></p>
    </div>
@endsection
