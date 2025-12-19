<?php
namespace App\Http\Controllers;

class AdminController extends Controller {
    public function dashboard() {
        return view('admin.dashboard');
    }
}

class ResidentController extends Controller {
    public function dashboard() {
        return view('resident.dashboard');
    }
}
