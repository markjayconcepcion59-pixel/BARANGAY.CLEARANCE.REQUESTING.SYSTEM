@extends('layouts.resident')

@section('content')
<h1>Create Clearance Request</h1>

@if(session('success'))
    <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background-color:#f8d7da; color:#842029; padding:10px; margin-bottom:15px; border-radius:5px;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('resident.create_request.submit') }}" enctype="multipart/form-data">
    @csrf

    <label for="purpose">Purpose:</label><br>
    <input type="text" name="purpose" id="purpose" placeholder="Purpose" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

    <label for="message">Message/Details:</label><br>
    <textarea name="message" id="message" placeholder="Enter details" required style="width:100%; padding:8px; margin-bottom:10px;"></textarea><br>

    <label for="id_image">Upload ID:</label><br>
    <input type="file" name="id_image" id="id_image" accept="image/*" required style="margin-bottom:15px;"><br>

    <button type="submit" style="padding:10px 20px; background-color:#007bff; color:white; border:none; border-radius:5px; cursor:pointer;">
        Submit Request
    </button>
</form>
@endsection
