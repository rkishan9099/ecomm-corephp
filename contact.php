   <?php
   include("top.php");
   ?>
   <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Contact</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION CONTACT -->
        <div class="section pb_70">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="contact_wrap contact_style3">
                            <div class="contact_icon">
                                <i class="linearicons-map2"></i>
                            </div>
                            <div class="contact_text">
                                <span>Address</span>
                                <p>123 Street, Old Trafford, London, UK</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="contact_wrap contact_style3">
                            <div class="contact_icon">
                                <i class="linearicons-envelope-open"></i>
                            </div>
                            <div class="contact_text">
                                <span>Email Address</span>
                                <a href="/cdn-cgi/l/email-protection#1b72757d745b68726f7e757a767e35787476"><span class="__cf_email__" data-cfemail="aec7c0c8c1eed7c1dbdcc3cfc7c280cdc1c3">[email&#160;protected]</span> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="contact_wrap contact_style3">
                            <div class="contact_icon">
                                <i class="linearicons-tablet2"></i>
                            </div>
                            <div class="contact_text">
                                <span>Phone</span>
                                <p>+ 457 789 789 65</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION CONTACT -->

        <!-- START SECTION CONTACT -->
        <div class="section pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="heading_s1">
                            <h2>Get In touch</h2>
                        </div>
                        <p class="leads">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                        <div class="field_form">
                            <form method="post"  id="contact_form">
                                <div class="row">
                                  <input type="text" name="type" id="type" value="contact" hidden />
                                    <div class="form-group col-md-6">
                                      
                                        <input required placeholder="Enter Name *" id="first-name" class="form-control" name="name" type="text" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input required placeholder="Enter Email *" id="email" class="form-control" name="email" type="email" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input required placeholder="Enter Phone No. *" id="phone" class="form-control" name="phone" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input placeholder="Enter Subject" id="subject" class="form-control" name="subject" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea required placeholder="Message *" id="description" class="form-control" name="message" rows="4" required></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" title="Submit Your Message!" class="btn btn-fill-out" id="submitButtonContact" name="submit" value="Submit">Send Message</button>
                                    </div>
                                    <div class="col-md-12 mt-2 ">
                                        <div id="alert-msg" class="alert-msg text-center pt-2 pb-2">ffftt</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
                        <div id="map" class="contact_map2" data-zoom="12" data-latitude="40.680" data-longitude="-73.945" data-icon="assets/images/marker.png"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION CONTACT -->
<?php
include("footer.php");
?>
