<!-- Offices -->
<?php include('offices.php'); ?>
<!-- end of Offices -->

<!-- Contacts -->
				<div class="contact_container">
					<div class="email_container">
						<p><strong>Email us on:</strong><br></p>
						<p><a href="#" class="saleslink">sales@netmatters.com</a></p>
						<p><strong>Business hours:</strong></p>
						<p><strong>Monday - Friday 07:00 - 18:00&nbsp;</strong></p>

						<div>
    						<a href="#" onclick="showContact(); return false;">
    							<p>Out of Hours IT Support <em style="font-style: normal" class="fa fa-chevron-down rotate"></em></p>
    						</a>
    						<div class="hidden_contact">
    							<div class="hcc">
            						<p>
            							Netmatters IT are offering an Out of Hours service for Emergency and Critical tasks.
            						</p>
            						<p>
            							<strong>Monday - Friday 18:00 - 22:00</strong>
            							<strong>Saturday 08:00 - 16:00</strong><br>
            							<strong>Sunday 10:00 - 18:00</strong>
            						</p>
            						<p>
            							To log a critical task, you will need to call our main line number and select 
            							Option 2 to leave an Out of Hours&nbsp;voicemail. A technician will contact 
            							you on the number provided within 45 minutes of your call.&nbsp;
            						</p>
            					</div>
        					</div>
						</div>
					</div>

					<div class="form_container">
						<div id="resultdiv"></div>
						<form id="contact_form" method="POST" action="?page=formhandler"  accept-charset="UTF-8">
							<div class="row">
								<div class="col">
        							<label for="name" class="required">Your Name</label>
        							<input name="name" type="text" value="" id="name">
        						</div>
								<div class="col">
        							<label for="company" class="">Company Name</label>
        							<input name="company" type="text" value="" id="company">
        						</div>
							</div>
							<div class="row">
								<div class="col">
        							<label for="email" class="required">Your Email</label>
        							<input name="email" type="text" value="" id="email">
        						</div>
								<div class="col">
        							<label for="phone" class="required">Your Telephone Number</label>
        							<input name="phone" type="text" value="" id="phone">
        						</div>        							
							</div>
							<div class="row">
								<div class="col">
        							<label for="subject" class="required">Subject</label>
        							<input name="subject" type="text" id="subject">
        						</div>
							</div>
							<div class="row">
								<div class="col">
        							<label for="msg" class="required">Message</label>
        							<textarea name="message" cols="50" rows="10" id="msg"></textarea>
        						</div>
							</div>
							<div class="row1">
								<span>
        							<input name="marketing" type="checkbox" value="1" id="marketing">
        						</span>
        						<span>
        							<label for="marketing">Please tick this box if you wish to receive marketing information from us.
        							Please see our <a href="#" target="_blank" rel="noopener noreferrer">Privacy Policy</a> for more information on how we keep your data safe.</label>
        						</span>
							</div>
							<div class="row1">
								<div class="col">
        							<div><span><input type="submit" name="submit" value="Send Enquiry" id="submit"><span></span></span></div>
        						</div>
								<div class="col">
        							<span class="reqtext"><small>Fields Required</small></span>
        						</div>
							</div>
						</form>
					</div>
				</div>
				<!-- end of  Contacts -->