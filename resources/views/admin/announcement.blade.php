@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Announcements</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Announcement Button -->
    <div class="mb-4">
        <a href="{{ route('admin.announcements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create Announcement
        </a>
    </div>

    @if($announcements->isEmpty())
        <p>No announcements yet.</p>
    @else
        <div class="space-y-4">
            @foreach($announcements as $announcement)
                <div class="border rounded p-4 bg-white shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-semibold">{{ $announcement->title }}</h2>
                            <p class="text-gray-600 text-sm">Posted on {{ $announcement->created_at->format('F d, Y h:i A') }}</p>
                            <p class="mt-2">{{ $announcement->message }}</p>
                        </div>
                        <div>
                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
