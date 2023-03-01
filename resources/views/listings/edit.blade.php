<x-app-layout>
<section class="text-black-600 body-font overflow-hidden">
        <div class="w-full md:w-1/2 py-24 mx-auto">
            <div class="mb-4">
                <h2 class="title-font font-medium text-black-900 text-2xl">
                    Edit Job Post
                </h2>
            </div>
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-200 text-red-800">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form
                action="{{ url('job/edit/'.$listing->slug) }}"
                method="post"
                enctype="multipart/form-data"
                class="bg-gray-100 p-4"
            >
            @csrf
            <div class="mb-4 mx-2">
                    <x-label for="title" value="Job Title" />
                    <x-input
                        id="title"
                        class="block mt-1 w-full"
                        type="text"
                        name="title"
                        value="{{ $listing->title }}"
                        required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="company" value="Company Name" />
                    <x-input
                        id="company"
                        class="block mt-1 w-full"
                        type="text"
                        name="company"
                        value="{{ $listing->company }}"
                        required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="logo" value="Company Logo" />
                    <img src="/storage/{{ $listing->logo }}" height="100" width="100"/>
                    <x-input
                        id="logo"
                        class="block mt-1 w-full"
                        type="file"
                        name="logo" />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="location" value="Location (e.g. Remote, United States)" />
                    <x-input
                        id="location"
                        class="block mt-1 w-full"
                        type="text"
                        name="location"
                        value="{{ $listing->location }}"
                        required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="apply_link" value="Link To Apply" />
                    <x-input
                        id="apply_link"
                        class="block mt-1 w-full"
                        type="text"
                        name="apply_link"
                        value="{{ $listing->apply_link }}"
                        required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="tags" value="Tags (separate by comma)" />
                    <x-input
                        id="tags"
                        class="block mt-1 w-full"
                        type="text"
                        value="{{ implode(',',$array)}}"
                        name="tags" />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="description" value="Listing Description (Markdown is okay)" />
                    <textarea
                        id="description"
                        rows="8"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        name="description"
                    >{{ $listing->description }}</textarea>
                </div>
                <div class="mb-6 mx-2">
                    <div id="card-element"></div>
                </div>
                <div class="mb-2 mx-2">
                    <button type="submit" id="form_submit" class="block w-full items-center bg-indigo-500 text-white border-0 py-2 focus:outline-none hover:bg-red-600 rounded text-base mt-4 md:mt-0">Update</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>