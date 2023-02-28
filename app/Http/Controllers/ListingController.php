<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Tag;

class ListingController extends Controller
{
    public function index(){
        $listings = Listing::where('is_active',true)
                   ->with('tags')
                   ->latest()
                   ->get();
        
        $tags = Tag::orderBy('name')->get();           
        return view('listings.index',compact('listings','tags'));
    }
}
