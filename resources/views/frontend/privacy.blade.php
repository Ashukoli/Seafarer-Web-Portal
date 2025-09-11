{{-- resources/views/frontend/privacy.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Privacy Policy - Seafarer Jobs')

@push('head')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <style>
    .policy-page { font-size: 15px; line-height: 1.7; color: #333; }
    .policy-hero h1 { color: #197a91; font-size: 28px; font-weight: 700; margin-bottom: 8px; }
    .policy-card {
      background: #fff;
      padding: 22px;
      border-radius: 10px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.06);
      margin-bottom: 22px;
    }

    /* small headings inside policy */
    .policy-card h3 { color:#0f6b78; margin-top:16px; margin-bottom:8px; font-size:18px; }
    .policy-card p, .policy-card li { margin-bottom:10px; }
    .policy-card ul { padding-left:18px; margin-bottom:12px; }

    /* callout box for contact / note sections */
    .policy-callout {
      background: linear-gradient(180deg,#ffffff,#fbfbfb);
      border-left: 4px solid #197a91;
      padding: 12px 14px;
      border-radius: 8px;
      margin-top:12px;
    }

    @media (max-width:768px) {
      .policy-card { padding: 16px; }
    }
  </style>
@endpush

@section('content')
<div class="policy-page">
  <div class="container py-5">

    {{-- Header / title --}}
    <div class="policy-card policy-hero" data-aos="fade-up">
      <h1>Privacy Policy</h1>
      <p>
        This Privacy Policy describes the types of Personal Information we collect, how we use the information, with whom we share it,
        and the choices you can make about our collection, use and disclosure of your Personal Information.
      </p>
      <p>
        We, at Seafarerjobs.com are committed to respecting your online privacy and recognize your need for appropriate protection and
        management of any personally identifiable information you share with us.
      </p>
    </div>

    {{-- Full policy content: kept verbatim, preserving line breaks --}}
    <div class="policy-card" data-aos="fade-up" data-aos-delay="80">
      {!! nl2br(e("
\"Personal Information\" means any information that may be used to identify an individual, including, but not limited to, a first and last name, a home or other physical address and an email address or other contact information, whether at work or at home. This Privacy Policy incorporates by reference the Terms and Conditions for the Sites, which apply to this Privacy Policy. When you visit the Sites or provide us with information, you consent to our use and disclosure of the information we collect or receive as described in this Privacy Policy.

Please review this Privacy Policy periodically as we may update it from time to time without prior notice to reflect changes in our data practices.

The general information on Seafarerjobs.com is available without telling us who you are or revealing any Personal Information about yourself.

Information We Collect
We may obtain information about you from various sources, including our Sites, when you call or email us or communicate with us through social media, or when you participate in events, contests or other promotions. We also may obtain information about you from our parent, affiliate or subsidiary companies, business partners and other third parties and publicly available information.

The types of information we may obtain include:
Your Personal Information, if you choose to provide it or if we obtain it in the manner described above. You do not have to give us any Personal Information in order to perform job searches or to read the content portions of the Sites. Username and Password for the account you may establish on our Sites.

Payment details (including payment card number, security code, expiration date, cardholder name and billing address) if you buy products on our Sites.

Your demographic information (such as zip or postal code, occupation, education and experience, and if you choose to provide it, age, gender and race or ethnicity). We collect this information either through the registration process, from your resume or in the manner described above.

Job search behaviour and preferences, and a record of the searches that you make on our Sites. We do this in order to present you with job recommendations based on your interests as expressed previously through your searches.

Other details that you may submit to us or that may be included in the information provided to us by third parties.

We collect information stored in your social media profile that you authorize us to access when you use your social media profile to enact features on the Sites, such as the ability to pre-populate our registration form or a job application.

Seafarerjobs.com provides software applications (\"Apps\") available to the public. If you decide to download one of our Apps, we will collect your profile information, including your social network site user ID, work email address, name, city, state, social network site profile image URL, and employment history, including job titles and company names.

In addition, when you visit our Sites or use our Apps, we may collect certain information by automated means, such as cookies and web beacons, as described in more detail below.

The information we may collect by automated means includes:
Information about the devices our visitors use to access the Internet (such as the IP address and the device, browser and operating system type).

Pages and URLs that refer visitors to our Sites, also pages and URLs that visitors exit to once they leave our Sites.

Dates and times of visits to our Sites.

Information on actions taken on our Sites (such as page views, site navigation patterns and job view or application activity).

A general geographic location (such as country and city) from which a visitor accesses our Sites.

Search terms that visitors use to reach our Sites.

How We Use the Information We Collect
We may use the information we obtain about you to:

Register, manage and maintain your account on the Sites.

Provide products or services you request.

Process, validate and deliver your purchases (including by processing payment card transactions and contacting you about your orders, including by telephone).

Maintain a record of the jobs you view or apply to on our Sites.

Inform you of relevant job postings that may be of interest to you.

Provide administrative notices or communications applicable to your use of the Sites.

Respond to your questions and comments and provide customer support.

Contact you and deliver information to you that, in some cases, is targeted to your interests (such as relevant services, educational or other career development opportunities); enable you to communicate with us through our blogs, social networks and other interactive media; and solicit your feedback and input. These communications will contain links for preference management and, where appropriate, unsubscribe links should you decide you do not want to receive further communications.

Manage your participation in our events and other promotions, where you have signed up for such events and promotions.

Operate, evaluate and improve our business and the products and services we offer.

Analyse and enhance our marketing communications and strategies (including by identifying when emails we have sent to you have been received and read).

Analyse trends and statistics regarding visitors' use of our Sites, mobile applications and social media assets, and the jobs viewed or applied to on our Sites.

Protect against and prevent fraud, unauthorized transactions, claims and other liabilities, and manage risk exposure, including by identifying potential hackers and other unauthorized users.

Enforce our Sites' Terms and Conditions.

Comply with applicable legal requirements and industry standards and our policies.

We also use non-personally identifiable information and certain technical information about your computer and your access of the Sites (including your internet protocol address) in order to operate, maintain and manage the Sites.

We collect this information by automated means, such as cookies and web beacons, as described in more detail below.

Information We Share
When you apply for a job through the Sites or publicly post your resume to our resume database, employers will have access to information about you and your potential interest in employment opportunities. Those employers may use your information to contact you directly. Additionally, when you apply for a job through the Sites, the information supplied by you becomes part of the Seafarerjobs.com database but also may become part of the employer's database. Similarly, if your resume is downloaded by an employer, your resume may become a part of the employer's database. In these instances, the use of such information by the employer will be subject to the privacy policy of that company, and we are not responsible for that company's use of your information.

Other than instances where users opt to publicly post their Personal Information to our resume database, provide it via a job application, include it in a job posting or otherwise provide permission to share it, we do not sell our users' Personal Information to anyone for any reason. When posting jobs and resumes, our users decide for themselves how much contact information they wish to display. All users should be aware, however, that when they choose to display or distribute Personal Information (such as their email address or other contact information on a public resume) via the Sites or any other distribution method, that information can be collected and used by others. This may result in unsolicited messages from third parties, for which Seafarerjobs.com is not responsible We also may share Personal Information with our service providers who help us in the delivery of our own products and services to you. These service providers may only use or disclose the information as necessary to perform services on our behalf or as otherwise required by law.

Seafarerjobs.com also may disclose specific user information when we determine, in good faith, that such disclosure is necessary to comply with the law, to cooperate with or seek assistance from law enforcement, to prevent a crime or protect national security, or to protect the interests or safety of CareerBuilder or other users of the Sites.

In addition, Personal Information we have collected may be passed on to a third party in the event of a transfer of ownership or assets or a bankruptcy or other corporate reorganization of Seafarerjobs.com.

Resume Privacy Options
Seafarerjobs.com users have control to show their resume to the employers and hide their resume from certain employers. The period of showing their resume is controlled by the users themselves. The resume can be activated or de-activated at any time. The resumes are not visible to any one when the resume is not active.

When the resume is active and hidden from certain employers, the resume will be accessible to all othe employers, some of which may be the subsidiary companies of employers, from which the users has hidden the resume. Seafarerjobs.com is not responsible for such type of pass of information amongst the employers.

Once the resume is active it is viewed by the employers and their designated staff and agents and it then it becomes thier property. Seafarerjobs.com is not responsible for any unauthorized use of this information by such users.

Cookies and Other Tracking Technologies
Some of our Web pages utilize \"cookies\" and other tracking technologies. A \"cookie\" is a small text file that may be used, for example, to collect information about Web site activity. Some cookies and other technologies may serve to recall Personal Information previously indicated by a Web user. Most browsers allow you to control cookies, including whether or not to accept them and how to remove them.

You may set most browsers to notify you if you receive a cookie, or you may choose to block cookies with your browser, but please note that if you choose to erase or block your cookies, you will need to re-enter your original user ID and password to gain access to certain parts of the Web site.

Tracking technologies may record information such as Internet domain and host names; Internet protocol (IP) addresses; browser software and operating system types; clickstream patterns; and dates and times that our site is accessed. Our use of cookies and other tracking technologies allows us to improve our Web site and your Web experience. We may also analyse information that does not contain Personal Information for trends, statistics and information.

Third Party Services
Seafarerjobs.com provides some services like social sites plug-ins, blogs, news and other relevant information through third party services, which do not run on Seafarerjobs.com servers and Seafarerjobs.com does not have access to control the behaviour of such third services.Seafarerjobs.com may share the necessary information with these third party services providers in order to get the required services.

Third parties may provide certain services available on Seafarerjobs.com. 'Seafarerjobs.com' may provide information, including Personal Information, that 'Seafarerjobs.com' collects on the Web to third-party service providers to help us deliver programs, products, information, and services. Service providers are also an important means by which 'Seafarerjobs.com' maintains its Web site and mailing lists. 'Seafarerjobs.com' will take reasonable steps to ensure that these third-party service providers are obligated to protect Personal Information on Seafarerjobs.com's behalf.

'Seafarerjobs.com' does not intend to transfer Personal Information without your consent to third parties who are not bound to act on Seafarerjobs.com's behalf unless such transfer is legally required.

Your Consent
By using Seafarerjobs.com, you consent to the terms of our Online Privacy Policy and to Seafarerjobs.com's processing of Personal Information for the purposes given above as well as those explained where 'Seafarerjobs.com' collects Personal Information on the Web.

Information security We take appropriate security measures to protect against unauthorized access to or unauthorized alteration, disclosure or destruction of data. We restrict access to your personally identifying information to employees who need to know that information in order to operate, develop or improve our services.

Links to Other Websites
Our Sites may contain links to other sites for your convenience and information. These sites may be operated by companies not owned by Seafarerjobs.com. In addition, if you are using our App through a social networking site, remember that our Apps may be served by or hosted by other sites. These other sites or linked third-party sites may have their own privacy notices, which you should review if you visit those sites. We are not responsible for the content of any sites not owned by Seafarerjobs.com, any use of those sites, or those sites' privacy practices.

Update Your Account Information
You may access, update and amend Personal Information included in your online account at any time by logging into your account and making the necessary changes. You may also delete your account, including your Personal Information and any resumes from our databases at any time by logging in to your account and making an account deletion request. The account deletion request should be sent on the email address as indicated in contact us page of Seafarerjobs.com. Deleting your account will remove your Personal Information and resumes from our databases. However, if you have applied to a job in the past, that particular employer will still be able to access your resume. Further, you will not be able to delete data held by third parties, such as prospective employers, that already have accessed and downloaded your information or resume. In addition, we will retain anonymous Aggregate Data for uses described above. Please allow up to thirty days to process your account deletion request.

International Data Transfers

When we obtain Personal Information about you, we may process and store the information outside of the country in which you are located, including in the United States. The countries in which we process the information may not have the same data protection laws as the country in which you are located. Further, users who access your information, such as potential employers, also may be located in a different country than you and different laws may apply to their use of your information. Seafarerjobs.com is not responsible for use of the information by its users who act as employers, agents or their sub-agents. Persons are required to solicite with job offers with due pre-caution.

Job Offers:
Seafarerjobs.com provides the Job related information and does not act as agent between the employer and candidates. The candidates are required to examine the job offers given by the employers themselves. Seafarerjobs.com does not charge any successful recruitment fee from the employers. Seafarerjobs.com will not be responsible for any fraudulent job offers made by any one through Seafarerjobs.com information.

You should use your own careful judgment about whether and what information to provide prospective employers.

DO NOT PUT SENSITIVE INFORMATION, SUCH AS YOUR SOCIAL SECURITY NUMBER, ON YOUR RESUME.

Seafarerjobs.com is open to the public, and we cannot guarantee that all users of our services have a legitimate need to the information they seek.

Do not provide your social security number, national identification number or any state, provincial or other local identification number to a prospective employer via online application. Identity thieves may attempt to trick you into providing sensitive information. Do not provide any non-work related personal information (i.e., your social security number or any other state or national identification number, eye colour, marital status, etc.) over the phone or online.

Job seekers should never provide credit card or bank numbers or engage in a monetary transaction of any sort.

Be cautious when dealing with contacts outside of your own country.

How We Protect Personal Information
Seafarerjobs.com maintains administrative, technical and physical safeguards designed to assist us in protecting the Personal Information we collect against accidental, unlawful or unauthorized destruction, loss, alteration, access, disclosure or use.

Please note that no electronic transmission of information can be entirely secure.

We cannot guarantee that the security measures we have in place to safeguard Personal Information will never be defeated or fail, or that those measures will always be sufficient or effective. Therefore, although we are committed to protecting your privacy, we do not promise, and you should not expect, that your Personal Information will always remain private. As a user of the Sites, you understand and agree that you assume all responsibility and risk for your use of the Sites, the internet generally, and the documents you post or access and for your conduct on and off the Sites.

To further protect yourself, you should safeguard your Seafarerjobs.com account user name and password and not share that information with anyone. You should also sign off your account and close your browser window when you have finished your visit to our Sites.

Children
Children and any person below the age of 17 years are not allowed to use Seafarerjobs.com.

Seafarerjobs.com reserves the right to update, change or modify this policy at any time. The policy shall come to effect from the date of such update, change or modification.

Disclaimer Seafarerjobs.com does not store or keep credit card data in a location that is accessible via the Internet. Once a credit card transaction has been completed, all credit card data is moved off-line only to ensure that the data/credit card information received is not accessible to anyone after completion of the on-line transaction and to ensure the maximum security. Seafarerjobs.com uses the maximum care as is possible to ensure that all or any data / information in respect of electronic transfer of money does not fall in the wrong hands.

Seafarerjobs.com shall not be liable for any loss or damage sustained by reason of any disclosure (inadvertent or otherwise) of any information concerning the user's account and / or information relating to or regarding online transactions using credit cards / debit cards and / or their verification process and particulars nor for any error, omission or inaccuracy with respect to any information so disclosed and used whether or not in pursuance of a legal process or otherwise.

Contact Information 'Seafarerjobs.com' welcomes your comments regarding this privacy statement at the contact address given at the website. Should there be any concerns about contravention of this Privacy Policy, 'Seafarerjobs.com' will employ all commercially reasonable efforts to address the same.

Note : The terms in this agreement may be changed by Seafarerjobs.com at any time. Seafarerjobs.com is free to offer its services to any client/prospective client without restriction
")) !!}
    </div>

    {{-- Contact callout --}}
    <div class="policy-card" data-aos="fade-up" data-aos-delay="120">
      <div class="policy-callout">
        <strong>Contact Information</strong>
        <p style="margin:8px 0 0 0;">
          'Seafarerjobs.com' welcomes your comments regarding this privacy statement at the contact address given at the website. Should there be any concerns about contravention of this Privacy Policy, 'Seafarerjobs.com' will employ all commercially reasonable efforts to address the same.
        </p>
      </div>
    </div>

  </div> {{-- container --}}
</div> {{-- policy-page --}}
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
