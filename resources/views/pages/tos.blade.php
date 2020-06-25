@extends('layouts.master')

@section('title', 'Terms & Policies')

@section('content')
    <style>
        .privacy-content h1 {
            font-size: 38px;
            font-family: Montserrat;
        }
        .privacy-content h2 {
            font-size: 18px;
        }
        .privacy-content table tr td p {
            padding-left: 10px;
            padding-right: 10px;
            box-sizing: border-box;
        }
    </style>



    <?php $rname = Route::getCurrentRoute()->getActionName(); ?>
    <div class="main-wrapper">
        <div class="user-detail-wrap terms-of-services">

            <div class="nav-tabs-wrap">
                <div class="container-fluid coutomwidth">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tos" aria-controls="tos" role="tab" data-toggle="tab"><span class="notification"><img src="//www.muzbnb.com/images/Terms of Service.png" alt="Terms of service"></span>Terms of Services</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#np" aria-controls="np" role="tab" data-toggle="tab">
                                <span class="notification">
                                    <img src="//www.muzbnb.com/images/Nondiscrimination Policy.png" alt="Nondiscrimination Policy"></span>
                                Nondiscrimination<br> Policy
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#grp" aria-controls="grp" role="tab" data-toggle="tab">
                                <span class="notification">
                                    <img src="//www.muzbnb.com/images/Guest Refund.png" alt="Guest Refund Policy"></span>
                                Guest Refund<br> Policy
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#mpp" aria-controls="mpp" role="tab" data-toggle="tab"><span class="notification"><img src="//www.muzbnb.com/images/Privacy Policy.png" alt="Privacy Policy"></span>Privacy<br> Policy</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#pt" aria-controls="pt" role="tab" data-toggle="tab"><span class="notification"><img src="//www.muzbnb.com/images/Payments TOS.png" alt="Payments Terms"></span>Payments<br> Terms</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#cp" aria-controls="cp" role="tab" data-toggle="tab"><span class="notification"><img src="images/Copyright.png" alt="Copyright/Cookies Policy"></span>Copyright/Cookies<br> Policy</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tos">
                    <div class="privacy-content">
                        <h1>Muzbnb Terms of Service</h1>
                        <p><em>effective as of 10<sup>th</sup> of December 2017</em></p>
                        <p>This Terms of Service Agreement explains the terms and conditions under which you are able to use services provided by Muzbnb. Please read carefully this Terms of Service document, and keep a copy of it for your reference.</p>
                        <p>By accessing our website(s), our services or accessing any content that is made available by Muzbnb you express your agreement to be legally bound by our Terms of Service stated in this document, so please read these terms carefully before using our services as you are entering into a binding contract with Muzbnb. If you do not agree with (or cannot comply with) the terms and conditions set forth below, do not use or access our services.</p>
                        <p>Some parts of our Platform may be subject to additional terms and policies. These Terms do not interfere with any obligation or authorization provided in any other agreement concluded between you and Muzbnb.</p>
                        <h2>1.Definitions</h2>
                        <p>1.1 The following definitions explain some of the terminology and abbreviations used throughout our Terms of Service Agreement:</p>
                        <p>&lsquo;<strong>Terms/Agreement</strong>&rsquo; refers to the latest version of this Terms of Service Agreement document.</p>
                        <p>&lsquo;<strong>Site</strong>&rsquo; refers to any and all websites provided by Muzbnb, available at &lt;https://www.muzbnb.com/&gt; or any other url which may host Muzbnb websites or Services.</p>
                        <p>&lsquo;<strong>App</strong>&rsquo; refers to the mobile, tablet and other smart device applications of the Muzbnb.</p>
                        <p>&lsquo;<strong>Services</strong>&rsquo; refers to the functionality of the Site and the App, and availability of the content provided by Muzbnb and User Generated Content.</p>
                        <p>&lsquo;<strong>Platform</strong>&rsquo; refers to Site, App, and Services collectively.</p>
                        <p>&lsquo;<strong>User/You</strong>&rsquo; refers to any person using our Services or accessing the Site.</p>
                        <p>&lsquo;<strong>We/Us/Muzbnb</strong>&rsquo; refers to Muzbnb, 14-J Laurel Hill Rd, Greenbelt, Maryland 20770, United States, the Site, the App, and their developers and affiliates.</p>
                        <p>&lsquo;<strong>Host</strong>&rsquo; refers to the User who lists the accommodation or other services through the Platform.</p>
                        <p>&lsquo;<strong>Guest</strong>&rsquo; refers to the User who books the accommodation or other services through the Platform.</p>
                        <p>&lsquo;<strong>Listing</strong>&rsquo; refers to the services offered by Hosts through the Platform including but not limited to accommodations, tours and other activities.</p>
                        <p>&lsquo;<strong>Service Fee</strong>&rsquo; refers to the fees charged by the Muzbnb in relation to the Services.</p>
                        <p>&lsquo;<strong>Privacy Policy</strong>&rsquo; refers to Privacy Policy document governing the rules of collecting, using and storing information provided by Users.</p>
                        <p>&lsquo;<strong>Outside source</strong>&rsquo; refers to any application, website, natural or legal entity other than Muzbnb or their affiliates.</p>
                        <p>&lsquo;<strong>Content</strong>&rsquo; refers to all images, text, audio and video data or any other information located on the Site or in the App.</p>
                        <p>&lsquo;<strong>User Generated Content</strong>&rsquo; refers to the Content provided by the Users.</p>
                        <h2>2. Scope of the Services</h2>
                        <p>2.1 Muzbnb offers a Platform for Users to list and to book accommodations and other services. Muzbnb is only provider of the marketplace for the services, and Muzbnb will in no way be considered as the owner, seller, lessor, lessee, manager, controller or supplier of the services contained in the Listings. Ass such services are to be provided by the Host, and utilized by the Guest or persons accompanying the Guest.</p>
                        <p>2.2 Muzbnb cannot guarantee or warrant that the Services will meet your requirements or be available on an uninterrupted, secure, or error-free basis.</p>
                        <h2>3. Eligibility and Registration</h2>
                        <p>3.1 By registering for the use of the Services, you confirm that you are at least 18 years of age. If you register on behalf of a legal entity, you further confirm that (i) you have the appropriate authorization to accept the terms of this Agreement, (ii) you have the appropriate authorization to bind such legal entity by accepting this Agreement, (iii) legal entity on behalf of whom you accept this Agreement has full power to enter into this agreement and to perform obligations as defined herein. By accessing the Site, downloading the App, or using our Services, you confirm that you will not use the Platform contrary to these Terms or applicable laws.</p>
                        <p>3.2 We may not control who uses the Platform, so it is upon you to assess whether using the Platform is in compliance with any local laws and regulations. Whenever you are using our Platform you will need to comply with these Terms and any applicable laws, regulations and policies. If any part of the Platform is not in compliance with your local laws, you may not use the Platform. In case your use of the Platform is against local laws or policies, the Platform will be considered as &lsquo;not available in your region&rsquo;.</p>
                        <p>3.3 Some of the Services provided are only available to registered Users. Some parts of the Platform are available only pursuant to fulfillment of additional requirements such as feedback score, number of bookings, verified identity, etc. You are able to register on the Site or through the App either as a Host or as a Guest, by completing the appropriate registration forms or through your verified third party social network account such as Facebook, Twitter, LinkedIn, or Google +. During the registration process you will be asked to provide some personal information, the collection, use, and storage of which is regulated by our Privacy Policy document and applicable laws. Users are required to provide true, accurate, current and complete information about themselves as prompted by registration form provided. You agree to update your information should there be any changes, in order to keep registered information true, accurate, current and complete. If you provide information contrary to aforementioned conditions, we may deny you or terminate your access to parts of our Services. We are not responsible for any failure in providing the Services which results from information that is not true, accurate, current and complete.</p>
                        <p>3.4 Muzbnb has the right but not the obligation to request proof of identity in order to verify User&rsquo;s account. In addition to verification of the account, in order to increase the safety and prevent fraud, we may, in accordance with appropriate laws, (i) request to see any form of government issued identification document, (ii) run a background check against third party databases or (iii) obtain public records reports on criminal history or sex offender registration.</p>
                        <p>3.5 You may only register one (1) account, unless authorized otherwise by Muzbnb in writing. You understand that it is your responsibility to keep your log in information confidential. You are responsible for all activity under your account. If you ever find out or suspect that someone accessed your account without authorization, you are advised to inform us immediately.</p>
                        <h2>4. Service Fees</h2>
                        <p>4.1 Muzbnb may charge fees for the use of the Platform. Service Fees may be charged to Hosts and Guests depending on the use of the Platform. More information about the Service Fees can be found on our Service Fees page here.</p>
                        <p>4.2 All Service Fees will be displayed on the Site prior to taking the action which is subject to Service Fee payment, such as listing or booking an accommodation.</p>
                        <p>4.3 Muzbnb reserves the right to amend Service Fees or to institute new fees at any time upon reasonable notice posted in advance on the Site.</p>
                        <h2>5. Contact</h2>
                        <p>5.1 By allowing us access to your e-mail address, you agree that we may contact you using such contact information, for any matters relating to the Services (<strong>Service e-mails</strong>). These e-mails do not constitute &ldquo;unsolicited commercial e-mail advertisements&rdquo; and you are not able to opt-out of receiving them. We may also inform you through e-mail about content, promotions, special offers and or other topics of interest related to the&nbsp;Muzbnb&nbsp;and our affiliates (<strong>Promotional e-mails</strong>). You may choose to stop receiving these promotional e-mails at any time by following the instructions contained in promotional e-mails.</p>
                        <p>5.2 If you have any question or suggestion you can contact us at salaam@muzbnb.com.</p>
                        <h2>6. Acceptable Use Policy</h2>
                        <p>6.1 You agree that you will not misuse our Services. A misuse constitutes any use, access or interference with the Platform contrary to Terms, Privacy Policy and applicable laws and regulations. We can, in our sole discretion, suspend or terminate access to all or parts of the Services to any User, without prior notice or need to deliberate on reasons for such measure. We reserve the right to deny Services to anyone at any time. During your use of our Services, you will not behave contrary to the Terms, Policies, applicable laws and regulations, and you will especially not, without limitation, do any of the following:</p>
                        <p>(i) send or otherwise post unauthorized commercial communications (such as spam) through the Platform;</p>
                        <p>(ii) collect Users' content or information, or otherwise access the Platform using automated means (such as harvesting bots, robots, spiders, or scrapers) without our permission;</p>
                        <p>(iii) upload viruses or other malicious code;</p>
                        <p>(iv) bully, intimidate, or harass any other User;</p>
                        <p>(v) post or transmit content which is illegal, hateful, obscene, threatening, incites violence, insulting, defamatory, infringing of intellectual property rights, invasive of privacy, or contains graphic or gratuitous violence or is otherwise objectionable to third parties;</p>
                        <p>(vi) harass, threaten, embarrass or cause distress or discomfort upon another individual or entity or impersonate any other person or entity or otherwise restricting or inhibiting any other person from using or enjoying the Platform;</p>
                        <p>(vii) take any action creating a disproportionately large usage load on our Site unless expressly permitted by Muzbnb;</p>
                        <p>(viii) create more than one account or share your account with anyone;</p>
                        <p>(ix) post or transmit content that is misleading.</p>
                        <p>(x) communicate any information or content that you do not have a right to make available under any law or under contractual or fiduciary relationships, or otherwise infringes or violates someone else's rights;</p>
                        <p>(xi) encourage participation in or promote any contents, pyramid schemes, surveys, chain letters or spamming, or unsolicited emailing through the Platform;</p>
                        <p>(xii) post or transmit hyperlinks to other websites that violate these Terms;</p>
                        <p>(xiii) facilitate or encourage any violation of these Terms.</p>
                        <p>6.2 Users are solely responsible for their own content and the consequences of making the content available to third-parties.</p>
                        <p>6.3 You should report to the authorities and Muzbnb any User that behaves inappropriately, including without limiting (i) engaging in illegal activities (ii) or engaging in offensive, violent or sexually inappropriate behavior.</p>
                        <h2>7. Intellectual property rights</h2>
                        <p>7.1 The copyright and all intellectual property rights in the Site and App belong to Muzbnb or are used with appropriate permissions. It includes design, all database rights, trademarks, text, graphics, code, file and links, service marks, and the selection and set up thereof. All rights are reserved.</p>
                        <p>7.2 Subject to your compliance with these Terms, we grant you a limited, non-exclusive, non-transferable, non-sub licensable license to access and use the Site, the App, and other Content provided by Muzbnb. Except as expressly permitted in these Terms, you may not: copy, modify or create derivative works based on the Site, the App, and their Content; distribute, transfer, sublicense, lease, lend or rent the Site, the App, or their Content to any third party; reverse engineer, decompile or disassemble the Site or the App; or make the functionality of the Site or the App available to multiple users through any means.</p>
                        <h2>(A) Notification of infringement</h2>
                        <p>7.3 If you believe that your work has been copied in a way that constitutes copyright infringement, or your intellectual property rights have been otherwise violated, please provide the following information to the Site&rsquo;s Copyright Agent:</p>
                        <p>1. An electronic or physical signature of the person authorized to act on behalf of the owner of the copyright or other intellectual property interest;</p>
                        <p>2. A description of the copyrighted work or other intellectual property that you claim has been infringed;</p>
                        <p>3. A description of where the material that you claim is infringing is located on the Site or the App;</p>
                        <p>4. Your name, address, telephone number and e-mail address;</p>
                        <p>5. A signed statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law; and</p>
                        <p>6. A statement by you, made under penalty of perjury, that the information provided in your Notice is accurate and that you are the copyright or intellectual property owner or authorized to act on the copyright or intellectual property owner&rsquo;s behalf.</p>
                        <p>7.4 Our copyright agent can be reached as follows:</p>
                        <p>Email: Salaam@muzbnb.com</p>
                        <h2>(B) User Generated Content</h2>
                        <p>7.5 If you post content on or through the Site or the App, you grant us a non-exclusive, royalty-free, perpetual, irrevocable right to use, reproduce, modify, adapt, publish, distribute, and display such User Generated Content on the Site, the App, and on any other marketing material we may create. Whenever we might use the User Generated Content we will give appropriate credit to the content provider through their name.</p>
                        <p>7.6 Users are able to leave reviews and comments regarding their experience with specific Hosts, Guests and accommodations. We may publish such reviews and comments on the appropriate page for the purpose of informing other Users on previous experiences. We reserve the right to refuse to publish, to remove or amend the reviews and comments from Users, at our sole discretion.</p>
                        <p>7.7 We aim to provide a safe space for all our Users. However, considering how we do not monitor User Generated Content, you agree to inform us immediately if you come across any illegal activity, activity that is in breach of these Terms, or activity you suspect might be in violation of these Terms or applicable laws or might otherwise be objectionable. Although we expressly prohibit posting of any User Generated Content which is illegal, hateful, obscene, threatening, incites violence, insulting, defamatory, infringing of intellectual property rights, invasive of privacy, or contains graphic or gratuitous violence or is otherwise objectionable to third parties, we do not pre-screen the content, so you hereby agree that you may be exposed to any such content and that you use the Platform at your own risk. We reserve the right to remove any content that we find to constitute a breach of these Terms or relevant laws, without notifying the Users or providing reasoning for such action. You recognize and concur that Muzbnb bears no obligation regarding the risk, harm, damage, or loss that might emerge from content submitted to or distributed on the Site and App. You further understand that by providing your content online, other people will have access to such content and they will be able to copy, share or otherwise interact with such content. If you do not want your content to be used as described the only remedy is to not share your content.</p>
                        <h2>(C) Third party content</h2>
                        <p>7.8 Some content on the Site, such as advertisement, may be provided by the Outside Sources. We are not responsible for such content, nor do we monitor or control content provided by Outside Sources.</p>
                        <h2>8. Third Party Services</h2>
                        <p>8.1 The Services may be made available or accessed in connection with third party services and content (including advertising) that Muzbnb does not control. We may also provide you with links leading to the Outside Sources. You acknowledge that different Terms of Service and privacy policies may apply to your use of such third party services and content. Muzbnb does not endorse such third party services and content and in no event shall Muzbnb be responsible or liable for any products or services of such third party providers.</p>
                        <p>8.2 Our Services may be used in connection with third-party services such as Facebook, Twitter, Google +, and other. In that sense your interaction with the Platform is further regulated by the third-party&rsquo;s respective terms and privacy policies. Muzbnb is not sponsored, endorsed, organized or in any other way supported by these third-parties.</p>
                        <h2>9. Additional Terms for Hosts</h2>
                        <p>9.1 If you choose to create a Listing on the Platform you must (i) provide true, accurate and complete information about the Listing, such as description, availability, location; (ii) provide sufficient information on any deficiency or special requirement of your listing including, but not limited to accessibility, necessary security deposit, house rules, age restrictions, pets restrictions, noise, smell and vibrations. You understand that it is your responsibility to keep all information about the Listing true, accurate and complete at all times.</p>
                        <p>9.2 If you upload images or video to the Platform, you understand that these images and vides must represent the listing truthfully and accurately. We may require a minimum number of images or videos for each listing.</p>
                        <p>9.3 When providing a listing through our Platform you will be able to set a price for your listing. You may change the listing price up until the moment a Guest has requested to book the accommodation. You may not charge the Guest more than what the price was in the moment of the booking request.</p>
                        <p>9.4 Once you accept Guest&rsquo;s booking request you are entering into a legally binding relationship with the Guest.</p>
                        <p>9.5 Hosts are able to list only one accommodation in one Listing. One Listing may include additional services such as tours, food and activities. Muzbnb may refuse to post Host&rsquo;s additional services if we, in our sole discretion, decide that such service is not in compliance with our terms, policies and quality standards.</p>
                        <h2>10. Additional Terms for Guests</h2>
                        <p>10.1 Users are able to book the Listing available on the Platform pursuant to compliance with any requirement set forth by Muzbnb or Hosts and payment of the Booking Fee. Booking Fee includes any listing fees, security deposits if requested, and applicable taxes. Booking Fee will be displayed to the Guest prior to the confirmation of the booking.</p>
                        <p>10.2 Once the booking is accepted, you are entering into a legally binding relationship with the Host.</p>
                        <p>10.3 If you are booking the Listing on behalf of additional Guests, you confirm and guarantee that any additional guest complies with these terms, our policies and any additional requirements set forth by the Host.</p>
                        <p>10.4 You further agree to use the services offered by the Host in a manner that is agreed upon, including time of arrival, time of leaving the premises, compliance with Host&rsquo;s requirements, payment of additional fees etc. You are responsible for leaving the accommodation in the same or better conditions that it was when you arrived.</p>
                        <h2><strong>11. Booking Modification</strong></h2>
                        <p>11.1 Users may amend their booking information pursuant to agreement between a Host and a Guest, and payment of any additional fees.</p>
                        <p>11.2 Guests may cancel their booking in accordance with the Listing&rsquo;s cancelation policy, and may receive full or partial refund if available according to such Listing&rsquo;s refund policy.</p>
                        <p>11.3 In the event that Host cancels a confirmed booking, Guest shall receive the full refund and the Host may receive automated review.</p>
                        <h2>12. Indemnity</h2>
                        <p>12.1 You will indemnify and hold harmless Muzbnb, and its employees and affiliates, from and against any claims, disputes, demands, liabilities, damages, losses, and costs and expenses, including, without limitation, reasonable legal and accounting fees arising out of or in any way connected with your access to or use of the Site and our Services, content which you provide, or your violation of these Terms.</p>
                        <h2>13. Limitation of liability</h2>
                        <p>13.1 YOU AGREE THAT, TO THE EXTENT PERMITTED BY APPLICABLE LAW, YOUR SOLE AND EXCLUSIVE REMEDY FOR ANY PROBLEMS OR DISSATISFACTION WITH THE MUZBNB SERVICE IS TO STOP USING THE MUZBNB SERVICES.</p>
                        <p>13.2 TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW MUZBNB, ITS EMPLOYEES, OFFICERS, SHAREHOLDERS, DIRECTORS, AGENTS, SUBSIDIARIES, AFFILIATES, SUCCESSORS, SUPPLIERS, ASSIGNEES OR LICENSORS SHALL NOT BE LIABLE FOR ANY INDIRECT, SPECIAL, INCIDENTAL, PUNITIVE, EXEMPLARY OR CONSEQUENTIAL DAMAGES, OR ANY LOSS OF PROFITS OR REVENUES, WHETHER INCURRED DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOOD-WILL, OR OTHER INTANGIBLE LOSSES, ARISING OUT OF YOUR ACCESS OR USE OR INABILITY TO ACCESS OR USE THE MUZBNB SERVICES, THIRD PARTY APPLICATIONS OR THIRD PARTYAPPLICATION CONTENT, INCLUDING WITHOUT LIMITATION ANY OFFENSIVE OR ILLEGAL CONDUCT OF OTHER USERS OF THESITE OR THE APP, REGARDLESS OF LEGAL THEORY, EVEN IF MUZBNBHAS BEEN ADVISED OF THE POSSIBILITY OF THOSE DAMAGES AND EVEN IF A REMEDY FAILS OF ITS ESSENTIAL PURPOSE. TO THE EXTENT PERMITTED BY APPLICABLE LAW IN NO EVENT SHALL MUZBNBS AGGREGTATED LIABILTY EXCEED THE AMOUNT YOU PAID MUZBNB, IF ANY, IN THE PAST THREE MONTHS FORT THE SERVICES GIVING RISE TO THE CLAME, OR THE AMOUNT OF 100,00 BDS, WHICHEVER IS LESS, WHICH YOU CONSIDER TO BE THE FAIR COMPENSATION.</p>
                        <p>13.3 Muzbnb, it&rsquo;s employees, agents, and its directors do not accept any liability and you hereby agree to release us of any liability arising (whether directly or indirectly) out of the information provided through the Platform, or any errors, in or omissions from information on the Platform. Muzbnb is not liable for loss (whether directly or indirectly) caused by your actions or decisions based on your reliance on the information provided to you through the Platform, nor caused by the delay, malfunction of the operation or the availability of the Platform.</p>
                        <h2>14. Changes</h2>
                        <p>14.1 Muzbnb may make changes or replace our Terms of Service Agreement at any time. We will post such changes, replacements and updates on the Site and make it available through the App and such change, replacement and update to our Terms of Service Agreement will take effect immediately upon posting. You are consenting to keep yourself up to date with the latest posted Terms of Service Agreement and you accept and are bound by such change, replacement and update if you access or use our Service after we have posted updated Terms of Service. The Terms of Service Agreement applies regardless from which device or operating system you access our Site or App.</p>
                        <h2>15. Governing Laws and Choice of Forum</h2>
                        <p>15.1 This Agreement shall be governed by and construed under the laws of state of Maryland, USA, without regard to its conflict of law provisions, asapplied to agreements entered into and to be performed in Maryland by the Maryland residents. You agree that if you have any dispute with Muzbnb you will contact us in order to settle through negotiations and mutual understanding. If the solution can not be reached in negotiations you agree and hereby submit to the exclusive jurisdiction of the courts of Washington DC.</p>
                        <h2>16. Final Provisions</h2>
                        <p>16.1 If any part of these Terms is found to be invalid, illegal or unenforceable in any respect, it will not affect the validity or enforceability of the remainder of the Terms. The section titles in the Terms are for convenience only and have no legal or contractual effect. Any failure to exercise or enforce any right or the provision of this agreement shall not constitute a waiver of such right or provision.</p>
                        <p>16.2 These Terms may be available on multiple languages, however English version will be considered as the authentic and official version.</p>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="np">

                    <div class="privacy-content">
                        <h1>Muzbnb Nondiscrimination Policy</h1>
                        <p><em>effective as of 10<sup>th</sup> of December 2017</em></p>
                        <p>Muzbnb is committed to provide an environment that is free from discrimination because of race, color, religion, national origin, ancestry disability, gender, sexual orientation, or age. Our purpose is to connect people and help build and develop relations based on mutual respect and love. For that purpose we require that both Hosts and Guests demonstrate peace and tolerance in regard to their mutual relationship, and that no decision is based on the factors that are recognized as discriminating factors. All users understand that some distinctions have to be made, whether required so by law or by personal preferences, however in making such distinctions, everyone should endeavor to avoid making exclusions of any kind, as far as possible.</p>
                        <p>Muzbnb has the utmost confidence in its users and their tolerance, and is positive that they will not simply comply with this policy, but that they will go above and beyond of what is declared within this document, and prove to the community that both Hosts and Guests are tolerant and loving people, dedicated to showing their hospitality and respect for others.</p>
                        <p>Hosts especially agree that they will not:</p>
                        <ul>
                            <li>Decline a Guest based on race, color, religion, national origin, ancestry, disability, gender, sexual orientation, or age;</li>
                            <li>Establish different conditions or change the conditions for Listings based on race, color, religion, national origin, ancestry, disability, gender, sexual orientation, or age;</li>
                            <li>Express either directly or indirectly their preference or disfavor of Guests on account of based on race, color, religion, national origin, ancestry, disability, gender, sexual orientation, or age;</li>
                            <li>Encourage or discourage Guest to book their listings based on their race, color, religion, national origin, ancestry, disability, gender, sexual orientation, or age.</li>
                        </ul>

                        <p>Where Hosts share their living space with the guest, Hosts may decline, or impose different terms for Guests of a different gender that that of a Host.</p>
                        <p>Where Guest does not mention their disability Hosts may not inquire about the existence and severity of the disability. If Guest mentions their disability and they find that the accommodation is suitable for them, Hosts may not claim that accommodation is not suitable for that Guest. When Hosts are notified on the potential Guest&rsquo;s disability, they should discuss with the Guest whether the accommodation is suitable for them. Host will not do anything that would worsen the situation a Guest with disability is in, and Host will take all reasonable measures to welcome and to assist a Guest with disability.</p>
                        <p>It will not be considered a discrimination where distinction is made based on a factor that is not recognized under the law as a basis for discrimination. In that sense Host may limit the number of Guest in their accommodation, whether or not they will rent to smokers or pet owners and similar distinctions.</p>
                        <p>Hosts will commit to avoid turning down Guests without appropriate reasons. Hosts may not use appropriate reasons to hide their intention to turn down a Guest based on the discriminatory factor mentioned above. Muzbnb may suspend Host&rsquo;s account if we suspect that there is a pattern of turning down Guests belonging to the protected group in a longer period of time.</p>
                        <p>Muzbnb may take any reasonable action against Host&rsquo;s which do not comply with this Policy. We may especially (i) ask that Host changes the Listing, (ii) remove the Listing or (iii) suspend Host&rsquo;s account.</p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="grp">

                    <div class="privacy-content">
                        <h1>Muzbnb Guest Refund Policy</h1>
                        <p><em>effective as of 10<sup>th</sup> of December 2017</em></p>
                        <p>Terms and conditions contained herein govern our Refund Policy available to Guests who utilized and paid for the services continued in the Listings through our Platform, and who unable to use such services due to the any of the Issues defined bellow.</p>
                        <h2>1. Definition of Issues</h2>
                        <p>1.1 For the purpose of this Guest Refund Policy, the Issue shall mean any of the following:</p>
                        <ul>
                            <li>The Host cancels the booking of the Listing shortly before the commencement of the provision of services contained in the Listing;</li>
                            <li>The Host doesn&rsquo;t provide to the Guest the necessary means of using the services contained in the Listing (such as not providing the keys of the building or the accommodation)</li>
                            <li>Significant difference between the Listing description and the actual condition in regard to: number of rooms, number of beds, size of the accommodation, privacy, location, kitchen appliances, features, furniture and similar;</li>
                            <li>The accommodation is not generally clean, sanitary, and safe;</li>
                            <li>Guests are not provided with clean beddings or towels;</li>
                            <li>Listing contains services that are not in compliance with the House Rules, such as staying of pets or hosting parties.</li>
                        </ul>
                        <h2>2. Refund Policy</h2>
                        <p>2.1 In the event that the Guest suffers any of the Issues as defined above, Muzbnb may, at their sole discretion, offer to the Guest (i) to refund in full or a partial amount of the fess paid through the Platform; (ii) to provide replacement accommodation which is of the same or better quality than the accommodation booked through the Platform.</p>
                        <h2>3. Submitting a Refund Request</h2>
                        <p>3.1 Muzbnb will consider a Refund Request submitted by the Guest, provided that the Guest:</p>
                        <ul>
                            <li>Informs Muzbnb via email within twenty four (24) hours of the beginning of the reservation;</li>
                            <li>Provides photo or video evidence of the Issue;</li>
                            <li>Cooperates with Muzbnb as requested;</li>
                            <li>Does not cause the Issue themselves;</li>
                            <li>Tries to remedy the Issue either alone or by notifying the Host.</li>
                        </ul>
                        <h2>4. Minimum Quality Standards</h2>
                        <p>4.1 Hosts are responsible for ensuring the accommodations listed through the Platform match the description provided in the Listing and fulfill the minimum quality standards with regard to the availability, safety, cleanliness, privacy, and content.</p>
                        <p>4.2 In the event that the Issue appears, Host will be responsible to undertake all reasonable measures to resolve and cure the Issue. Host will be responsible to reimburse the Muzbnb for any amount spent by Muzbnb in providing a refund to the Guest, or providing substitute accommodation to the Guest as a result of the resolving of the Issue. Hosts hereby agree that Muzbnb may collect the payment of the above-mentioned costs from any available balance on the Host&rsquo;s Muzbnb account. The rights of the Guests under the Guest Refund Policy supersede the cancellation policy established by a Host.</p>
                        <h2>5. Final Provisions</h2>
                        <p>5.1 This Guest Refund Policy does not represent an offer to insure, insurance or insurance contract, nor does it replace or substitute insurance obtained or obtainable by the Guest. Rights and benefits provided herein are not transferable or assignable by the Guest.</p>
                        <p>5.2 We reserve the right to change our Guest Refund Policy at any time without prior notification. Te current version of Guest Refund Policy is available on the Site and through the App, indicating the effective date. You are encouraged to periodically check our Guest Refund Policy. Version of the Guest Refund Policy that was effective in the moment of the beginning of the booked services will be applicable for the resolution of any Issue that may arise out of such booking.</p>
                        <p>5.3 By using our Platform you express your agreement to be legally bound by our Guest Refund Policy stated in this document.</p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="mpp">

                    <div class="privacy-content">
                        <h1>Muzbnb Privacy Policy</h1>
                        <p><em>effective as of 10<sup>th</sup> of December 2017</em></p>
                        <h2>1. General Provisions</h2>
                        <p>1.1 This document uses the same terminology and abbreviations as our Terms of Service document. This Privacy Policy governs the collection, use and storage of information obtained from the Users (hereinafter: <strong>Information</strong>) through the use of our Platform. We do not sell available personal information to third parties. We use collected Information for our internal and marketing purposes and as necessary by the nature of the Services. In some instances, we are obliged to comply with court orders and government requests and provide Information or parts of it to authorized bodies. We may disclose or access Information whenever we believe in good faith that the law so requires, such as to comply with a litigation, or that disclosure is necessary to protect our rights, protect your safety or the safety of others, investigate fraud, or if we otherwise consider it necessary to do so to maintain service and improve our products and services. The Information on users is divided into personally identifiable and non-personally identifiable Information depending on whether Information can identify the user as a specific person.</p>
                        <h2>2. Changes to the Privacy Policy</h2>
                        <p>2.1 We reserve the right to change our Privacy Policy at any time without prior notification. Te current version of Privacy Policy is available on the Site and through the App, indicating the effective date. You are encouraged to periodically check our Privacy Policy.</p>
                        <h2>3. Consent</h2>
                        <p>3.1 By accessing the Site or the App you agree to have your information handled as described in this Privacy Policy. The services are intended for a general audience and are not targeted at children. We take children&rsquo;s online safety very seriously, and if we ever learn that the Information collected belongs to a child, we will immediately remove any such Information. If you are younger than 18 you are not allowedregister on the Site or through the App.</p>
                        <h2>4. Personally Identifiable Information</h2>
                        <p>4.1 We require some personal information in order to provide our Services. The information we collect is necessary to provide our Services, and we do not collect any information that is not strictly required by the nature of the Service. Personal Information that we collect includes but is not limited to: full name, e-mail address, location, date of birth, and payment information.</p>
                        <p>4.2 We may keep records of any questions, complaints or compliments made by you and the response, if any. Whenever you contact us, we will collect your name, e-mail address and any additional information which you provide and store it on our servers in order to provide you with the best Service possible and to improve our Site and Services.</p>
                        <p>4.3 When interacting with the Services through your social medial accounts, you are allowing us to access certain information that is available in your third party service profile. The type and amount of information is dictated by your settings, the permissions given through such third party service provider, and third party&rsquo;s privacy policy. We do not collect your third party service password. For example, when you access the content through your Facebook account, you will be referred to the Facebook consent dialogue box, after which, if the consent is provided, we will collect your name, e-mail address, and information which is publicly available on your profile such as your cover photo, gender, school, work, etc&hellip;</p>
                        <p>4.4 We may contact you using the available contact information provided by you, for any matters relating to the services (<strong>Service e-mails</strong>). These e-mails do not constitute &ldquo;unsolicited commercial e-mail advertisements&rdquo; and you are not able to opt-out of receiving them. We may also inform you through e-mails about promotions, offers, events, surveys and everything else in connection with our business, and our affiliates (<strong>Promotional e-mails</strong>). You can choose not to receive these e-mails by following the opt-out procedure described in the e-mail.</p>
                        <p>4.5 We endeavor to maintain appropriate physical, procedural and technical security with respect to the collected information so as to prevent any loss, misuse, unauthorized access, disclosure, or modification of personal information that also applies to our disposal or destruction of personal information. We keep the personal Information we collect about you strictly confidential. Only authorized personnel operating under strict confidentiality agreements have access to this personal Information. Although we take all appropriate measures in respect to keeping your information secure, you understand that no data security measures in the world can offer 100% protection.</p>
                        <h2>5. Non-Personally Identifiable Information</h2>
                        <p>5.1 We may collect non-identifiable analytics data through third party service. We use your information to provide and improve our services, customize services for you, better understand our users, diagnose and fix problems, etc.</p>
                        <h2>6. Cookies and similar technologies</h2>
                        <p>6.1 Cookies help us optimize and improve the user experience of the Site by helping us deliver crucial functionalities. The cookies we use may vary over time as we continuously update and improve our Site. Use of cookies is further explained in our Cookie Policy.</p>
                        <p>6.2 By visiting the Site we may use cookies to store some non-identifiable Information in your browser regarding your computer or mobile device and your activities in order to help improve the User experience. Users can deny access to cookies through their browser settings.</p>
                        <h2>7. Third Party Websites</h2>
                        <p>7.1 The Site or e-mails may contain links to other external websites that do not fall under our domain. We are not responsible for the privacy practices or the content of such external websites. If you choose to follow such links to external websites, you do so at your risk.</p>
                        <h2>8. Use of your information</h2>
                        <p>8.1 We use your information in order to deliver our Services, to analyze the use of the Site, the App, and the Services, to develop new products or services, optimize content, to provide customer support and to deliver ads based on your preferences. Some of our Services use information collected from your social media profile. Such processing of the information is automated and done without any supervision or interference by the physical person.</p>
                        <p>8.2 Your information is processed and handled in accordance with applicable laws and with your further consent where necessary.</p>
                        <p>8.3 Third party service providers may use your information for ads placement and notifications. We do not encourage, support or endorse any ad that is placed on the Site or displayed in the App. We have provided you with the full list of third-party services we are using in order to help you understand how your information is handled and you are encouraged to visit their respective privacy policies in order to exercise your right to the control of your personal information.</p>
                        <p>8.4 We may provide information to you by using browser push notifications. These notifications are shown by your browser, if your settings allow it, and you are able to cancel the push notifications through your browser&rsquo;s settings.</p>
                        <p>8.5 We may inform you through e-mails or push messages about news, promotions, special offers, new content and or other topics of interest related to the Muzbnb and our affiliates. You may choose to stop receiving these notifications at any time.</p>
                        <h2>9. Third party content and Widgets</h2>
                        <p>9.1 Some content on the Site and App may be provided by the third party providers. When you interact with such content you are also interacting with the content provider. Third party content providers may collect some non-identifiable user data in accordance with their terms of use and privacy policies. We are not responsible for such content, nor do we monitor or control content provided by third parties.</p>
                        <p>9.2 The Site may include social media features in the form of widgets (&lsquo;like&rsquo;, &lsquo;share&rsquo;, &lsquo;tweet&rsquo; buttons and similar), which function like separate programs working within the Site. Your interaction with these widgets is governed by policies of a third-party providing them.</p>
                        <h2>10. Contact Information</h2>
                        <p>10.1 If you have any questions regarding our Privacy Policy and how the information is handled, or you wish to access, amend, or update your information feel free to contact us at <a href="mailto:salaam@muzbnb.com">salaam@muzbnb.com</a>.</p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="pt">

                    <div class="privacy-content">
                        <h1>Muzbnb Payment Terms Agreement</h1>
                        <p><em>effective as of 10<sup>th</sup> of December 2017</em></p>
                        <p>This Payment Terms Agreement explains the terms and conditions under which the payments to and from our Users are handled. This Agreement represents an integral part of our Terms of Service Agreement. In the event that provisions of this Agreement are not compatible with the provisions of our Terms of Service Agreement, the provisions of Payment Terms shall supersede the general agreement. This document uses the same terminology and abbreviations as our Terms of Service document.</p>
                        <p>Some aspects of payments may be subject to additional terms and policies and subject to terms and policies of third parties service providers. These Terms do not interfere with any obligation or authorization provided in any other agreement concluded between you and Muzbnb.</p>
                        <h2>1. Definitions</h2>
                        <p>1.1 In addition to the definitions provided in the Terms of Service Agreement, the following definitions explain some of the terminology and abbreviations used throughout our Payment Terms Agreement:</p>
                        <p>&lsquo;<strong>Payment Terms Agreement/Agreement</strong>&rsquo; refers to the latest version of the Payment Terms Agreement document.</p>
                        <p>&lsquo;<strong>Payout</strong>&rsquo; refers to the transfer of funds from Muzbnb to its Users for the services provided through the platform such as Listings.</p>
                        <p>&lsquo;<strong>Fee</strong>&rsquo; refers to the fees charged by the Muzbnb for the services and payments processed through the Platform.</p>
                        <h2>2. Scope of the Payment Services</h2>
                        <p>2.1 Muzbnb provides Payment Services in connection with Listings, Bookings, Refunds, Guarantees and other payments. Payment Services include payment collection and payouts. We do not accept deposits or payments that are not connected with our Services nor do we provide payments, loans, credits or other financial services outside of the scope of services as defined in our Terms.</p>
                        <p>2.2 Muzbnb cannot guarantee or warrant that the Services will meet your requirements or be available on an uninterrupted, secure, or error-free basis. We may cancel or restrict access to certain Payment Services at any time and for any reason, especially for the purpose of updating our systems, updating security, potential security risks, suspected fraud or fraudulent activities and similar.</p>
                        <p>2.3 Some Payment Services are used in connection with third party services such as payment processors, intermediaries, credit card companies and banks. In so far as third party services are utilized, additional terms and conditions may apply. These third party service providers are not endorsed by Muzbnb, nor is Muzbnb endorsed by such third parties.</p>
                        <p>2.4 Use of our Payment Services is governed by this Agreement, our Terms, and governing laws and policies. You understand that it is your obligation to comply with local laws and regulations with regard to Payment Services and taxes.</p>
                        <h2>3. Changes</h2>
                        <p>3.1 Muzbnb may make changes or replace Payment Terms Agreement at any time. We will post such changes, replacements and updates on the Site and such change, replacement and update to our Payment Terms Agreement will take effect no less than thirty (30) days from the date of posting. You are consenting to keep yourself up to date with the latest posted Payment Terms Agreement and you accept and are bound by such change, replacement and update if you access or use our Service after new Payment Terms Agreement becomes applicable.</p>
                        <h2>4. Payment Methods</h2>
                        <p>4.1 We accept several methods of payments including debit cards, credit cards, and PayPal. Providers of payment services are separate legal entities, and we can not influence or affect in any way the fees or other expenses charged by them. Please refer to these payment service providers&rsquo; terms of service for more details.</p>
                        <p>4.2 Whenever you provide payment information on the Platform you guarantee to provide information that is true, accurate and complete, and to update your payment information whenever there are changes in order to keep your payment information true, accurate and complete.</p>
                        <p>4.3 When you add a new payment method to your account, we may verify such payment method by making a refundable charge to your payment method. We will return the exact amount charged to your payment method for verification.</p>
                        <h2>5. Terms for Hosts</h2>
                        <p>5.1 Muzbnb will collect payments for Listing from guests, charge applicable Fees and taxes, and make payouts to Host&rsquo;s PayPal account in accordance with this Agreement. Payout will be issued for the Host&rsquo;s available funds. Available funds will be lessened for any amounts refunded to the Guests.</p>
                        <p>5.2 In order to receive Payouts from Muzbnb, you must have a valid PayPal account connected with your Muzbnb account. We will initiate the Payout of the booking fee, less any outstanding Fees and taxes, within twenty four (24) hours from the beginning of the booked term. You understand that processing of the Payout may take more than couple of days, and that delays in payments are outside of Muzbnb&rsquo;s sphere of influence and are dependant on payment processing entities.</p>
                        <p>5.3 We will initiate the Payout in the currency that is received from the Guest. In the event that your account is in other currency, exchange rates of the payment processing entity will apply.</p>
                        <p>5.4 We may limit the amount of the Payout for compliance and operational reasons in so that we may not issue a Payout bellow certain threshold or we will not issue Payouts exceeding certain threshold. You will be properly notified of the existence and amount of each threshold if any.</p>
                        <p>5.5 Hosts are responsible for paying any taxes in connection with Payouts.</p>
                        <h2>6. Terms for Guests</h2>
                        <p>6.1 When using our Services, you are authorizing Muzbnb to charge the payment method of your choosing for the amount indicated on the Platform. You will have the detailed description of the Services being paid and the amounts of Fees and taxes if any.</p>
                        <p>6.2 If we are unable to process the payment on your payment method for any reason, you will not be able to use the selected Services.</p>
                        <p>6.3 If you are issued a refund for any purpose, we will release the amounts of approved refund to the payment method used for initial payment.</p>
                        <h2>7. Appointment</h2>
                        <p>7.1 Users agree to appoint Muzbnb as Limited Payment Collection Agent, acting as intermediary between Guests and Hosts, whereas in relation with Guests, Muzbnb is appointed as Collection Agent, and in relation with Hosts, Muzbnb is appointed as Providing Agent.</p>
                        <p>7.2 Guests hereby agree that payment for Services made to Muzbnb will be considered as payments made directly to Hosts. Hosts hereby agree that any payment made to Muzbnb in relation to Host&rsquo;s services will be considered as payments made directly to Hosts, regardless of the exact time of the Payout.</p>
                        <p>7.3 Muzbnb does not assume any liability as the appointed Limited Payment Collection Agent for any action or omission of the User.</p>
                        <h2>8. Acceptable Use</h2>
                        <p>8.1 You agree that you will not misuse our Payment Services. A misuse constitutes any use, access or interference with the Services contrary to this Agreement, Terms, Privacy Policy and applicable laws and regulations. During your use of our Services, you will not behave contrary to this Agreement, Terms, Policies, applicable laws and regulations, and you will especially not, without limitation, do any of the following:</p>
                        <p>(i) breach, violate, or circumvent any applicable law or regulation, nor any agreement or contract with third parties;</p>
                        <p>(ii) connect or attempt to connect to your account any payment method which is not your, or for which you are not authorized to use;</p>
                        <p>(iii) breach, violate, circumvent, avoid, remove or bypass any technological measure implemented by Muzbnb or third party processing the payment with regard to Payment Services;</p>
                        <p>(iv) facilitate or encourage any violation of this Agreement.</p>
                        <h2>9. Termination</h2>
                        <p>9.1 We may, at our own discretion, suspend or terminate your access to Payment Services or refuse to provide the Payment Service without the need to deliberate on the reasons for such action with a thirty (30) days notice period. We may especially suspend or terminate your account or refuse your request without notice period if:</p>
                        <p>(i) The billing information you provided is incorrect, or invalid, or we are otherwise unable to process the payment,</p>
                        <p>(ii) We suspect that request is fraudulent. We reserve the right to refuse any request which we, in our sole discretion, find to have been placed as a result of fraudulent activity,</p>
                        <p>(iii) Your request is placed pursuant to previous credit card dispute.</p>
                        <p>(vi) You have violated this Agreement, our Terms or other Policies, or any law or regulation.</p>
                        <p>9.2 You may terminate your account for any reason at any time by canceling your account in Account Settings.</p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="cp">

                    <div class="privacy-content">
                        <h1>Muzbnb Cookie Policy</h1>
                        <p><em>effective as of 10<sup>th</sup> of December 2017</em></p>
                        <h2>1. General Information</h2>
                        <p>1.1 This document uses the same terminology and abbreviations as the Terms of Service document. A cookie is a small piece of text used to store information on web browsers. It remembers information about your visit on our website, like your preferred currency and other settings, and helps us optimize and improve the user experience of the Website. Cookies makes it possible to provide an easier and more rewarding service to you by enabling crucial functionalities.</p>
                        <p>1.2 The cookies we use (and other types of technologies we use with similar purpose as cookies, referred here to as cookies) may vary over time as we continuously update and improve our services. More information about the cookies that we use is presented in our list of commonly used cookies below.</p>
                        <table width="100%" cellspacing="0" cellpadding="5" bgcolor="#ffffff" class="table-responsive" border="1">
                            <tbody>
                            <tr>
                                <td bgcolor="#ffffff" width="190">
                                    <p><strong>Category of use</strong></p>
                                </td>
                                <td bgcolor="#ffffff" width="414">
                                    <p><strong>Example</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" width="190">
                                    <p><strong>Preferences</strong></p>
                                </td>
                                <td bgcolor="#ffffff" width="414">
                                    <p>Preferences cookies enables the functionality of our services and helps us provide a personalized experience of our site. It remembers information such as preferred language and currency and then adapt how the site appear or behave.</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" width="190">
                                    <p><strong>Authentication &amp; Security</strong></p>
                                </td>
                                <td bgcolor="#ffffff" width="414">
                                    <p><strong>Authentication</strong></p>
                                    <p>If you have an account on the Site, we use cookies to verify your account and, if you prefer, keep you logged in so that our services will be more accessible to you. Cookies also allow us to store security information so that we are able to recover your account in case it has been hacked or you have forgotten your password.</p>
                                    <p><strong>Security</strong></p>
                                    <p>If you have an account on the Site, security cookies helps us keep your account safe and protect user data from unauthorized parties. These cookies prevent fraudulent use of login credentials by, for instance, applying further security measures when someone attempts to access your account without the proper authorization.</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" width="190">
                                    <p><strong>Performance</strong></p>
                                </td>
                                <td bgcolor="#ffffff" width="414">
                                    <p>Performance cookies enables all functions on our website to work correctly. For example, you may not be able to use our search function or login page (if you have an account) without these cookies.</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" width="190">
                                    <p><strong>Analytics</strong></p>
                                </td>
                                <td bgcolor="#ffffff" width="414">
                                    <p>These cookies will provide information regarding how visitors interact with our services and makes it possible for us to collect information about which aspects should be further developed in order to improve the user experience.</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" width="190">
                                    <p><strong>Advertising</strong></p>
                                </td>
                                <td bgcolor="#ffffff" width="414">
                                    <p>Advertising cookies make it possible to personalize promotions. With the use of advertising cookies, for example, we are able to set the number of times a suggested or promoted object is shown to a visitor as well as measure how many times a specific object has been clicked on and from where in the world the object has been viewed.</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" width="190">
                                    <p><strong>Remarketing</strong></p>
                                </td>
                                <td bgcolor="#ffffff" width="414">
                                    <p>We may use third-party cookies, provided by third-party service providers such as Facebook and Google, for re-marketing purposes as explained in our Privacy Policy.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p><br />1.3 We may use third party services like Google Analytics, AdWords, Facebook Pixels, OneSignal, Hellobar/Mailchimp, Drift, and other. Cookies from such services are used to collect data for statistical reports.</p>
                        <p>1.4 Third-party vendors, including Google, use cookies to serve ads based on someone&rsquo;s past visits to the Site. Any data collected will be used in accordance with our Privacy Policy and Google&rsquo;s privacy policy. Users may opt out of Google&rsquo;s use of cookies by visiting the Google Advertising Opt-out Page, also, Users may opt out of Google Analytics by visiting the Google Analytics Opt-out Page. Users may opt out of third-party vendor use of cookies by visiting the Network Advertising Initiative Opt-out Page. http://optout.networkadvertising.org/#/.</p>
                        <p>1.5 We may use other third-party Services such as Pixel and Analytics services by Facebook, to help us target our ads more effectively. The collected data remains anonymous. This means that we cannot see the personal data of any individual user. However, the collected data is saved and processed by Facebook. We are informing you on this matter according to our information at this time. Facebook is able to connect the data with your Facebook account and use the data for their own advertising purposes, in accordance with Facebook&rsquo;s Data Use Policy found under &lt;https://www.facebook.com/about/privacy&gt;. You may opt-out of Facebook tracking option by visiting the following link &lt; https://www.facebook.com/ads/website_custom_audiences/&gt; and for other types of third party ad tracking, by visiting the Network Advertising Initiative Opt-out Page.</p>
                        <h2>2. Managing Cookies</h2>
                        <p>2.1 At any time you have the possibility to manage your cookies preferences. This is done in your browser or device settings. Depending on which browser and device you use you may be able to control which cookies you allow, which cookies you want to block in the future, and delete cookies. For more information about these settings visit your browser or device&acute;s help page. Note that some of Muzbnb Services might not work as intended if you choose to disable cookies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="terms_info">--}}
        {{--<p class="terms_info_bold">IF YOU RESIDE IN THE UNITED STATES, PLEASE NOTE: SECTION 34 OF THESE TERMS OF SERVICE CONTAINS AN ARBITRATION CLAUSE AND CLASS ACTION WAIVER. IT AFFECTS HOW DISPUTES WITH Muzbnb ARE RESOLVED. BY ACCEPTING THESE TERMS OF SERVICE, YOU AGREE TO BE BOUND BY THIS ARBITRATION PROVISION. PLEASE READ IT CAREFULLY.</p>--}}

        {{--<p>PLEASE READ THESE TERMS OF SERVICE CAREFULLY AS THEY CONTAIN IMPORTANT INFORMATION REGARDING YOUR LEGAL RIGHTS, REMEDIES AND OBLIGATIONS. THESE INCLUDE VARIOUS LIMITATIONS AND EXCLUSIONS, A CLAUSE THAT GOVERNS THE JURISDICTION AND VENUE OF DISPUTES, AND OBLIGATIONS TO COMPLY WITH APPLICABLE LAWS AND REGULATIONS.</p>--}}

        {{--<p>IN PARTICULAR, HOSTS SHOULD UNDERSTAND HOW THE LAWS WORK IN THEIR RESPECTIVE CITIES. SOME CITIES HAVE LAWS THAT RESTRICT THEIR ABILITY TO HOST PAYING GUESTS FOR SHORT PERIODS. THESE LAWS ARE OFTEN PART OF A CITY’S ZONING OR ADMINISTRATIVE CODES. IN MANY CITIES, HOSTS MUST REGISTER, GET A PERMIT, OR OBTAIN A LICENSE BEFORE LISTING A PROPERTY OR ACCEPTING GUESTS. CERTAIN TYPES OF SHORT-TERM BOOKINGS MAY BE PROHIBITED ALTOGETHER. LOCAL GOVERNMENTS VARY GREATLY IN HOW THEY ENFORCE THESE LAWS. PENALTIES MAY INCLUDE FINES OR OTHER ENFORCEMENT. HOSTS SHOULD REVIEW LOCAL LAWS BEFORE LISTING A SPACE ON Muzbnb.</p>--}}
        {{--<span>Last Updated: October 27, 2016</span>--}}
    {{--</div>--}}

    {{--<div class="key_terms">--}}

        {{--<h3>Key Terms</h3>--}}

        {{--<p>Muzbnb provides an online platform that connects hosts who have accommodations to list and book with guests seeking to book such accommodations (collectively, the “Services“), which Services are accessible at www.Muzbnb.com and any other websites through which Muzbnb makes the Services available (collectively, the “Site“) and as applications for mobile, tablet and other smart devices and application program interfaces (collectively, the “Application“).</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;If you are using the Site, Application or Services and you reside in the USA, these Terms of Service are between you and Muzbnb, Inc. If you reside outside of the USA and the People’s Republic of China (which for purposes of these Terms of Service does not include Hong Kong, Macau and Taiwan) (hereinafter “China”), these Terms of Service are between you and Muzbnb Ireland UC (hereinafter referred to as Muzbnb Ireland). If you reside in China, these Terms of Service are between you and Muzbnb Internet (Beijing) Co., Ltd. (“Muzbnb China”) except where you book Accommodation or when you create a Listing outside of China, in which case these Terms of Service are between you and Muzbnb Ireland for that transaction. If you initially reside in the USA and contract with Muzbnb, Inc., but subsequently change your residence to outside of the USA, you will contract with Muzbnb China if you change your residence to China and with Muzbnb Ireland otherwise, from the date on which your place of residence changes, and so on and so forth. (Muzbnb, Inc., Muzbnb Ireland and Muzbnb China are each hereinafter referred to as “Muzbnb“, “we“, “us“, or “our“). Additionally, if your Muzbnb contracting entity under this Section is Muzbnb China, you will nevertheless contract with Muzbnb Ireland for all Bookings confirmed prior to December 7, 2016 at 10:00am UTC. Muzbnb Payments, Inc., Muzbnb Payments UK Ltd., Muzbnb Payments India Pvt. Ltd. and Muzbnb China (individually and collectively, as appropriate, “Muzbnb Payments“) handle any and all payments and payouts conducted through or in connection with the Site, Application or Services (“Payment Services“). Payment Services provided by Muzbnb Payments are subject to the Payments Terms of Service (“Payments Terms“).</p>--}}

        {{--<p><span>“Accommodation”</span> means residential and other properties.</p>--}}

        {{--<p><span>“Muzbnb Content”</span> means all Content that Muzbnb makes available through the Site, Application, Services, or its related promotional campaigns and official social media channels, including any Content licensed from a third party, but excluding Member Content.</p>--}}

        {{--<p><span>“Booking”</span> means a limited license granted by the Host to the Guest to enter and use the Listing for the limited duration of the confirmed booking, during which time the Host (only where and to the extent permitted by applicable law) retains the right to re-enter the Accommodation, in accordance with the Guest’s agreement with the Host. Please note, as used on the Site, Applications, and Services, “short term rental” and “home sharing” have the same meaning as “Booking;” all three terms mean a limited license to enter and use the Accommodation for the duration of the confirmed booking as defined above.</p>--}}

        {{--<p>&nbsp;&nbsp;<span>“Booking Request Period”</span> means the time period starting from the time when a Booking is requested by a Guest (as determined by Muzbnb in its sole discretion), within which a Host may decide whether to confirm or reject that Booking request, as stated on the Site, Application or Services. Different Booking Request Periods may apply in different places.</p>--}}

        {{--<p>&nbsp;&nbsp;“Collective Content” means Member Content and Muzbnb Content.</p>--}}

        {{--<p>&nbsp;&nbsp;“Communication” means an email, message via the Application, text message or message to a WeChat account.</p>--}}

        {{--<p>&nbsp;&nbsp;“Content” means text, graphics, images, music, software (excluding the Application), audio, video, information or other materials.</p>--}}

        {{--<p>&nbsp;&nbsp;“Guest” means a Member who requests from a Host a Booking of a Listing via the Site, Application or Services, or a Member who stays at an Accommodation and is not the Host for the associated Listing.--}}
        {{--</p>--}}

        {{--<p>&nbsp;&nbsp;“Host” means a Member who creates a Listing via the Site, Application and Services.</p>--}}

        {{--<p>&nbsp;&nbsp;“Listing” means an Accommodation that is listed by a Host as available for Booking via the Site, Application, and Services.</p>--}}

        {{--<p>&nbsp;&nbsp;“Member” means a person who completes Muzbnb’s account registration process, including but not limited to Hosts and Guests, as described under “Account Registration” below.</p>--}}

        {{--<p>&nbsp;&nbsp;“Member Content” means all Content that a Member posts, uploads, publishes, submits, transmits, or includes in their Listing, Member profile or Muzbnb promotional campaign to be made available through the Site, Application or Services.</p>--}}

        {{--<p>&nbsp;&nbsp;“Tax” or “Taxes” mean any sales taxes, value added taxes (VAT), goods and services taxes (GST), transient occupancy taxes, tourist or other visitor taxes, accommodation or lodging taxes, fees (such as convention center fees) that Accommodation providers may be required by law to collect and remit to governmental agencies, and other similar municipal, state, federal and national indirect or other withholding and personal or corporate income taxes.</p>--}}
    {{--</div>--}}

    {{--<div class="terms_service">--}}

        {{--<h3>Terms of Service</h3>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;By using the Site, Application or Services, you agree to comply with and be legally bound by the terms and conditions of these Terms of Service (“Terms“), whether or not you become a registered user of the Services. These Terms govern your access to and use of the Site, Application and Services and all Collective Content (defined below), and your participation in the Referral Program (defined below), and constitute a binding legal agreement between you and Muzbnb. Please also read carefully our Privacy Policy at www.Muzbnb.com/terms/privacy_policy.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;In addition, certain areas of the Site and Application (and your access to or use of certain aspects of the Services or Collective Content) may have different terms and conditions, standards, guidelines, or policies posted or may require you to agree with and accept additional terms and conditions. If there is a conflict between these Terms and terms and conditions posted for a specific area of the Site, Application, Services, or Collective Content, the latter terms and conditions will take precedence with respect to your use of or access to that area of the Site, Application, Services, or Collective Content.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;If you do not agree to these Terms, you have no right to obtain information from or otherwise continue using the Site, Application or Services. Failure to use the Site, Application or Services in accordance with these Terms may subject you to civil and criminal penalties</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;THE SITE, APPLICATION AND SERVICES COMPRISE AN ONLINE PLATFORM THROUGH WHICH HOSTS MAY CREATE LISTINGS FOR ACCOMMODATIONS AND GUESTS MAY LEARN ABOUT AND BOOK ACCOMMODATIONS DIRECTLY WITH THE HOSTS. YOU UNDERSTAND AND AGREE THAT Muzbnb IS NOT A PARTY TO ANY AGREEMENTS ENTERED INTO BETWEEN HOSTS AND GUESTS, NOR IS Muzbnb A REAL ESTATE BROKER, AGENT OR INSURER. Muzbnb HAS NO CONTROL OVER THE CONDUCT OF HOSTS, GUESTS AND OTHER USERS OF THE SITE, APPLICATION AND SERVICES OR ANY ACCOMMODATIONS, AND DISCLAIMS ALL LIABILITY IN THIS REGARD TO THE MAXIMUM EXTENT PERMITTED BY LAW.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;IF YOU CHOOSE TO CREATE A LISTING ON Muzbnb, YOU UNDERSTAND AND AGREE THAT YOUR RELATIONSHIP WITH Muzbnb IS LIMITED TO BEING A MEMBER AND AN INDEPENDENT, THIRD-PARTY CONTRACTOR, AND NOT AN EMPLOYEE, AGENT, JOINT VENTURER OR PARTNER OF Muzbnb FOR ANY REASON, AND YOU ACT EXCLUSIVELY ON YOUR OWN BEHALF AND FOR YOUR OWN BENEFIT, AND NOT ON BEHALF OF OR FOR THE BENEFIT OF Muzbnb. Muzbnb DOES NOT CONTROL, AND HAS NO RIGHT TO CONTROL, YOUR LISTING, YOUR OFFLINE ACTIVITIES ASSOCIATED WITH YOUR LISTING, OR ANY OTHER MATTERS RELATED TO ANY LISTING, THAT YOU PROVIDE. AS A MEMBER YOU AGREE NOT TO DO ANYTHING TO CREATE A FALSE IMPRESSION THAT YOU ARE ENDORSED BY, PARTNERING WITH, OR ACTING ON BEHALF OF OR FOR THE BENEFIT OF Muzbnb, INCLUDING BY INAPPROPRIATELY USING ANY Muzbnb INTELLECTUAL PROPERTY.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;YOU ACKNOWLEDGE AND AGREE THAT, BY ACCESSING OR USING THE SITE, APPLICATION OR SERVICES OR BY DOWNLOADING OR POSTING ANY CONTENT FROM OR ON THE SITE, VIA THE APPLICATION OR THROUGH THE SERVICES, YOU ARE INDICATING THAT YOU HAVE READ, AND THAT YOU UNDERSTAND AND AGREE TO BE BOUND BY THESE TERMS AND RECEIVE OUR SERVICES (INCLUDING, WHERE APPLICABLE, PROGRAMS SUCH AS THE HOST PROTECTION INSURANCE PROGRAM, WHETHER OR NOT YOU HAVE REGISTERED WITH THE SITE AND APPLICATION. IF YOU DO NOT AGREE TO THESE TERMS, THEN YOU HAVE NO RIGHT TO ACCESS OR USE THE SITE, APPLICATION, SERVICES, OR COLLECTIVE CONTENT. If you accept or agree to these Terms on behalf of a company or other legal entity, you represent and warrant that you have the authority to bind that company or other legal entity to these Terms and, in such event, “you” and “your” will refer and apply to that company or other legal entity.</p>--}}
    {{--</div>--}}

    {{--<div class="terms_modification">--}}
        {{--<h3>modification</h3>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;Muzbnb reserves the right, at its sole discretion, to modify the Site, Application or Services or to modify these Terms, including the Service Fees, at any time and without prior notice. If we modify these Terms, we will post the modification on the Site or via the Application and/or provide you notice of the modification by email. We will also update the “Last Updated” date at the top of these Terms. Changes to the Terms will be effective at the time of posting. Your continued access or use of the Site, Application or Services will constitute acceptance of the modified Terms. Additionally, if the modified Terms contain material changes applicable to existing Members (by decreasing your rights or increasing your responsibilities), we will provide you with notice prior to the changes taking effect. If the modified Terms are not acceptable to you, your only recourse is to cease using the Site, Application and Services. If you do not close your Muzbnb Account you will be deemed to have accepted the changes.</p>--}}
    {{--</div>--}}

    {{--<div class="terms_eligibility">--}}
        {{--<h3>Eligibility</h3>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;The Site, Application and Services are intended solely for persons who are 18 or older. Any access to or use of the Site, Application or Services by anyone under 18 is expressly prohibited. By accessing or using the Site, Application or Services you represent and warrant that you are 18 or older.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;For users in the United States, Muzbnb will, to the extent permitted by applicable laws and if we have sufficient information to identify a user, obtain reports from public records of criminal convictions or sex offender registrations of the user. For users outside the United States, we may, to the extent permitted by applicable laws and if we have sufficient information to identify a user, obtain the local version of background or registered sex offender checks in our sole discretion. You agree and authorize us to use your personal information, such as your full name and date of birth, to obtain such reports, including from Muzbnb’s vendors.</p>--}}
    {{--</div>--}}

    {{--<div class="terms_application">--}}
        {{--<h3>How the Site, Application and Services Work</h3>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;The Site, Application and Services can be used to facilitate the listing and Booking of Accommodations. Such Accommodations are included in Listings on the Site, Application and Services by Hosts. You may view Listings as an unregistered visitor to the Site, Application and Services; however, if you wish to book an Accommodation or create a Listing, you must first register to create an Muzbnb Account (defined below).</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;As stated above, Muzbnb makes available an online platform or marketplace with related technology for Guests and Hosts to meet online and arrange for Bookings of Accommodations directly with each other. Muzbnb is not an owner or operator of properties, including, but not limited to, hotel rooms, motel rooms, other lodgings or Accommodations, nor is it a provider of properties, including, but not limited to, hotel rooms, motel rooms, other lodgings or Accommodations and Muzbnb does not own, sell, resell, furnish, provide, rent, re-rent, manage and/or control properties, including, but not limited to, hotel rooms, motel rooms, other lodgings or Accommodations or transportation or travel services. Unless explicitly specified otherwise in the Muzbnb platform, Muzbnb’s responsibilities are limited to facilitating the availability of the Site, Application and Services.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;PLEASE NOTE THAT, AS STATED ABOVE, THE SITE, APPLICATION AND SERVICES ARE INTENDED TO BE USED TO FACILITATE HOSTS AND GUESTS CONNECTING AND BOOKING ACCOMMODATIONS DIRECTLY WITH EACH OTHER. Muzbnb CANNOT AND DOES NOT CONTROL THE CONTENT CONTAINED IN ANY LISTINGS AND THE CONDITION, LEGALITY OR SUITABILITY OF ANY ACCOMMODATIONS. Muzbnb IS NOT RESPONSIBLE FOR AND DISCLAIMS ANY AND ALL LIABILITY RELATED TO ANY AND ALL LISTINGS AND ACCOMMODATIONS. ACCORDINGLY, ANY BOOKINGS WILL BE MADE OR ACCEPTED AT THE MEMBER’S OWN RISK.</p>--}}
    {{--</div>--}}

    {{--<div class="terms_registration">--}}
        {{--<h3>Account Registration</h3>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;In order to access certain features of the Site and Application, and to book an Accommodation or create a Listing, you must register to create an account (“Muzbnb Account“) and become a Member. You may register to join the Services directly via the Site or Application or as described in this section.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;You can also register to join by logging into your account with certain third-party social networking sites (“SNS“) (including, but not limited to, Facebook; each such account, a “Third-Party Account“), via our Site or Application, as described below. As part of the functionality of the Site, Application and Services, you may link your Muzbnb Account with Third-Party Accounts, by either: (i) providing your Third-Party Account login information to Muzbnb through the Site, Services or Application; or (ii) allowing Muzbnb to access your Third-Party Account, as permitted under the applicable terms and conditions that govern your use of each Third-Party Account. You represent that you are entitled to disclose your Third-Party Account login information to Muzbnb and/or grant Muzbnb access to your Third-Party Account (including, but not limited to, for use for the purposes described herein), without breach by you of any of the terms and conditions that govern your use of the applicable Third-Party Account and without obligating Muzbnb to pay any fees or making Muzbnb subject to any usage limitations imposed by such third-party service providers. By granting Muzbnb access to any Third-Party Accounts, you understand that Muzbnb will access, make available and store (if applicable) any Content that you have provided to and stored in your Third-Party Account (“SNS Content“) so that it is available on and through the Site, Services and Application via your Muzbnb Account and Muzbnb Account profile page. Unless otherwise specified in these Terms, all SNS Content, if any, will be considered to be Member Content for all purposes of these Terms. Depending on the Third-Party Accounts you choose and subject to the privacy settings that you have set in such Third-Party Accounts, personally identifiable information that you post to your Third-Party Accounts will be available on and through your Muzbnb Account on the Site, Services and Application. Please note that if a Third-Party Account or associated service becomes unavailable or Muzbnb’s access to such Third-Party Account is terminated by the third-party service provider, then SNS Content will no longer be available on and through the Site, Services and Application. You have the ability to disable the connection between your Muzbnb Account and your Third-Party Accounts, at any time, by accessing the “Settings” section of the Site and Application. PLEASE NOTE THAT YOUR RELATIONSHIP WITH THE THIRD-PARTY SERVICE PROVIDERS ASSOCIATED WITH YOUR THIRD-PARTY ACCOUNTS IS GOVERNED SOLELY BY YOUR AGREEMENT(S) WITH SUCH THIRD-PARTY SERVICE PROVIDERS. Muzbnb makes no effort to review any SNS Content for any purpose, including but not limited to for accuracy, legality or non-infringement and Muzbnb is not responsible for any SNS Content.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;Your Muzbnb Account and your Muzbnb Account profile page will be created for your use of the Site and Application based upon the personal information you provide to us or that we obtain via an SNS as described above. You may not have more than one (1) active Muzbnb Account. You agree to provide accurate, current and complete information during the registration process and to update such information to keep it accurate, current and complete. Muzbnb reserves the right to suspend or terminate your Muzbnb Account and your access to the Site, Application and Services if you create more than one (1) Muzbnb Account, or if any information provided during the registration process or thereafter proves to be inaccurate, fraudulent, not current, incomplete, or otherwise in violation of these Terms of Service.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;You are responsible for safeguarding your password. You agree that you will not disclose your password to any third party.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;Unless expressly authorized by a specific feature on Muzbnb, you are not permitted to share your Muzbnb Account with anyone or allow others to access or use your Muzbnb Account. Muzbnb may enable features, in our discretion, that allow other Members to take certain actions associated with your Muzbnb Account, on your behalf with your express authorization, such as having your executive assistant, travel agent, or employer book on your behalf or adding a family member to your account as an additional Host. You agree that you will take sole responsibility for any activities or actions under your Muzbnb Account, whether or not you have authorized such activities or actions. You will immediately notify Muzbnb of any unauthorized use of your Muzbnb Account.</p>--}}
    {{--</div>--}}

    {{--<div class="terms_accommodation">--}}
        {{--<h3>Accommodation Listings</h3>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;As a Member, you may create Listings. To create a Listing, you will be asked a variety of questions about the Accommodation to be listed, including, but not limited to, the location, capacity, size, features, and availability of the Accommodation and pricing and related rules and financial terms. In order to be featured in Listings via the Site, Application and Services, all Accommodations must have valid physical addresses. Listings will be made publicly available via the Site, Application and Services. You understand and agree that the placement or ranking of Listings in search results may depend on a variety of factors, including, but not limited to, Guest and Host preferences, ratings and/or ease of Booking.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;Other Members will be able to book your Accommodation via the Site, Application and Services based upon the information provided in your Listing, your Guest requirements, and Guests’ search parameters and preferences. You understand and agree that once a Guest requests a Booking of your Accommodation, you may not request the Guest to pay a higher price than in the Booking request.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;You acknowledge and agree that you alone are responsible for any and all Listings and Member Content you post. Accordingly, you represent and warrant that any Listing you post and the Booking of, or a Guest’s stay at, an Accommodation in a Listing you post (i) will not breach any agreements you have entered into with any third parties, such as homeowners association, condominium, or other third party agreements, and (ii) will (a) be in compliance with all applicable laws (such as zoning laws), Tax requirements, Intellectual Property laws, and rules and regulations that may apply to any Accommodation included in a Listing you post (including having all required permits, licenses and registrations), and (b) not conflict with the rights of third parties. Please note that Muzbnb assumes no responsibility for a Host’s compliance with any agreements with or duties to third parties, applicable laws, rules and regulations. Muzbnb reserves the right, at any time and without prior notice, to remove or disable access to any Listing for any reason, including Listings that Muzbnb, in its sole discretion, considers to be objectionable for any reason, in violation of these Terms or Muzbnb’s then-current Policies and Community Guidelines or Standards, Trademark & Branding Guidelines, or otherwise harmful to the Site, Application or Services.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;If you are a Host, you understand and agree that Muzbnb does not act as an insurer or as your contracting agent. If a Guest requests a Booking of your Accommodation and stays at your Accommodation, any agreement you enter into with such Guest is between you and the Guest and Muzbnb is not a party to it.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;When you create a Listing, you may also choose to include certain requirements which must be met by the Members who are eligible to request a Booking of your Accommodation, such as requiring Members to have a profile picture or verified phone number, in order to book your Accommodation. Any Member wishing to book Accommodations included in Listings with such requirements must meet these requirements. More information on how to set such requirements is available via the “Hosting” section of the Site, Application and Services.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;If you are a Host, Muzbnb makes certain tools available to you to help you to make informed decisions about which Members you choose to confirm or preapprove for Booking for your Accommodation. You acknowledge and agree that, as a Host, you are responsible for your own acts and omissions and are also responsible for the acts and omissions of any individuals who reside at or are otherwise present at the Accommodation at your request or invitation, excluding the Guest (and the individuals the Guest invites to the Accommodation, if applicable.)</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;Muzbnb recommends that Hosts obtain appropriate insurance for their Accommodations. Please review any insurance policy that you may have for your Accommodation carefully, and in particular please make sure that you are familiar with and understand any exclusions to, and any deductibles that may apply for, such insurance policy, including, but not limited to, whether or not your insurance policy will cover the actions or inactions of or relating to Guests (and the individuals the Guest invites to the Accommodation, if applicable) while at your Accommodation. Please also review such policy for any interaction with the Muzbnb Host Protection Insurance Program, to the extent provided in your jurisdiction.</p>--}}

        {{--<p>&nbsp;&nbsp;&nbsp;Muzbnb may offer Hosts the option of having photographers take photographs of their Accommodations. If you as a Host choose to have photographer do this, Muzbnb shall own all copyrights in photographs taken but these photographs will be made available to you to include in your Listing with a watermark or tag bearing the words “Muzbnb.com Verified Photo” or similar wording (“Verified Images“). You agree that you alone are responsible for ensuring that your Listing is accurately represented in the Verified Images. You alone are responsible for using the Verified Images for your Listing and you warrant that you will cease to use the Verified Images or any other images if such images cease to accurately represent your Listing or if you cease to be a Host for the Listing featured. All images, materials and content created by these photographers, including Verified Images, constitute Muzbnb Content, regardless of whether you include them in your Listing and you agree not to use them except in your Listing without prior authorization from Muzbnb. If your Muzbnb Account is terminated or suspended for any reason, you shall not use Verified Images in any way. You agree that Muzbnb retains its right to and may use the Verified Images for advertising, marketing, commercial and other business purposes in any media or platform, whether in relation to your Listing or otherwise, without further notice or compensation.</p>--}}
    {{--</div>--}}

@endsection
