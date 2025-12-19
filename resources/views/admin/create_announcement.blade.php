@extends('layouts.admin')

@section('content')
<h2>Create Announcement</h2>

@if($errors->any())
    <div style="background:#f8d7da; padding:10px; margin-bottom:15px; border-radius:5px; color:#721c24;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.announcements.store') }}" method="POST" style="max-width:500px;">
    @csrf
    <label>Title</label>
    <input type="text" name="title" value="{{ old('title') }}" style="width:100%; padding:8px; margin-bottom:10px;">

    <label>Message</label>
    <textarea name="message" rows="5" style="width:100%; padding:8px; margin-bottom:10px;">{{ old('message') }}</textarea>

    <button type="submit" style="padding:8px 12px; background:#28a745; color:#fff; border:none; border-radius:5px;">Post Announcement</button>
</form>
@endsection
