@extends('layouts.resident')

@section('content')
    <h1>Announcements</h1>

    @if($announcements->isEmpty())
        <p>No announcements available.</p>
    @else
        @foreach($announcements as $announcement)
            <div style="
                background:#fff;
                padding:15px;
                border-radius:8px;
                margin-bottom:15px;
                box-shadow:0 0 5px rgba(0,0,0,0.1);
            ">
                <h3 style="margin:0;">{{ $announcement->title }}</h3>
                <p style="margin-top:10px;">{{ $announcement->message }}</p>
                <small style="color:gray;">
                    Posted: {{ $announcement->created_at->format('M d, Y h:i A') }}
                </small>
            </div>
        @endforeach
    @endif
@endsection
