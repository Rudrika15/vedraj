<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::paginate(10);
        return view('video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diseases = Disease::all();
        return view('video.create', compact('diseases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'disease_id' => 'required',
            'title' => 'required',
            'youtube_link' => 'required | regex:/.com/',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $video = new Video();
        $video->disease_id = $request->disease_id;
        $video->title = $request->title;
        $video->youtube_link = $request->youtube_link;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('images/videos'), $filename);
            $video->thumbnail = $filename;
        }
        $video->save();
        return redirect()->route('video.index')->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $video = Video::find($id);
        $diseases = Disease::all();
        return view('video.edit', compact('video', 'diseases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'disease_id' => 'required',
            'title' => 'required',
            'youtube_link' => 'required | regex:/.com/',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        $video = Video::find($id);
        $video->disease_id = $request->disease_id;
        $video->title = $request->title;
        $video->youtube_link = $request->youtube_link;
        if ($video->thumbnail && file_exists(public_path('images/' . $video->thumbnail))) {
            unlink(public_path('images/' . $video->thumbnail));
        }
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('images/videos'), $filename);
            $video->thumbnail = $filename;
        }
        $video->save();
        return redirect()->route('video.index')->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        $video->delete();
        return redirect()->route('video.index')->with('success', 'Video deleted successfully.');
    }
}
