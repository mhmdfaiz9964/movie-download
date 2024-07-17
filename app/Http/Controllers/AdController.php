<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::all();
        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'position' => 'required|in:home_page,download_time,single_download_page_bottom,single_download_page_sidebar,single_download_page_top,home_bottom,home_top,home_sidebar,home_after_movies',
            'url' => 'nullable|url',
        ]);
    
        $imagePath = $request->file('image')->store('ads', 'public');
    
        $fullImagePath = asset('storage/' . $imagePath);
    
        $ad = new Ad();
        $ad->title = $request->title;
        $ad->image = $fullImagePath; 
        $ad->position = $request->position;
        $ad->url = $request->url;
        $ad->save();
    
        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }
    

    public function edit(Ad $ad)
    {
        return view('ads.edit', compact('ad'));
    }

    public function update(Request $request, Ad $ad)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'position' => 'required|in:home_page,download_time,single_download_page_bottom,single_download_page_sidebar,single_download_page_top,home_bottom,home_top,home_sidebar,home_after_movies',
            'url' => 'nullable|url',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ads', 'public');
    
            Storage::disk('public')->delete($ad->image);
    
            $ad->image = asset('storage/' . $imagePath);
        }
    
        $ad->title = $request->title;
        $ad->position = $request->position;
        $ad->url = $request->url;
        $ad->save();
    
        return redirect()->route('ads.index')->with('success', 'Ad updated successfully.');
    }
    
    public function destroy(Ad $ad)
    {
        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'Ad deleted successfully.');
    }
}
