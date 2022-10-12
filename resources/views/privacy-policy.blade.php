@extends('layouts.main')
@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush
@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
@endpush
@section('content')
    <div class="w-10/12 mx-auto my-4">
        <div class="bg-blue-100 rounded-md p-4">
            <h1 class="text-2xl font-bold text-center dark-blue-text">Privacy Policy</h1>
            <hr class="border-blue-900">
            <div class="grid grid-cols-1 mt-4 gap-y-4">
                <div class="space-y-3">
                    <p class="text-sm font-bold dark-blue-text">Please read our Privacy Policy carefully!</p>
                    <p class="text-sm font-bold dark-blue-text">1.	The Information We Collect</p>
                    <p class="text-sm">1.1.	Members Information: Upon the on-line sign up process, we collect your contact information including e-mail address, telephone/fax/mobile number, etc.</p>
                    <p class="text-sm">1.2.	Registration information: At the time of your registration or attempt of registration with us, we collect your contact information including the details of Products you are looking for. We may collect the aforesaid information, even if you did not complete the on-line transactions with us, and use such information pursuant to our Privacy Policy.</p>
                    <p class="text-sm">1.3.	Billing & Payment Information: If you purchase or attempt to purchase any product or any other service from <b>SG ASIA CARS</b> through our website, we or our trading or consulting partners may collect additional information including billing/shipping information, payment information, delivery options etc. We may collect the aforesaid information, even if you did not complete the on-line transactions with us, and use such information pursuant to our Privacy Policy.</p>
                    <p class="text-sm">1.4.	Statistical Information: In addition, we gather aggregate statistical information about our Site and Users, such as IP addresses, browser software, operating system, pages viewed, number of sessions and unique visitors, etc. We may collect the aforesaid information, even if you did not complete the on-line transactions with us, and use such information pursuant to our Privacy Policy.</p>
                    <p class="text-sm">1.5.	Communication Services Information: At the time of your use or attempted use of our Communication Services (the services may contain e-mail services, auto-alert, newsletter, tell your friend, feedback and/or any other message or communication facilities designed to enable you to communicate with us or others) information such as your name, address, phone/fax number, email address and other personal information as well as information about your business shall be provided. We may collect the aforesaid information, even if you did not complete the on-line transactions with us, and use such information pursuant to our Privacy Policy.</p>
                    <p class="text-sm">1.6.	Collected Information: Members Information, Registration Information, Purchase Request Information, Billing & Payment Information, Statistical Information and any other information we may collect from you through our Website or any other means shall collectively be referred to as "Collected Information". Such information shall include any and all information that you have typed in our on-line system, even if you did not complete the transactions on the system.</p>
                </div>

                <div class="space-y-3">
                    <p class="text-sm font-bold dark-blue-text">2.	How Do We Use Your Information?</p>
                    <p class="text-sm">2.1.	General: We use your Collected Information to improve our marketing and promotional efforts, to statistically analyze site usage, to improve our content and product offerings and to customize our Site's content, layout and service specifically for you. We may use your Collected Information to service your Account with us, including but not limited to investigating problems, resolving disputes and enforcing agreements with us. We may share certain aggregate information based on analysis of Collected Information with our partners, customers, advertisers or potential Users. We may use your Collected Information to execute marketing campaigns, promotions or advertising messages on behalf of third parties; however, in these circumstances, your Collected Information will not be disclosed to such third parties unless you respond to the marketing, promotion or advertising message.</p>
                    <p class="text-sm">2.2.	Members information: We shall not disclose your membership information to any third party, other than for legal/relevant reasons.</p>
                    <p class="text-sm">2.3.	Registration Information: We use Registration Information to process your requests and provide valuable services. This information may be passed on to our agents, accredited dealers, manufacturers and fulfillment partners for completion of the sale pursuant to contractual rights granted by us. Once our accredited dealer receives this information, it becomes the property of the dealership in addition to ours.</p>
                    <p class="text-sm">2.4.	Billing & Payment Information: The Billing & Payment Information which we collect shall not be disclosed to any third party, other than for legal reasons implied in the transaction. The billing & payment information you have voluntarily provided while purchasing online has been registered. This information is used to process your order and could later be used for further promotional marketing purposes. As part of our marketing policy to advise you of any other offers of related products or services, we may allow other departments of <b>SG ASIA CARS</b>, and the group to which it belongs, to have your name and address and/or email address.</p>
                    <p class="text-sm">2.5.	Statistical Information: We use Statistical Information to help diagnose problems with and maintain our computer servers, to manage our Site, and to enhance our Site and services based on the usage pattern data we receive. We may generate reports and analysis based on the Statistical Information for internal analysis, monitoring and marketing decisions. We may provide Statistical Information to third parties, but when we do so, we do not provide personally-identifying information without your permission.</p>
                    <p class="text-sm">2.6.	Communication Services Information: We may use your Information to provide services that you request or to contact you regarding additional services about which <b>SG ASIA CARS</b> determines that you might be interested. Specifically, we may use your email address, mailing address, phone number or fax number to contact you regarding notices, surveys, product alerts, new service or product offerings and communications relevant to your use of our Site. We may generate reports and analysis based on the Information for internal analysis, monitoring and marketing decisions.</p>
                </div>

                <div class="space-y-3">
                    <p class="text-sm font-bold dark-blue-text">3.	Disclosure of Information</p>
                    <p class="text-sm">3.1.	We reserve the right to disclose your Collected Information to relevant authorities where we have reason to believe that such disclosure is necessary to identify, contact or bring legal action against someone who may be infringing or threatening to infringe, or who may otherwise be causing injury to or interference with, the title, rights, interests or property of <b>SG ASIA CARS</b>, our Users, customers, partners, other web site users or anyone else who could be harmed by such activities.</p>
                    <p class="text-sm">3.2.	We also reserve the right to disclose Collected Information in response to a subpoena, a rit of summons or other judicial order or when we reasonably believe that such disclosure is required by law, regulation or administrative order of any court, Governmental or regulatory authority.</p>
                    <p class="text-sm">3.3.	If we have a reason to believe that a particular user is in breach of the terms and conditions or any agreements with us, then we reserve the right to make public or otherwise disclose such user's Collect Information in order to pursue our claim or prevent further injury to <b>SG ASIA CARS</b> or others.</p>
                </div>

                <div class="space-y-3">
                    <p class="text-sm font-bold dark-blue-text">4.	Privacy of Third Party</p>
                    <p class="text-sm">4.1.	<b>SG ASIA CARS</b> cannot be held liable for the privacy/confidentiality practices employed by third party to whom we direct our visitors. The privacy policy of such parties may differ from ours, and we may not have any control over the information that you submit to such third parties or co-branded sites. We recommend that you read the confidentiality declaration on each website you visit.</p>
                </div>

                <div class="space-y-3">
                    <p class="text-sm font-bold dark-blue-text">5.	Security Measures</p>
                    <p class="text-sm">5.1.	We employ commercially reasonable security methods to prevent unauthorized access, maintain data accuracy and ensure correct use of information.</p>
                    <p class="text-sm">5.2.	No data transmission over the Internet or any wireless network can be guaranteed to be perfectly secured. As a result, while we try to protect your information, no web site or company, including ourselves, can absolutely ensure or guarantee the security of any information you transmit to us and you do so at your own risk.</p>
                </div>

                <div class="space-y-3">
                    <p class="text-sm font-bold dark-blue-text">6.	Changes to Privacy Policy</p>
                    <p class="text-sm">6.1.	We reserve the right to modify our Privacy Policy from time to time without notifying users. We recommend that you consult this Privacy Policy on a regular basis. You are deemed to have understood and agreed that all Collected Information (whether or not collected prior to or after the new policy became effective) shall be governed by the newest Privacy Policy then in effect. If you do not agree to the new changes in our Privacy Policy, you should contact <b>SG ASIA CARS</b> in writing and specifically request that we return and/or destroy all copies of all or part of your Collected Information in our possession.</p>
                </div>

                <div class="space-y-3">
                    <p class="text-sm font-bold dark-blue-text">7.	Your Feedback</p>
                    <p class="text-sm">7.1.	<b>SG ASIA CARS</b> welcome your continuous input regarding our Privacy Policy or our services provided to you. You may send us your comments and responses to our email.</p>
                </div>
            </div>
        </div>
    </div>
    @include('includes.contact-info')
@endsection
