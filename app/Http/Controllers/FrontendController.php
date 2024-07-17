<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownloadLink;

class FrontendController extends Controller
{
    public function index()
    {
        $downloadLinks = DownloadLink::all(); // Fetch all DownloadLink models
        return view('front-end.index', compact('downloadLinks'));
    }

    public function show($id)
    {
        $downloadLink = DownloadLink::findOrFail($id); // Fetch the DownloadLink based on ID
        return view('front-end.show', compact('downloadLink'));
    }
}