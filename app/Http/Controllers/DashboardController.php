<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use App\Models\RequestModel;

class DashboardController extends Controller
{
    /* ------------------------------
       ANNOUNCEMENTS (ADMIN)
    ------------------------------ */
    public function showCreateAnnouncementForm()
    {
        return view('admin.create_announcement');
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Announcement::create([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()
            ->route('admin.create_announcement')
            ->with('success', 'Announcement created successfully!');
    }

    /* ------------------------------
       REQUESTS (ADMIN)
    ------------------------------ */
    public function allRequests()
    {
        $requests = RequestModel::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.all_requests', compact('requests'));
    }

    public function updateRequestStatus($id, $status)
    {
        $request = RequestModel::findOrFail($id);
        $request->status = $status;
        $request->save();

        return redirect()
            ->route('admin.all_requests')
            ->with('success', 'Request status updated!');
    }

    public function adminDeleteRequest($id)
    {
        $request = RequestModel::findOrFail($id);

        // Only allow deleting approved or rejected requests
        if (!in_array($request->status, ['approved', 'rejected'])) {
            return back()->with('error', 'Only approved or rejected requests can be deleted.');
        }

        // Delete ID image if exists
        if ($request->id_image && file_exists(public_path('storage/' . $request->id_image))) {
            unlink(public_path('storage/' . $request->id_image));
        }

        $request->delete();

        return back()->with('success', 'Request deleted successfully.');
    }

    /* ------------------------------
       REQUESTS (RESIDENT)
    ------------------------------ */
    public function myRequests()
    {
        $requests = RequestModel::where('user_id', Auth::id())->get();
        return view('resident.my_requests', compact('requests'));
    }

    public function deleteRequest($id)
    {
        $request = RequestModel::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Delete ID image if exists
        if ($request->id_image && file_exists(public_path('storage/' . $request->id_image))) {
            unlink(public_path('storage/' . $request->id_image));
        }

        $request->delete();

        return redirect()
            ->route('resident.my_requests')
            ->with('success', 'Request deleted successfully!');
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'purpose' => 'required|string|max:255',
            'message' => 'required|string',
            'id_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a unique filename
        $filename = time() . '_' . $request->file('id_image')->getClientOriginalName();

        // Ensure the directory exists
        if (!file_exists(public_path('storage/id_images'))) {
            mkdir(public_path('storage/id_images'), 0755, true);
        }

        // Move the uploaded file to public/storage/id_images
        $request->file('id_image')->move(public_path('storage/id_images'), $filename);

        // Save relative path in database
        $imagePath = 'id_images/' . $filename;

        RequestModel::create([
            'user_id' => Auth::id(),
            'purpose' => $request->purpose,
            'message' => $request->message,
            'id_image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('resident.create_request')
            ->with('success', 'Request submitted successfully!');
    }

    /* ------------------------------
       DASHBOARDS
    ------------------------------ */
    public function resident()
    {
        return view('resident.dashboard');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }
}
