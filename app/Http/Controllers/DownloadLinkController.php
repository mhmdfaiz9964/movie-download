<?php

namespace App\Http\Controllers;

use App\Models\DownloadLink;
use App\Models\DownloadLinksHasType;
use App\Models\DownloadLinksHasTypeHasLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadLinkController extends Controller
{
    public function index()
    {
        $downloadLinks = DownloadLink::all();
        return view('download-links.index', compact('downloadLinks'));
    }

    public function create()
    {
        return view('download-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:movies,tv_series,videos', // Adjusted types
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'types.*' => 'nullable|string|max:255',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('download_links_images', 'public');
        }
    
        $downloadLink = DownloadLink::create([
            'title' => $request->title,
            'type' => $request->type,
            'image' => $imagePath,
            'description' => $request->description,
        ]);
    
        foreach ($request->types ?? [] as $type) {
            DownloadLinksHasType::create([
                'download_links_id' => $downloadLink->id,
                'type' => $type,
            ]);
        }
    
        return redirect()->route('download-links.index')->with('success', 'Download link created successfully.');
    }

    public function edit($id)
    {
        $downloadLink = DownloadLink::findOrFail($id);
        return view('download-links.edit', compact('downloadLink'));
    }

    public function show($id)
    {
        $downloadLink = DownloadLink::findOrFail($id);
        $downloadLinks = DownloadLink::all(); // Fetch all DownloadLink models
    
        return view('front-end.download-links.show', compact('downloadLink', 'downloadLinks'));
    }
    
    // public function update(Request $request, DownloadLink $downloadLink)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'type' => 'nullable|string|in:movies,tv_series,subtitles,videos',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'description' => 'nullable|string',
    //         'types.*' => 'nullable|string|max:255',
    //     ]);
    
    //     // Update the basic fields of the DownloadLink
    //     $downloadLink->title = $request->title;
    //     $downloadLink->type = $request->type;
    //     $downloadLink->description = $request->description;
    
    //     // Handle image upload if a new image is provided
    //     if ($request->hasFile('image')) {
    //         // Delete the previous image if exists
    //         if ($downloadLink->image) {
    //             Storage::disk('public')->delete($downloadLink->image);
    //         }
    //         // Store the new image
    //         $imagePath = $request->file('image')->store('download_links_images', 'public');
    //         $downloadLink->image = $imagePath;
    //     }
    
    //     $downloadLink->save();
    
    // // // Sync types with DownloadLinksHasType model
    // // $types = $request->types ?? [];
    // // $downloadLink->types()->delete(); // Remove old types
    // // foreach ($types as $type) {
    // //     DownloadLinksHasType::create([
    // //         'download_links_id' => $downloadLink->id,
    // //         'type' => $type,
    // //     ]);
    // // }
    
    //     return redirect()->route('download-links.index')->with('success', 'Download link updated successfully.');
    // }
    

    public function storeLink(Request $request, $id)
    {
        $request->validate([
            'link_type' => 'nullable|string|max:255',
            'link_type_input' => 'nullable|string|max:255',
            'url' => 'required|url',
        ]);
    
        $downloadLink = DownloadLink::findOrFail($id);
    
        $linkType = $request->input('link_type') ?: $request->input('link_type_input');
    
        if ($linkType) {
            // Find or create the DownloadLinksHasType entry
            $type = DownloadLinksHasType::firstOrCreate([
                'download_links_id' => $downloadLink->id,
                'type' => $linkType,
            ]);
    
            // Create a new link for the specified type
            DownloadLinksHasTypeHasLink::create([
                'download_links_has_types_id' => $type->id,
                'url' => $request->url,
                'link_type' => $request->input('link_type_input'), // Store the link_type_input in link_type column
            ]);
    
            return redirect()->back()->with('success', 'Link added successfully.');
        } else {
            return redirect()->back()->with('error', 'Please select or enter a valid link type.');
        }
    }

    public function destroy($id)
    {
        $downloadLink = DownloadLink::findOrFail($id);
        $downloadLink->delete();

        return redirect()->route('download-links.index')->with('success', 'Download link deleted successfully.');
    }
}

