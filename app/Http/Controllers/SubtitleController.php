<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownloadLink;
use App\Models\Subtitle;

class SubtitleController extends Controller
{
    /**
     * Show the form for creating a new subtitle.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $downloadLinks = DownloadLink::all(); // Example: Fetching download links to associate with subtitles
        return view('subtitles.create', compact('downloadLinks'));
    }

    /**
     * Store a newly created subtitle in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'download_link_id' => 'required|exists:download_links,id',
            'subtitle_file' => 'required|file|max:20480|mimetypes:text/plain,application/octet-stream,text/vtt', // Adjust mime types as needed
        ], [
            'subtitle_file.mimes' => 'The subtitle file must be of type: srt, sub, or vtt.', // Custom error message
        ]);

        $downloadLink = DownloadLink::findOrFail($request->download_link_id);

        $subtitleFileName = $request->file('subtitle_file')->store('subtitles');

        $subtitle = new Subtitle([
            'download_link_id' => $downloadLink->id,
            'filename' => $subtitleFileName,
        ]);
        $subtitle->save();

        return redirect()->back()->with('success', 'Subtitle uploaded successfully.');
    }

    /**
     * Display a listing of subtitles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $subtitles = Subtitle::all();
        return view('subtitles.index', compact('subtitles'));
    }

    public function destroy(Subtitle $subtitle)
    {
        $subtitle->delete();

        return redirect()->route('subtitles.index')
            ->with('success', 'Subtitle deleted successfully.');
    }
}
