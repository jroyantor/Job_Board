<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function show(Listing $listing, Request $request){
        return view('listings.show',['listing' => $listing]);
    }

    public function apply(Listing $listing, Request $request){

        $listing->clicks()->create([
            'user_agent'=>$request->userAgent(),
            'ip' => $request->ip()
        ]);

        return redirect()->to($listing->apply_link);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){

        $validationData = [
            'title' => 'required',
            'company' => 'required',
            'logo' => 'file|max:2048',
            'location' => 'required',
            'apply_link' => 'required|url',
            'description' => 'required',
            'payment_method_id' => 'required'
        ];

        if(!Auth::check()){
            $validationData = array_merge($validationData,[
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:5',
                'name' => 'required'
            ]);
        }

        $request->validate($validationData);

        $user = Auth::user();

        if(!$user){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->createAsStripeCustomer();

            Auth::login($user);
        }

        //processing payment

        try{
            $amount = 9900; //in cents

            if($request->filled('is_highlighted')){
                $amount += 4500;
            }

            $user->charge($amount, $request->payment_method_id);

            $md = new \ParsedownExtra();

            $listing = $user->listings()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'company' => $request->company,
                'logo' => basename($request->file('logo')->store('public')),
                'location' => $request->location,
                'apply_link' => $request->apply_link,
                'description' => $md->text($request->description),
                'is_highlighted' => $request->filled('is_highlighted'),
                'is_active' => true
            ]);

            foreach(explode(',',$request->tags) as $r_tag){
                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug(trim($r_tag))
                ],[
                    'name' => ucwords(trim($r_tag))
                ]);

                $tag->listings()->attach($listing->id);
            }
            return redirect()->route('dashboard');
        } catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

}

