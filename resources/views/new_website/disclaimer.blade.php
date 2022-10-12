@extends('new_layouts.main')

@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush

@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
@endpush

@section('content')
  <!-- MAIN SECTION -->
  <section id="main-section">
    <div class="custom-container">
        <h1 class="text-2xl font-bold text-center text-dark-black pt-2">Disclaimer Policy</h1>
        <hr class="border-blue-900 mt-auto">
        <div class="space-y-3">
            <h6 class="text-sm mb-2 font-bold text-dark-black">Please read our DISCLAIMER POLICY!</h6>
            <p class="text-sm mb-2">This site is designed, updated and maintained by <b>SG ASIA CARS</b></p>
            <p class="text-sm mb-2">To obtain access to certain <b>SG ASIA CARS</b> services, you will be given an opportunity to sign up at <b>SG ASIA CARS</b>. As part of the sign-up process, you will select a username and a password. You agree that the information you supply will be accurate and complete and that you will not sign up under the name of, nor attempt to enter the service under the name of, another person. We reserve the right to disallow the use of username that we deem offensive or inappropriate. You will be responsible for preserving the confidentiality of your password and for all actions of persons accessing <b>SG ASIA CARS</b> through any username/password assigned to you. We accept no responsibility in case of any known or suspected unauthorized use of your account. In this case we request you to inform us so that we can protect you for further damage.</p>
            <p class="text-sm mb-2">We accept no responsibility for any errors or omissions, or for the results obtained from the use of this information. All information in this site is provided "as is," with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied, including, but not limited to warranties of performance, merchantability and fitness for a particular purpose. Nothing herein shall to any extent substitute for the independent investigations and the sound technical and business judgment of the reader. In no event shall <b>SG ASIA CARS</b> be liable for any direct, indirect, incidental, punitive, or consequential damages of any kind whatsoever with respect to the service, the materials and the products. Users of this site must hereby acknowledge that any reliance upon any materials shall be at their sole risk.</p>
            <p class="text-sm mb-2 pb-3"><b>SG ASIA CARS</b> reserve the right, in their sole discretion and without any obligation, to make improvements to, or correct any error or omissions in any portion of the service or the materials.</p>
        </div>
    </div>
    <div class="container">
      <!-- CONTACT US INFORMATION TABS -->
      @include('new_includes.contact-us-info')
      <!-- // CONTACT US INFORMATION TABS -->

    </div>
  </section>
  <!-- // MAIN SECTION -->

@endsection
