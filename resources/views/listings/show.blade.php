<x-app-layout>
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
     <div class="md:flex-grow mr-8 mt-2 flex items-center justify-center">   
     @foreach($listing->tags as $tag)     
      <span class="inline-block uppercase px-4 py-4">
       {{$tag->name}}
      </span>
      @endforeach
      </div>
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{$listing->title}}</h1>
        <div class="mx-auto leading-relaxed text-base">
        {!! $listing->description !!}
        </div>
    </div>
    <div class="flex flex-wrap">
      <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
        <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">Location</h2>
        <p class="leading-relaxed text-base mb-4">{{ $listing->location }}</p>
      </div>
      <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
        <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">Banner</h2>
        <a class="text-blue-500 inline-flex items-center">
        <img src="/storage/{{ $listing->logo }}" width="480" height="480"/>
        </a>
      </div>
      <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
        <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">Company</h2>
        
        <a class="text-blue-500 inline-flex items-center"> {{ $listing->company }}
        </a>
      </div>
      <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
        <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">About</h2>
        <p class="leading-relaxed text-base mb-4">Tech Job</p>
        <a class="text-blue-500 inline-flex items-center">Learn More
          
        </a>
      </div>
    </div>
    <a href="{{ route('jobs.apply',$listing->slug)}}">
        <button class="flex mx-auto mt-16 text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">APPLY</button>
    </a>
  </div>
</section>
</x-app-layout>