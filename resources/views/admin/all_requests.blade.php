@extends('layouts.admin')

@section('content')
<h1>All Requests</h1>

@if(session('success'))
    <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
@endif

<div style="max-height: 600px; overflow-y: auto;">
    @foreach($requests->groupBy('user_id') as $userId => $userRequests)
        <div style="margin-bottom: 30px;">
            <h2>User: {{ $userRequests->first()->user->name }} ({{ $userRequests->first()->user->email }})</h2>
            @foreach($userRequests as $req)
                <div style="background-color:#fff; padding:15px; margin-bottom:10px; border-radius:8px; box-shadow:0 0 5px rgba(0,0,0,0.1);">
                    <h3>Purpose: {{ $req->purpose }}</h3>
                    <p>{{ $req->message }}</p>
                    <div style="margin-bottom:10px;">
                        @if($req->id_image)
                            <img src="{{ asset('storage/' . $req->id_image) }}" 
                                 alt="ID Image" 
                                 style="width:100%; max-width:300px; border-radius:5px;">
                        @else
                            <p style="color:red;">No ID Image uploaded</p>
                        @endif
                    </div>
                    <p>Status: 
                        @if($req->status === 'pending')
                            <span style="color: #ffc107;">Pending</span>
                        @elseif($req->status === 'approved')
                            <span style="color: #28a745;">Done</span>
                        @elseif($req->status === 'rejected')
                            <span style="color: #dc3545;">Rejected</span>
                        @endif
                    </p>

                    {{-- Status buttons for pending requests --}}
                    @if($req->status === 'pending')
                        <form action="{{ route('admin.all_requests.update_status', [$req->id, 'approved']) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background-color:#28a745;color:white;padding:5px 10px;border:none;border-radius:5px;cursor:pointer;">Mark as Done</button>
                        </form>
                        <form action="{{ route('admin.all_requests.update_status', [$req->id, 'rejected']) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background-color:#dc3545;color:white;padding:5px 10px;border:none;border-radius:5px;cursor:pointer;">Reject</button>
                        </form>
                    @endif

                    {{-- Delete button for approved or rejected --}}
                    @if(in_array($req->status, ['approved', 'rejected']))
                        <form action="{{ route('admin.all_requests.delete', $req->id) }}" method="POST" style="display:inline; margin-top:5px;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this request?')" style="padding:6px 12px; background:#dc3545; border:none; color:white; border-radius:4px; cursor:pointer;">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
