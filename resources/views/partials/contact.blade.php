<section class="contact-section" >

    <div class="section-title">
        <h2 class="text-xxl">Contact Us</h2>
        <span class="section-separator"></span>
        <p class="text-lg">
           Send us your questions, feedback, or requests, and we'll make sure you get the help you need. 
           We look forward to hearing from you!
        </p>
    </div>

    <div class="contact-container">

        <div class="contactInfo">

            <div class="contact-box">
                <div class="contact-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="contact-text">
                    <h3>Address</h3>
                    <p> Acacia Road,<br>Ongata Rongai,Nairobi</p>
                </div>
            </div>

            <div class="contact-box">
                <div class="contact-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="contact-text">
                    <h3>Phone</h3>
                    <p>+254-722-333-000</p>
                </div>
            </div>

            <div class="contact-box">
                <div class="contact-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="contact-text">
                    <h3>Email</h3>
                    <p>hello@booksyapp.com</p>
                </div>
            </div>
        </div>

        <div class="contactform">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <h2 class="text-lg">Send Message</h2>

                <div class="c-inputbox">
                    <span>Full Name:</span>
                    <input type="text" name="name" placeholder="Your Name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                </div>

                <div class="c-inputbox">
                    <span>Email:</span>
                    <input type="email" name="email" placeholder="Your Email" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                </div>

                <div class="c-inputbox">
                    <span>Type your Message...</span>
                    <textarea name="message" placeholder="Your Message" required></textarea>                    
                </div>

                <div class="c-inputbox">
                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </div>

            </form>
        </div>
        
    </div>
</section>

