<section class="text-gray-600 body-font">
  <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
    <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Top Tech
        <br class="hidden lg:inline-block">Jobs
      </h1>
      <p class="mb-8 leading-relaxed">Best IT Jobs curated from the industry in one place.</p>
      <div class="flex justify-center">
        <form action="{{ route('jobs.index') }}" method="get">
        <input type="text" name="search" id="search" value="{{ request()->get('search') }}" class="bg-gray-100 bg-opacity-50 rounded focus:ring-2 focus:ring-indigo-200 focus:bg-transparent border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-2 leading-8 transition-colors duration-200 ease-in-out">
        <button class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Search</button>
       </form>    
      </div>
      <p class="text-sm mt-2 text-gray-500 mb-8 w-full">fullstack php, vue and node, react native</p>
    </div>
    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
      <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
    </div>
  </div>
</section>