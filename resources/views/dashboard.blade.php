<x-app-layout>

<section class="container px-5 py-12 mx-auto">
    <div class="mb-12">
        <h2 class="text-2xl font-medium text-gray-900 title-font px-4">All Jobs ({{$listings->count()}})</h2>
    </div>

    <div class="-my-6">
        @if(Session::has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ Session::get('success')}}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif
      @foreach($listings as $listing) 
      <div class="mt-4">
      <a href="{{ route('jobs.show',$listing->slug)}}"
        class="py-6 px-6 flex flex-wrap md:flex-nowrap border-b border-gray-100 {{ $listing->is_highlighted ? 'bg-yellow-100 hover:bg-yellow-200' : 'bg-white hover:bg-gray-100' }}"
        > 
        <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
            <img src="/storage/{{ $listing->logo }}" alt="{{ $listing->company }} logo" class="w-16 h-16 rounded-full object-cover">
        </div>
            <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $listing->title }}</h2>
                <p class="leading-relaxed text-gray-900">
                    {{ $listing->company }} &mdash; <span class="text-gray-600">{{ $listing->location }}</span>
                </p>
            </div>
            <div class="md:flex-grow mr-8 flex items-center justify-start">
                @foreach($listing->tags as $tag)
                    <span class="inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase {{ $tag->slug === request()->get('tag') ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500' }}">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
            <span class="md:flex-grow flex items-center justify-end">
                <span>{{ $listing->created_at->diffForHumans() }}</span>
            </span>
        </a>
        <a href="{{url('job/edit/'.$listing->slug)}}" class="border border-indigo-300">Edit Job Post</a>
        @if($listing->is_active)
        <button onclick="return makeInactive();" class="border border-indigo-300">Make Inactive</button>
        @endif
        <form id="inactive_form" method="POST" action="{{ route('job.inactive',$listing->slug)}}">
            @csrf
        </form>
        </div>
        @endforeach
    </div>

</section>

<script>
    function makeInactive(){
        if(confirm("Inactive this post?")){
            event.preventDefault();
            document.getElementById('inactive_form').submit();
        }
    }
</script>

</x-app-layout>
