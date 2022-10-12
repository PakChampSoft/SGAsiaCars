<section id="search-bar" class="dark-black-bg pt-2 pb-2">
    <div class="container-fluid">
      <div class="row padding-10">
        <div class="col-md-4 col-sm-12">
          <a href="{{ route('landing.index') }}" class="text-3xl font-bold blue-text">
            <img src="{{ asset('images/SG logo.png') }}" class="logo-padding-bottom pl-xl-4-5 text-sm-center" alt="logo">
          </a>
        </div>
        <div class="col-md-8 col-sm-12">
          <form action="{{ route('landing.full_text') }}" class="flex items-center justify-start">
            <input type="text" value="{{ request()->qry }}" name="qry" placeholder="Search Vehicle"
              class="rounded-l-md border-blue-700 border-2 py-1 search-width">
            <input type="submit"
              class="text-white dark-blue-bg rounded-r-lg px-4 py-1 border-2 border-blue-700 cursor-pointer"
              value="Search">
          </form>
        </div>
      </div>
    </div>
  </section>
