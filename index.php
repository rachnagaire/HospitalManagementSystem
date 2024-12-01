<?php include 'header.php'; ?>
    
<main role="main">
        <section class="hero-section hero--bg-pattern">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="promo">
                            <h2 class="promo-title">Find appointment according to your fit</h2>
                            <p class="promo-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vulputate mi justo, ac sodales eros aliquam in. Etiam nibh mauris, pretium tempor dictum eget, convallis id lacus.</p>
                            <a href="appointment.php" class="btn btn-primary btn-lg promo-cta">Book An Appointment</a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <figure class="hero-image--wrapper">
                            <img src="/HospitalManagementSystem/Assets/Images/signin.jpg" alt="Hospital" class="img-fluid">
                        </figure>
                    </div>
                </div>
            </div>
        </section>
      
        
        <section class="section-contact bg-primary py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-content">
                            <h2 class="text-hd text-white mt-5 pt-4 title">
                                Lets have a chat
                            </h2>
                            <p class="text-white">Ask us anything or just send a message</p>
                            <ul class="list-unstyled footer-list contact-list">
                                <li class="footer-list--item">
                                    <a href="" class="footer-links">
                                        <i class="ri-map-pin-line mr-4"></i>
                                        <span>Murfresboro, TN </span>
                                    </a>
                                </li>
                                <li class="footer-list--item">
                                    <a href="javascript::" class="footer-links">
                                        <i class="ri-phone-line mr-4"></i>
                                        <span>+1 7611111111</span>
                                    </a>
                                </li>
                                <li class="footer-list--item ">
                                    <a href="javascript::" class="footer-links">
                                        <i class="ri-mail-line mr-4"></i>
                                        <span>info@cims.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 py-5">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-lg-5">
                               <h3 class>Contact Us</h3>
                               <p>Reach out to us incase of any quries!</p>
                                <form action="/customer/contactus" name="contactus" method="post" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName">
                                        <span id="fullName-error" class="error text-danger validation-" for="fullName"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAddress">Email address</label>
                                        <input type="email" class="form-control" id="emailAddress" name="emailAddress">
                                        <span id="emailAddress-error" class="error text-danger" for="emailAddress"></span>
                                    </div>
                                   
                                    <div class="form-group mb-4">
                                        <label for="message">Message</label>
                                        <textarea type="text" class="form-control" id="message" name="message"></textarea>
                                        <span id="message-error" class="error text-danger" for="message"></span>
                                    </div>
                                    <div class="form-group">
                                        <p class="msgresult text-success"></p>
                                        <p class="msgerror text-danger"></p>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block ">
                                        <span>Send</span>
                                       
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-promo">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8"><h2 class="text-primary text-uppercase">READY TO Book An Appointment ?</p></div>
                    <div class="col-lg-4d-flex align-items-center justify-content-center justify-content-end">
                        <a href="appointment.php" class="btn btn-primary btn-lg"> Book An Appointment</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include 'footer.php';?>
