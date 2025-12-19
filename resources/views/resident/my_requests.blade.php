@extends('layouts.resident')

@section('content')
<h1>My Requests</h1>

@if(session('success'))
    <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
@endif

@if($requests->isEmpty())
    <p>You have no requests yet.</p>
@else
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        @foreach($requests as $request)
            <div style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px;">
                <h3 style="margin-top:0;">Purpose: {{ $request->purpose }}</h3>
                <p>{{ $request->message }}</p>
                
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $request->id_image) }}" alt="ID Image" style="width:100%; border-radius: 5px;">
                </div>
                
                <p>Status: 
                    @if($request->status === 'pending')
                        <span style="color: #ffc107;">Pending</span>
                    @elseif($request->status === 'approved')
                        <span style="color: #28a745;">Approved</span>
                    @elseif($request->status === 'rejected')
                        <span style="color: #dc3545;">Rejected</span>
                    @endif
                </p>

                @if($request->status === 'pending')
                    <form action="{{ route('resident.my_requests.delete', $request->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this request?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color:#dc3545;color:white;padding:8px 12px;border:none;border-radius:5px;cursor:pointer;">Delete</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endif
@endsection
