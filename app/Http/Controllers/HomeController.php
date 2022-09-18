<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('maintenance');
        
        return view('guest.home', [
            'title' => 'Home'
        ]);
    }
}