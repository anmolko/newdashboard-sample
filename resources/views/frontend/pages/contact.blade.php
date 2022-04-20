
@extends('frontend.layouts.master')
@section('title') Contact Us @endsection

@section('content')

	<!-- CONTACTS-2 ============================================= -->
    <section id="contacts-2" class="bg-snow wide-50 inner-page-hero contacts-section division">				
        <div class="container">


            <!-- SECTION TITLE -->	
            <div class="row justify-content-center">	
                <div class="col-md-10 col-lg-8">
                    <div class="section-title title-02 mb-80">			

                        <!-- Title -->	
                        <h2 class="h2-xs">Have a question? Need help? Don't hesitate, drop us a line</h2>	

                        <!-- Text -->	
                        <p class="p-xl">Please select a topic below related to your inquiry. If you dont find what you need, fill out our contact form.
                        </p>	

                    </div>	
                </div>
            </div>


            <!-- CONTACT FORM -->
            <div class="row justify-content-center">	
                <div class="col-lg-10 col-xl-8">
                    <div class="form-holder">
                        <form name="contactform" class="row contact-form">

                            <!-- Form Select -->
                            <div class="col-md-12 input-subject">
                                <p class="p-lg">This question is about: </p>
                                <span>Choose a topic, so we know who to send your request to: </span>
                                <select class="form-select subject" name="subject" aria-label="Default select example">
                                    <option value="" selected>This question is about...</option>	
                                    <option value="Trade Inquiry">Trade Inquiry</option>
                                    <option value="Ask a question">Ask a question</option>
                                    <option value="Share Feedback">Share Feedback</option>
                                    <option value="Career Enquiry">Career Enquiry</option>
                                </select>
                            </div>
                                                                                
                            <!-- Contact Form Input -->
                            <div class="col-md-12">
                                <p class="p-lg">Your Name: </p>
                                <span>Please enter your real name: </span>
                                <input type="text" name="name" class="form-control name" placeholder="Your Name*"> 
                            </div>
                                        
                            <div  class="col-md-12">
                                <p class="p-lg">Your Phone Number: </p>
                                <span>Please carefully check your phone number for accuracy</span>
                                <input type="text" name="phone" class="form-control phone" placeholder="Your Phone Number*"> 
                            </div>

                            <div  class="col-md-12">
                                <p class="p-lg">Your Email Address: </p>
                                <span>Please carefully check your email address for accuracy</span>
                                <input type="text" name="email" class="form-control email" placeholder="Email Address*"> 
                            </div>

                            <div class="col-md-12">
                                <p class="p-lg">Explain your question in details: </p>
                                <span>Please write a message !</span>
                                <textarea class="form-control message" name="message" rows="6" placeholder="I have a problem with..."></textarea>
                            </div> 
                                                                                
                            <!-- Contact Form Button -->
                            <div class="col-md-12 mt-15 form-btn text-right">	
                                <button type="submit" class="btn btn-skyblue tra-grey-hover submit">Submit Request</button>	
                            </div>
                                                                                                                    
                            <!-- Contact Form Message -->
                            <div class="col-lg-12 contact-form-msg">
                                <span class="loading"></span>
                            </div>	
                                                                                    
                        </form>	
                    </div>	
                </div>	
            </div>	   <!-- END CONTACT FORM -->
            

        </div>	   <!-- End container -->	
    </section>	<!-- END CONTACTS-2 -->

    @if(@$setting_data->google_map)
    <iframe frameborder="0" width="100%" height="450px"scrolling="no" marginheight="0" marginwidth="0" src="{{@$setting_data->google_map}}"
                title="%3$s" aria-label="%3$s"></iframe>
    @endif
    <!-- DIVIDER LINE -->
    <hr class="divider">
@endsection
@section('js')
<script src="{{asset('assets/frontend/js/contact-form.js')}}"></script>	
@endsection
