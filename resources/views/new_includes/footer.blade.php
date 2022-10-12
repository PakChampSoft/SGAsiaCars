<section id="footer" style="background-color: #dd0404;padding: 25px 0px;">
    <div class="container" style="background: #dd0404;">
      <div class="row mb-2">
        <div class="col-xl-3 col-md-3 col-sm-12" style="background:white;">
          <div class="text-center pt-10">
            <img src="assets/images/SG logo.png" class="img-fluid" alt="logo">
          </div>
          <hr class="border-blue">
          <p class="my-4" style="color: #dd0404; word-break: break-word;">
            114 SOI PETCHKASEM112, <br>
            NONGKHAM, BANGKOK. <br>
            <a href="tel: +66 91 786 9096">TEL : +66 97 971 4637</a> <br>
            <a href="https://web.whatsapp.com/send/?phone=+66979714637" target="_blank">WA : +66 97 971 4637</a> <br>
            EMAIL : <a class="text-sm" href="mailto:contact@sgasiacars.com">customersdepartment@vigo4u.com</a> <br>
          </p>
          <iframe title="location_map"
            src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d31006.738016340496!2d100.47825161818311!3d13.727998657444337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e0!4m5!1s0x30e298f8a072802b%3A0x740128e22e424432!2zdmlnbzR1IGNvLixsdGQgMTE0IOC4luC4meC4mSDguYDguJ7guIrguKPguYDguIHguKnguKEgMTEyIOC5geC4guC4p-C4hyDguKvguJnguK3guIfguITguYnguLLguIfguJ7guKXguLkg4LmA4LiC4LiV4Lir4LiZ4Lit4LiH4LmB4LiC4LihIEJhbmdrb2sgMTAxNjAsIFRoYWlsYW5k!3m2!1d13.729569399999999!2d100.4846666!4m0!5e0!3m2!1sen!2s!4v1631280569144!5m2!1sen!2s"
            width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-xl-2 col-md-2 col-sm-12 text-center">
          <h2 class="mb-4 mt-3 font-bold text-yellow-500">BROWSE STOCK</h2>
          <div class="flex flex-col text-white">
            <a href="{{ route('landing.stocklist', ['deal' => '6']) }}" class="">DISCOUNTED</a>
            <a href="{{ route('landing.stocklist', ['deal' => '7']) }}" class="">BEST DEALS</a>
            <a href="{{ route('landing.stocklist', ['deal' => '8']) }}" class="">PREMUIUM</a>
          </div>
          <h2 class="mb-4 mt-3 font-bold text-yellow-500">BROWSE COUNTRY</h2>
          <div class="flex flex-col text-white">
            <a href="{{ route('landing.stocklist', ['stock_country' => '213']) }}"> THAILAND</a>
            <a href="{{ route('landing.stocklist', ['stock_country' => '225']) }}"> UAE</a>
          </div>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-12 text-center">
          <h2 class="mb-4 mt-3 font-bold text-yellow-500">BROWSE PRICE</h2>
          <div class="flex flex-col text-white">
            <a href="{{ route('landing.stocklist', ['max_price' => '8000']) }}" class="">UNDER USD 8000</a>
            <a href="{{ route('landing.stocklist', ['min_price' => '8000', 'max_price' => '12000']) }}">USD 8000 - USD 12000</a>
            <a href="{{ route('landing.stocklist', ['min_price' => '12000', 'max_price' => '15000']) }}">USD 12000 - USD 15000</a>
            <a href="{{ route('landing.stocklist', ['min_price' => '15000', 'max_price' => '20000']) }}">USD 15000 - USD 20000</a>
            <a href="{{ route('landing.stocklist', ['min_price' => '20000', 'max_price' => '25000']) }}">USD 20000 - USD 25000</a>
            <a href="{{ route('landing.stocklist', ['min_price' => '25000']) }}">OVER USD 25000</a>
          </div>
          <h2 class="mb-4 mt-3 font-bold text-yellow-500">BY MAKE</h2>
          <div class="flex flex-col text-white">
            <a href="{{ route('landing.stocklist', ['maker' => '1'] ) }}">TOYOTA</a>
            <a href="{{ route('landing.stocklist', ['maker' => '9'] ) }}">FORD</a>
            <a href="{{ route('landing.stocklist', ['maker' => '21'] ) }}">ISUZU</a>
            <a href="{{ route('landing.stocklist', ['maker' => '8'] ) }}">NISSAN</a>
            <a href="{{ route('landing.stocklist', ['maker' => '33'] ) }}">CHEVEROLET</a>
            <a href="{{ route('landing.stocklist', ['maker' => '5'] ) }}">MITSUBISHI</a>
            <a href="{{ route('landing.stocklist', ['maker' => '7'] ) }}">MAZDA</a>
          </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-12 text-center">
          <h2 class="mb-4 mt-3 font-bold text-yellow-500">BY TYPE</h2>
          <div class="flex flex-col text-white">
            <a href="{{ route('landing.stocklist', ['type' => '18'] ) }}">DOUBLE CAB</a>
            <a href="{{ route('landing.stocklist', ['type' => '8'] ) }}">PICK UP</a>
            <a href="{{ route('landing.stocklist', ['type' => '19'] ) }}">DOUBLE CAB</a>
            <a href="{{ route('landing.stocklist', ['type' => '5'] ) }}">SUV</a>
            <a href="{{ route('landing.stocklist', ['type' => '11'] ) }}">VAN</a>
            <a href="{{ route('landing.stocklist', ['type' => '20'] ) }}">SMART CAB</a>
            <a href="{{ route('landing.stocklist', ['type' => '10'] ) }}">COUPE</a>
          </div>
          <h2 class="mt-4 mb-3 font-bold text-yellow-500">COMPANY</h2>
          <div class="flex flex-col text-white">
            <a href="/privacy-policy">Privacy Policy</a>
            <a href="/terms-conditions">Terms &amp; Conditions</a>
            <a href="/disclaimer">Disclaimer</a>
            <a href="{{ route('landing.blogs') }}">Blog</a>
            <a href="/sitemap.xml">Sitemap</a>
          </div>
        </div>
        <div class="col-xl-2 col-sm-12 text-center d-none  d-xl-block pr-0">
          <div class="bg-white">
            <div class="fb-page w-full h-full" data-href="https://www.facebook.com/toyotahiluxdealer" data-tabs="timeline" data-width="500" data-height="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/toyotahiluxdealer" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/toyotahiluxdealer">Meta</a></blockquote></div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-4 ">
        @php
        $year = \Carbon\Carbon::now()->year;
        @endphp
      <p class="text-center text-white">©1999 - {{ $year }} SG ASIA CARS. All Rights Reserved. Powered By <a
          href="https://pakchamp.com" style="text-decoration: none; hover: text-decoration: none;">Pakchamp Group Of Companies</a></p>
    </div>
  </section>

@push('js')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0" nonce="2Xl5H9pB"></script>
@endpush

