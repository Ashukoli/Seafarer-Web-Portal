@extends('layouts.frontend.app')

@section('title', 'Terms & Conditions - Seafarer Jobs')

@push('head')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <style>
    /* Global sizing & readable lines */
    .terms-page { font-size: 15px; line-height: 1.7; color: #333; }
    .terms-page h1 { font-weight:700; font-size:28px; margin-bottom:18px; color:#197a91; }
    .terms-page h3 { color:#0f6b78; margin-top:18px; margin-bottom:8px; font-size:18px; }
    .terms-card {
      background:#fff;
      padding:24px;
      border-radius:10px;
      box-shadow:0 8px 24px rgba(0,0,0,0.06);
      margin-bottom:20px;
    }

    /* numbered list styling */
    .terms-card ol { padding-left: 1.1rem; margin: 0 0 12px 0; }
    .terms-card li { margin: 8px 0; }

    /* nested sublist */
    .terms-card .sublist { margin-top: 8px; padding-left: 1.1rem; }

    /* highlighted note */
    .terms-note {
      background: linear-gradient(180deg,#ffffff,#fbfbfb);
      border-left: 4px solid #197a91;
      padding: 14px 16px;
      border-radius:8px;
      margin-top:10px;
      font-size:15px;
    }

    /* responsive padding */
    @media (max-width: 768px) {
      .terms-card { padding:16px; }
    }
  </style>
@endpush

@section('content')
<div class="terms-page">
  <div class="container py-5">

    <div class="terms-card" data-aos="fade-up">
      <h1>Terms and Conditions</h1>
      <p>
        <b>There are several ways in which you can contact us for any clarifications or information that you may require.</b>
      </p>
    </div>

    <div class="terms-card" data-aos="fade-up" data-aos-delay="80">
      {{-- Core numbered clauses --}}
      <ol>
        <li>Seafarerjobs.com is a virtual meeting forum for Shipping Companies, Marine Training Institutes and Seafarers.</li>
        <li>Seafarerjobs.com does not permit posting of any incomplete, false or inaccurate resume information or information which is not your own accurate resume.</li>
        <li>Seafarerjobs.com may be used only for the lawful purpose by individuals seeking employment and employers seeking employees.</li>
        <li>Seafarerjobs.com does not permit proxy-usage, such as posting or deleting of resume or searching for candidates or accessing Seafarerjobs.com on behalf of someone else.</li>
        <li>Seafarerjobs.com does not warrant or guarantee that a resume or job description shall be viewed by any specific number of users, or that it will be viewed by any specific user or within any specific time limit.</li>
        <li>Seafarerjobs.com does not permit posting of any non-resume information such as options or notices, commercials or otherwise.</li>
        <li>Seafarerjobs.com does not permit and has not authorized any individual or firm or company or any other organization to collect any fee/charges whatsoever either for accessing Seafarerjobs.com or for posting/searching resumes or for searching for jobs.</li>
        <li>Seafarerjobs.com prohibits all communications from its competitors to any customers of Seafarerjobs.com for any purpose whatsoever.</li>
        <li>Seafarerjobs.com prohibits posting of announcements for any franchise schemes, commission schemes, membership schemes, distributorship, sales agency, liaison agency, business offers and opportunities, etc.</li>

        <li>
          User are prohibited from violating or attempting to violate the security of Seafarerjobs.com, including and without limitation.
          {{-- nested sub-items for clause 10 --}}
          <ol class="sublist" type="a">
            <li><strong>10.1</strong> Accessing data not intended for such user or logging into a server or account which such user is not permitted to access.</li>
            <li><strong>10.2</strong> Attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorization,</li>
            <li><strong>10.3</strong> Attempting to interfere with service to any user, host or network, including, without limitation, via means of overloading, "flooding", "mail bombing" or "crashing", or</li>
            <li><strong>10.4</strong> Sending unsolicited e-mail, including promotions and/or advertising of products or services, or</li>
            <li><strong>10.5</strong> Forgiving any TCP/IP packet header or any part of the header information in any e-mail or newsgroup posting. Seafarerjobs.com shall initiate civil or criminal proceedings against such violations of system or network security.</li>
          </ol>
        </li>

        <li>Seafarerjobs.com prohibits revision or deletion of any material posted by any other person or firm or company or organization. Such acts are illegal and Seafarerjobs.com and/or the concerned entity shall initiate civil and criminal legal proceedings against any person or firm or company or organization indulging in such activities.</li>

        <li>
          Seafarerjobs.com, at present, does not levy any charges from experienced seafarers either for posting resume or for scanning the site for job vacancies, however, Seafarerjobs.com reserves all rights to charge any fee for any of its services as and when it deems fit. Seafarerjobs.com charges for database maintenance and additional services from Candidates having no sailing experience. The charges levied by Seafarerjobs.com is only for maintaining the records in database and renting the software for various services. This does not in anyway guarantee employment by any company. Seafarerjobs.com will not be liable to pay any claims in this regard. The money paid for any of the Seafarerjobs.com services is NON-REFUNDABLE.
        </li>
      </ol>

      {{-- Note as bullets as requested --}}
      <div class="terms-note" data-aos="fade-left" data-aos-delay="120">
        <strong>Note:</strong>
        <ul style="margin-top:8px; padding-left:18px;">
          <li>All Basic services are free for Seafarers with sailing experience.</li>
          <li>Service charges will be levied only from candidates without sailing experience.</li>
        </ul>
      </div>
    </div>

    {{-- The longer "Express Seafarer Services" and other policy sections kept intact, each as their own card for readability --}}
    <div class="terms-card" data-aos="fade-up" data-aos-delay="160">
      <h3>Express Seafarer Services: Highlight Resume</h3>

      <p>
        • In case necessary inputs required by us for commencing the services are not received by us within 30 days of the payment, the order shall stand cancelled and the any amounts paid shall be appropriated.
      </p>

      <p>
        • The payment for service once subscribed to/ by the subscriber is not refundable and any amount paid shall stand appropriated.
      </p>

      <p>
        • The amount paid entitles the subscriber alone to the service by Seafarerjobs.com for a period of subscription opted for from the date of up-linking of the resume on the website Seafarerjobs.com or such other mirror or parallel site(s) as Seafarerjobs.com may deem fit and proper but such web host shall be without any extra cost to the subscriber / user.
      </p>

      <p>
        • Through this service your resume is also made a part of Seafarerjobs.com's proprietary database, accessed only by companies/recruiter registered with us. Please log into your account and set the visibility of the resume as desired by you, here you can selectively block a company/recruiter from accessing your resume.
      </p>

      <p>
        • Seafarerjobs.com offers neither guarantee nor warranties that there would be a satisfactory response or any response at all once the resume is put on display.
      </p>

      <p>
        • Seafarerjobs.com neither guarantees nor offers any warranty about the credentials of the prospective employer/organization which downloads the information and uses it to contact the prospective employee / visitor / user / subscriber.
      </p>

      <p>
        • Seafarerjobs.com would not be held liable for loss of any data technical or otherwise, and particulars supplied by subscribers due to reasons beyond its control like corruption of data or delay or failure to perform as a result of any causes or conditions that are beyond Seafarerjobs.com's reasonable control including but not limited to strikes, riots, civil unrest, Govt. policies, tampering of data by unauthorized persons like hackers, war and natural calamities.
      </p>

      <p>
        • It shall be the sole prerogative and responsibility of the individual to check the authenticity of all or any response received pursuant to the resume being displayed by Seafarerjobs.com for going out of station or in station for any job / interview and Seafarerjobs.com assumes no responsibility in respect thereof.
      </p>

      <p>
        • Seafarerjobs.com reserves its right to reject any insertion or information/data provided by the subscriber without assigning any reason either before uploading or after uploading the vacancy details, refund if any shall be on a pro-rata basis at the sole discretion of Seafarerjobs.com.
      </p>

      <p>
        • Seafarerjobs.com will commence providing services only upon receipt of amount/charges upfront either from subscriber or from a third party on behalf of the subscriber.
      </p>

      <p>
        • This subscription is not transferable i.e. it is for the same person throughout the period of subscription.
      </p>

      <p>
        • Seafarerjobs.com has the right to make all such modifications/editing of resume in order to fit the resume in its database.
      </p>

      <p>
        • The liability, if any, of Seafarerjobs.com is limited to the extent of the amount paid by the subscriber.
      </p>

      <p>
        • The subscriber shall be assigned password(s) by Seafarerjobs.com to enable the subscriber to access all the information received through its site Seafarerjobs.com, but the sole responsibility of the safe custody of the password shall be that of the subscriber and Seafarerjobs.com shall not be responsible for data loss/theft or data/corruption or the wrong usage/misuse of the password and any damage or leak of information and its consequential usage by a third party. Seafarerjobs.com undertakes to take all reasonable precautions at its end to ensure that there is no leakage/misuse of the password granted to the subscriber
      </p>

      <p>
        • The subscriber undertakes that the data/information provided by him is true and correct in all respects.
      </p>

      <p>
        • The User of these services does not claim any copyright or other Intellectual Property Right over the data uploaded by him/her on the website
      </p>

      <p>
        • Registration presumes that the users have read, understood and accepted the terms and conditions.
      </p>
    </div>

    <div class="terms-card" data-aos="fade-up" data-aos-delay="200">
      <h3>Resume Blaster</h3>

      <p>
        • The payment for service once subscribed to by the subscriber is not refundable and any amount paid shall stand appropriated.
      </p>

      <p>
        • After submitting your resume by using resume blaster service to recruiter, the jobseeker cannot resubmit his resume to the same recruiter till the period of subscription.
      </p>

      <p>
        • Seafarerjobs.com offers no guarantee nor warranties that there would be a satisfactory response or any response at all once the resume is sent to recruiter database subscribed to.
      </p>

      <p>
        • The amount paid entitles the subscriber alone to the service by Seafarerjobs.com for a period of subscription opted for from the date of up-linking of the resume on the website Seafarerjobs.com or such other mirror or parallel site(s) as Seafarerjobs.com may deem fit and proper but such web host shall be without any extra cost to the subscriber / user.
      </p>

      <p>
        • Through this service your resume is also made a part of Seafarerjobs.com's proprietary database, accessed only by companies/recruiter registered with us. Please log into your account and set the visibility of the resume as desired by you, here you can selectively block a company/recruiter from accessing your resume.
      </p>

      <p>
        • Seafarerjobs.com offers neither guarantee nor warranties that there would be a satisfactory response or any response at all once the resume is put on display.
      </p>

      <p>
        • Seafarerjobs.com neither guarantees nor offers any warranty about the credentials of the prospective employer/organization which downloads the information and uses it to contact the prospective employee / visitor / user / subscriber.
      </p>

      <p>
        • Seafarerjobs.com would not be held liable for loss of any data technical or otherwise, and particulars supplied by subscribers due to reasons beyond its control like corruption of data or delay or failure to perform as a result of any causes or conditions that are beyond Seafarerjobs.com's reasonable control including but not limited to strikes, riots, civil unrest, Govt. policies, tampering of data by unauthorized persons like hackers, war and natural calamities.
      </p>

      <p>
        • It shall be the sole prerogative and responsibility of the individual to check the authenticity of all or any response received pursuant to the resume being displayed by Seafarerjobs.com for going out of station or in station for any job / interview and Seafarerjobs.com assumes no responsibility in respect thereof.
      </p>

      <p>
        • Seafarerjobs.com reserves its right to reject any insertion or information/data provided by the subscriber without assigning any reason either before uploading or after uploading the vacancy details, refund if any shall be on a pro-rata basis at the sole discretion of Seafarerjobs.com.
      </p>

      <p>
        • Seafarerjobs.com will commence providing services only upon receipt of amount/charges upfront either from subscriber or from a third party on behalf of the subscriber.
      </p>

      <p>
        • This subscription is not transferable i.e. it is for the same person throughout the period of subscription.
      </p>

      <p>
        • Seafarerjobs.com has the right to make all such modifications/editing of resume in order to fit the resume in its database.
      </p>

      <p>
        • The liability, if any, of Seafarerjobs.com is limited to the extent of the amount paid by the subscriber.
      </p>

      <p>
        • The subscriber shall be assigned password(s) by Seafarerjobs.com to enable the subscriber to access all the information received through its site Seafarerjobs.com, but the sole responsibility of the safe custody of the password shall be that of the subscriber and Seafarerjobs.com shall not be responsible for data loss/theft or data/corruption or the wrong usage/misuse of the password and any damage or leak of information and its consequential usage by a third party. Seafarerjobs.com undertakes to take all reasonable precautions at its end to ensure that there is no leakage/misuse of the password granted to the subscriber
      </p>

      <p>
        • The subscriber undertakes that the data/information provided by him is true and correct in all respects.
      </p>

      <p>
        • The User of these services does not claim any copyright or other Intellectual Property Right over the data uploaded by him/her on the website
      </p>

      <p>
        • Registration presumes that the users have read, understood and accepted the terms and conditions.
      </p>
    </div>

    <div class="terms-card" data-aos="fade-up" data-aos-delay="240">
      <h3>SMS Job Alert / WAP / Subscription Services / Miscellaneous</h3>

      <p>
        The subscriber availing this service shall be deemed to have consented to be bound by all the applicable terms and conditions of this service.
        Decision of seafarerjobs.com regarding all transactions under this service shall be final and binding and no correspondence shall be entertained in this regard.
        seafarerjobs.com reserves the right to extend, cancel, discontinue, prematurely withdraw, change, alter or modify this service or any part thereof including charges, at its sole discretion at anytime as may be required in view of business exigencies and/or regulatory or statutory changes.
      </p>

      <p>
        Your mobile phone number (MSISDN) will be used during the transmission of text messages through the mobile service provider's server for SMS Service.
        The membership is for your personal use only. You cannot transfer, assign or authorize your membership to any other person.
        The subscriber understands that he/she can avail SMS Services at his/her discretion and the said service shall be availed in such options as are made available by seafarerjobs.com from time to time.
        This service is subject to guidelines/directions issued by Telecom Regulatory Authority of India or any other statutory authority from time to time.
        The SMS or its contents once sent for availing the SMS services shall be treated as final and the same cannot be withdrawn, changed or retrieved subsequently under any circumstances.
      </p>

      <p>
        WAP Services enable you to access our Services and to submit and/or receive Content through your wireless Device. Your access to our WAP Services may be dependent on the wireless Device you use to access the applicable WAP services.
        Subscription Services provide you with access to certain Content for a selected period of time, which will be as indicated and chosen by you prior to purchase. The frequency with which you will receive the relevant Content will be notified to you at the time you subscribe for the service.
      </p>

      <p>
        You will not post or transmit any content that is abusive, obscene, sexually oriented or against national interest. seafarerjobs.com reserves the right to suspend your profile if any prohibitive or objectionable content is found and may further initiate appropriate legal proceedings against you.
      </p>

      <p>
        The Service is an additional service offered by seafarerjobs.com. The functions of the Service are dependent on the Operator owning the network to facilitate this service (Operator), for which seafarerjobs.com does not undertake any responsibility for failure of this network transmission or failure of message transmission for any reasons whatsoever. From time to time, seafarerjobs.com may include additional features and services.
      </p>

      <p>
        seafarerjobs.com reserves the right to modify/delete the profile contents at its own discretion without prior notice if the contents of profile are deemed unfit for broadcast.
        seafarerjobs.com is not responsible for authenticity of the content arising thereto.
      </p>

      <p>
        The subscriber must maintain such minimum balance in his/her prepaid account as is specified by seafarerjobs.com for availing the particular option offered under these services. All incidental costs/taxes/levies, if any, related to the VAS shall be entirely borne by the customer.
      </p>

      <p>
        The users specifically note and agree that the content and service or part thereof may be varied, added, withdrawn, withheld or suspended by seafarerjobs.com at its sole discretion without prior notice to the users.
        seafarerjobs.com shall not be liable for any costs, loss or damage (whether direct or indirect), or for loss of revenue, loss of profits or any consequential loss whatsoever as a result of the user using the Service.
        No reversal of deducted charges shall be allowed under any circumstances.
      </p>

      <p>
        The users shall remain solely responsible for all content, information, data originated from the users and transmitted via the Service (content), and the users shall accordingly indemnify seafarerjobs.com and / or the Operator, against all third party claims relating to the users content or due to the users act, negligence or omission.
      </p>

      <p>
        You are bound by the terms and conditions as mentioned herein and as stated on the site.
        Message delivery is conditional to Mobile operator's technical infrastructure and its network uptime.
        By using various SMS based services from seafarerjobs.com like Job Search, Job Alert, Career services etc , you agree to receive phone calls, messages etc. from seafarerjobs.com and/or its associates tailored to provide with better job opportunities.
      </p>

      <p>
        Subscribing or using various paid/free services of seafarerjobs.com on SMS/Voice/WAP either directly or indirectly doesn't in any manner guarantee the user a job.
      </p>

      <p>
        seafarerjobs.com and/or its respective suppliers make no representations about the suitability, reliability, availability, timeliness, lack of viruses or other harmful components and accuracy of the information, software, products, services and related graphics contained within the, Seafarerjobs.com sites/services for any purpose. All such information, software, products, services and related graphics are provided "as is" without warranty of any kind. seafarerjobs.com and/or its respective suppliers hereby disclaim all warranties and conditions with regard to this information, software, products, services and related graphics, including all implied warranties and conditions of merchantability, fitness for a particular purpose, workmanlike effort, title and non-infringement. Seafarerjobs.com shall not be responsible or liable for any consequential damages arising thereto.
      </p>

      <p>
        By agreeing to register at seafarerjobs.com, a user allows seafarerjobs.com to get in touch with him/her from time to time on events or offers regarding jobs and ancillary services on mobile. This can include exciting offers, information, as well as promotions.
      </p>

      <p>
        The subscriber shall comply with all directions/instructions etc. issued by the Company relating to the network, the services and any/all matters connected therewith and provide the Company all other and further information and co-operation as the Company may require from time to time.
        Registration presumes that the users have read, understood and accepted the terms and conditions.
      </p>

      <p>
        This service is live in India only.
      </p>
    </div>

    <div class="terms-card" data-aos="fade-up" data-aos-delay="280">
      <h3>60 Days Combo Plan - Money Back Guarantee (Highlight Resume + Resume Blaster + SMS Job Alert)</h3>

      <p>
        • In addition of terms and condition mentioned above for Highlight Resume + Resume Blaster + SMS Job Alert, payment for service once subscribed to/ by the subscriber can request for Money back If less than 3 company have viewed his resume during the subscription period.
      </p>

      <p>
        • The subscriber need to claim the Money Back within 48 hrs after the subscription period is expired by submitting the online Money Back Request form, No claim will be entertained if Money Back request is made after 48hrs expiry of subscription period.
      </p>

      <p>
        • The management has a right to decide whether refund to be initiated or the Combo plan to be renewed for 60 days without any extra charges. This will be initiated by sending email to subscriber on her/his registered email id. Once Combo plan is renewed the subscriber cannot request for Money Back.
      </p>

      <p>
        • If the seafarerjobs.com management decide for Money Back to subscriber, refund will be made within 45 working days to the same bank account though which we received the payment.
      </p>

      <p>
        • Refundable amount will be Combo Plan subscription amount excluding GST amount if any and 10% Service charge.
      </p>

      <p>
        • Registration presumes that the users have read, understood and accepted the terms and conditions.
      </p>

      <p>
        Note: If you would like to stop the service before the due date, please write an email to info@seafarerjobs.com
      </p>

      <p>
        13. Unsolicited e-mail, telephone calls, mailing or other contacts to posting individuals and companies are strictly prohibited. Users may not use Seafarerjobs.com in order to transmit, distribute, store or destroy material:
      </p>

      <ol>
        <li>in violation of any applicable law or regulation</li>
        <li>in a matter that will infringe the copyright, trademark, trade secret or other intellectual property rights of others, or violate the privacy or publicity or other personnel rights of others, or</li>
        <li>that is libelous, obscene, threatening, abusive or hateful.</li>
      </ol>

      <p>
        Users are hereby informed and advised that personally identifiable information posted to Seafarerjobs.com is not confidential and may be viewed by anyone with access to Seafarerjobs.com.
      </p>

      <p>
        Seafarerjobs.com cannot lay or enforce its rules against all third party users. Therefore users of Seafarerjobs.com may get unsolicited communication from anyone for any purpose. Seafarerjobs.com users should deal with such things on their own. Seafarerjobs.com, its owners, officers and other associates are not responsible in any way for any such unsolicited communication or their consequences and also not liable to pay any compensation or damage, whatsoever. If any user wants Seafarerjobs.com to remove his/her posting, he/she should send a specific request by registered mail to Seafarerjobs.com, clearly marked "Privacy-Urgent".
      </p>

      <p>
        Seafarerjobs.com does not permit minors to access this site for any purpose, whatsoever.
      </p>
    </div>

  </div> {{-- container --}}
</div> {{-- terms-page --}}
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (window.AOS) {
        AOS.init({ once: true, duration: 700, easing: 'ease-in-out' });
      }
    });
  </script>
@endpush
