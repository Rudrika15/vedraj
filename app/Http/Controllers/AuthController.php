<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Branch;
use App\Models\Disease;
use App\Models\Product;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'You are now logged in!');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You are now logged out!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dashboard()
    {
        $totalStaff = User::where('role', 'staff')->count();
        $totalDiseases = Disease::all()->count();
        $totalProducts = Product::all()->count();
        $totalArticles = Article::all()->count();
        $totalVideos = Video::all()->count();
        $totalBranches = Branch::all()->count();

        return view('dashboard', compact('totalStaff', 'totalDiseases', 'totalProducts', 'totalArticles', 'totalVideos', 'totalBranches'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
