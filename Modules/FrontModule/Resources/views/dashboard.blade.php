@extends('front.frontLayout')
@section('content')


<!-- home
================================================== -->
<section id="home">

    <div class="overlay"></div>

    <div class="home-content-table">	
        <div class="home-content-tablecell">
            <div class="row">
                <div class="col-twelve">		   			

                    <h3 class="animate-intro">We Are Infinity.</h3>
                    <h1 class="animate-intro">
                        We Craft Stunning  <br>
                        Digital Experiences.
                    </h1>	

                    <div class="more animate-intro">
                        <a class="smoothscroll button stroke" href="#about">
                            Learn More
                        </a>
                    </div>							

                </div> <!-- end col-twelve --> 
            </div> <!-- end row --> 
        </div> <!-- end home-content-tablecell --> 		   
    </div> <!-- end home-content-table -->

    <ul class="home-social-list">
        <li class="animate-intro">
            <a href="#"><i class="fa fa-facebook-square"></i></a>
        </li>
        <li class="animate-intro">
            <a href="#"><i class="fa fa-twitter"></i></a>
        </li>
        <li class="animate-intro">
            <a href="#"><i class="fa fa-instagram"></i></a>
        </li>
        <li class="animate-intro">
            <a href="#"><i class="fa fa-behance"></i></a>
        </li>
        <li class="animate-intro">
            <a href="#"><i class="fa fa-dribbble"></i></a>
        </li>	      
    </ul> <!-- end home-social-list -->	

    <div class="scrolldown">
        <a href="#about" class="scroll-icon smoothscroll">		
            Scroll Down		   	
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </a>
    </div>			

</section> <!-- end home -->


<!-- about
================================================== -->
<section id="about">

    <div class="row about-wrap">
        <div class="col-full">

            <div class="about-profile-bg"></div>

            <div class="intro">
                <h3 class="animate-this">About Us</h3>
                <p class="lead animate-this"><span>Timestart Infotech</span> is a creative digital agency based in Gujarat, India. We are composed of creative designers and experienced developers.</p>	
            </div>   

        </div> <!-- end col-full  -->
    </div> <!-- end about-wrap  -->

</section> <!-- end about -->


<!-- about
================================================== -->
<section id="services">

    <div class="overlay"></div>
    <div class="gradient-overlay"></div>

    <div class="row narrow section-intro with-bottom-sep animate-this">
        <div class="col-full">

            <h3>Services</h3>
            <h1>What We Do.</h1>

            <p class="lead">At Timestart, we provide value driven development services to our clients. Our veteran experts will guide you through the entire stages of development life cycle i.e. right from idea conceptualization to product deployment. We follow stringent industry standards to deliver the high-end product to our users.</p>

        </div> <!-- end col-full -->
    </div> <!-- end row -->

    <div class="row services-content">

        <div class="services-list block-1-2 block-tab-full group">

            <div class="bgrid service-item animate-this">	

                <span class="icon"><i class="icon-paint-brush"></i></span>            

                <div class="service-content">
                    <h3 class="h05">Branding</h3>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
                    </p>	         		
                </div> 	         	 

            </div> <!-- end bgrid -->

            <div class="bgrid service-item animate-this">	

                <span class="icon"><i class="icon-earth"></i></span>                          

                <div class="service-content">	
                    <h3 class="h05">Web Design</h3>  

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
                    </p>	         		
                </div>	                          

            </div> <!-- end bgrid -->

            <div class="bgrid service-item animate-this">

                <span class="icon"><i class="icon-lego-block"></i></span>		            

                <div class="service-content">
                    <h3 class="h05">Web Development</h3>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
                    </p>
                </div> 	            	               

            </div> <!-- end bgrid -->

            <div class="bgrid service-item animate-this">

                <span class="icon"><i class="icon-megaphone"></i></span>	              

                <div class="service-content">
                    <h3 class="h05">Marketing</h3>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
                    </p>	         		
                </div>                

            </div> <!-- end bgrid -->			   

        </div> <!-- end services-list -->

    </div> <!-- end services-content -->   			

</section> <!-- end services -->

<!-- contact
================================================== -->
<section id="contact">

    <div class="overlay"></div>

    <div class="row narrow section-intro with-bottom-sep animate-this">
        <div class="col-twelve">
            <h3>Contact</h3>
            <h1>Get In Touch.</h1>
        </div> 
    </div> <!-- end section-intro -->

    <div class="row contact-content">

        <div class="col-seven tab-full animate-this">

            <h5>Send Us A Message</h5>

            <!-- form -->
            <form name="contactForm" id="contactForm" method="post">     			

                <div class="form-field">
                    <input name="contactName" type="text" id="contactName" placeholder="Name" value="" minlength="2" required="">
                </div>

                <div class="row">
                    <div class="col-six tab-full">
                        <div class="form-field">
                            <input name="contactEmail" type="email" id="contactEmail" placeholder="Email" value="" required="">
                        </div>		      			   
                    </div>
                    <div class="col-six tab-full">	            
                        <div class="form-field">
                            <input name="contactSubject" type="text" id="contactSubject" placeholder="Subject" value="">
                        </div>		     				   
                    </div>
                </div>

                <div class="form-field">
                    <textarea name="contactMessage" id="contactMessage" placeholder="message" rows="10" cols="50" required=""></textarea>
                </div> 

                <div class="form-field">
                    <button class="submitform">Submit</button>

                    <div id="submit-loader">
                        <div class="text-loader">Sending...</div>                             
                        <div class="s-loader">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                </div>

            </form> <!-- end form -->

            <!-- contact-warning -->
            <div id="message-warning"></div> 

            <!-- contact-success -->
            <div id="message-success">
                <i class="fa fa-check"></i>Your message was sent, thank you!<br>
            </div>

        </div> <!-- end col-seven --> 

        <div class="col-four tab-full contact-info end animate-this">

            <h5>Contact Information</h5>

            <div class="cinfo">
                <h6>Where to Find Us</h6>
                <p>
                    7 Park View,<br>
                    Nr Asopalav Party Plot,<br>
                    Opp Company Petrol Pump,<br>
                    Anandnagar Road, Satellite,<br>
                    Ahmedabad - 380015
                </p>
            </div> <!-- end cinfo -->

            <div class="cinfo">
                <h6>Email Us At</h6>
                <p>
                    info@timestart.in			     
                </p>
            </div> <!-- end cinfo -->

            <div class="cinfo">
                <h6>Call Us At</h6>
                <p>
                    Mobile: (+91) 8000 263443
                </p>
            </div>

        </div> <!-- end cinfo --> 

    </div> <!-- end row contact-content -->

</section> <!-- end contact -->

@endsection
@section('javascript')
@endsection
