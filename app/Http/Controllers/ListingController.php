<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class ListingController extends Controller
{
    public function index(Request $request){
        $jobs = Listing::where('is_active',true)
                   ->with('tags')
                   ->latest();
        
        $tags = Tag::orderBy('name')->get();
        
        if($request->has('search')){
            $q = strtolower($request->get('search'));

            $jobs->where(function (Builder $builder) use ($q) {
                $builder
                    ->orWhere('title', 'like', "%{$q}%")
                    ->orWhere('company', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%");
            });
        }

        if($request->has('tag')){
            $tag = $request->get('tag');
            $jobs->whereHas('tags', function (Builder $builder) use ($tag) {
                $builder->where('slug', $tag);
            });
        }

        $listings = $jobs->get();
        
        return view('listings.index',compact('listings','tags'));
    }
}
