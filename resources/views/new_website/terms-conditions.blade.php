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
        <h1 class="text-2xl font-bold text-center text-dark-black pt-2">Terms & Conditions</h1>
        <hr class="border-blue-900 mt-auto">
        <div class="space-y-3">
            <h6 class="text-sm mb-2 font-bold text-dark-black">Please read our TERMS OF USE carefully!</h6>
            <p class="text-sm mb-2">1.	<b>SG ASIA CARS</b> reserve the right to update the Terms of Use at any time without notice to you.</p>
            <p class="text-sm mb-2">2.	By accessing or using the Site, you hereby agree to accept the Terms of Use set forth in this Agreement as a user. You shall be bound by the Terms of Use of this Agreement with respect to your access or use of this Site and any further upgrade, modification, addition or change to this Site. If you do not accept all of the Terms of Use of this Agreement, please do not use this Site.</p>
            <p class="text-sm mb-2">3.	No user shall attempt to gain unauthorized access to any Services, other accounts, computer systems or networks connected to any <b>SG ASIA CARS</b> server or to any of the Services, through hacking, password mining or any other means.</p>
            <p class="text-sm mb-2">4.	The features and services on the <b>SG ASIA CARS</b> site are provided on the "as is" and "as available" basis, and we hereby expressly disclaim any and all warranty except warranty expressly stated herein, including but not limited to any warranties of condition, quality, durability, performance, accuracy, reliability, merchantability or fitness for a particular purpose. All such warranties, representations, conditions, undertakings and terms are hereby excluded.</p>
            <p class="text-sm mb-2">5.	You may not copy, reproduce, recompile, decompile, disassemble, reverse-engineer, distribute, publish, display, perform, modify, upload to create derivative works from, transmit, communicate or in any other way exploit any part of the information or material obtained through the Website and/or the Website's material.</p>
            <p class="text-sm mb-2">6.	<b>SG ASIA CARS</b> have no obligation to monitor the Communication Services (The Services may contain e-mail services, newsletter, tell your friend and/or other message or communication facilities designed to enable you to communicate with us or others). However, <b>SG ASIA CARS</b> reserve the right to review materials posted to the Communication Services and to remove any materials in its sole discretion. <b>SG ASIA CARS</b> reserve the right to terminate your access to any or all of the Communication Services at any time, without notice, for any reason whatsoever.</p>
            <p class="text-sm mb-2">7.	This Agreement shall be governed by the laws of the Japan Jurisdiction only without regard to its conflict of law provisions.</p>
        </div>
        <div class="space-y-3">
            <h6 class="text-sm font-bold text-dark-black">Limitation of Liability</h6>
            <p class="text-sm mb-2">1.	<b>SG ASIA CARS</b> make no representations or warranty about the validity, accuracy, correctness, reliability, quality, stability, and/or other problems with the information, products and services provided except warranty expressly stated herein. We advised you to contact our sales department to get more about our warranty (if any) before you make purchase.</p>
            <p class="text-sm mb-2">2.	<b>SG ASIA CARS</b> is not responsible for any delay in shipping the unit purchased/ordered. But we always help you to sort out any problem if it is under our control.</p>
            <p class="text-sm mb-2">3.	Customers are solely responsible for all of the terms and conditions of the transactions conducted on, through or as a result of use of the Site, including, without limitation, terms regarding payment, returns, warranty, shipping, insurance, fees, taxes, title, licenses, fines, permits, handling, transportation and storage.</p>
            <p class="text-sm mb-2">4.	Under no circumstances shall <b>SG ASIA CARS</b> be held liable for a delay or failure or disruption of the content or services delivered resulting directly or indirectly from acts of nature, forces or causes beyond its reasonable control, including without limitation, Internet failures, computer, telecommunications or any other equipment failures, electrical power failures, strikes, labor disputes, riots, insurrections, civil disturbances, shortages of labor or materials, fires, flood, storms, explosions, Acts of God, war, governmental actions, orders of domestic or foreign courts or tribunals or non-performance of third parties</p>
            <p class="text-sm mb-2">5.	<b>SG ASIA CARS</b> reserved the rights of canceling any fraud/incomplete order without any prior intimation in written or verbal.</p>
            <p class="text-sm mb-2">6.	Under no circumstances <b>SG ASIA CARS</b> is not liable for any refund against any purchase made except warranty expressly stated herein.</p>
        </div>
        <div class="space-y-3">
            <h6 class="text-sm mb-2 font-bold text-dark-black">Materials Provided To/Posted at www.beforward.jp</h6>
            <p class="text-sm mb-2">1.	When participating in any service you may provide us with information about yourself and/or products and services listed. You grant us exclusive rights in all of this information, and all information derived or generated from it, in all existing or future media. These rights include but are not limited to the right to display your information anywhere, to search the information, and, consistent with our Privacy policy, to repackage and resell it to anyone for any reason. As used in this paragraph, information includes but is not limited to data, text, photographs, drawings, sound recordings, feedback, and any other information or data displayed or presented in connection with your listings with us.</p>
            <p class="text-sm mb-2">2.	<b>SG ASIA CARS</b> reserve the right at all times to disclose any information as <b>SG ASIA CARS</b> deems necessary to satisfy any applicable law, regulation, legal process or governmental request, or to edit, refuse to post or to remove any information or materials, in whole or in part, in <b>SG ASIA CARS</b>'s sole discretion. See the Privacy Statement disclosures relating to the collection and use of your information.</p>
            <p class="text-sm mb-2 pb-3">3.	If the information provided by you upon sign up is false <b>SG ASIA CARS</b> reserves the right to terminate your account. Any rights not expressly granted herein are reserved.</p>
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
