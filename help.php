<?php
require("common.php"); 

$query = " 
        SELECT 
            * 
        FROM users
        WHERE 
            family_id = :familyid AND 
            is_admin = :isadmin
    "; 
     
    $query_params = array( 
        ':familyid' => $_SESSION['family_id'],
        ':isadmin' => 1
    ); 
     
    try 
    { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    { 
        die($ex); 
    } 
     
    $admin = $stmt->fetch();

?>

<div class="pages">
  <div data-page="features" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">
      
      <h2 class="page_title">FREQUENTLY ASKED QUESTIONS</h2>
      
      <div class="page_content">

          

      <div class="custom-accordion accordion-list">
      <ul class="features_list_detailed">
      
      
          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >I'm new to Familink. Now what?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
          If you logged in with a shared family username, you're already set! You may view and edit family member contact info, send emails to your Family Units, create and view upcoming events,  
          and post messages on the open forum. You may use this app from any desktop or mobile device. However, if you have an iOS device, you may also use this as a web app. Visit the site from Safari, click the Share button (rectangle with an up arrow) and click "Save To Homescreen." We also strongly recommend 
          adding <a href="mailto:familink@codingerik.com" style="color:blue;" class="external">familink@codingerik.com</a> to your email's safe sender's list to avoid emails from Familink going into your Junk Mailbox. Additionally, look forward to some cool, new upcoming features such as continued contact export and family archives with Dropbox integration!<br><br>

          If you just created your family's Familink account as an administrator and/or are logged in with those credentials, you may do all of the things 
          a shared family logged-in user may do plus maintain your family's Familink account...adding family members, updating Family Units, changing login 
          credentials for your admin or family logins, and even change your family name! As an admin, you are responsible for making sure members are added. The app is 
          set up this way so, when family members receive the shared login, the app is all ready to go. Your family will thank you!
          </div>
        </div>
         </div>
          </li>

          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How will this app help me and my family?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
          One of the beautiful things about Familink is you never have to worry about keeping up with everyone's current contact info! It is
            always here! If Uncle Bob gets a new cell phone number, he can edit his details...and Mom doesn't need to change it in her phone. If Cousin
            Julie graduates and loses her school email, she can change that to her new work address...so the next time Grandma sends an email inviting
            people to dinner next Friday, Julie will definitely be showing up! Even though a detail may change for one member, everyone
            else in the family instantly has access to that change all from a central location.<br><br>

            Extending from this, through Familink, users are able to leverage their family members' current emails with the Family Unit feature!
            Family Units are smaller groups of individuals that reside in the whole family. 
            When sending emails from Familink, Julie no longer needs to remember to type every cousin's email address, some of which may be outdated, 
            when sending the invite to the cousins' baseball game next month. She can simply select "Cousins" and send! With Family Units, users
            can send emails to the Whole Family, individual Family Units, or individual members...knowing every email will get sent to the right people
            at valid addresses, and, more importantly, received by them!<br><br>

            Familink. Keeping families linked!
          </div>
        </div>
         </div>
          </li>
       
          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How do I see a family member's contact info?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
          1) In the Members sidebar, select a family member from the list.<br><br>                    
          2) Keep contact info and details current so everyone in the family has the most up-to-date info!
          </div>
        </div>
         </div>
          </li>
          

          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How do I email family members?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
          1) Select the Whole Family, individual Family Units, and/or individual family members from the Recipients dropdown to add.<br><br>
            2) Type the subject of your email and email body.<br><br>
            3) Select your name as the sender. This is the person who will receive all replys to the current email.<br><br>
            4) Send your email!
          </div>
        </div>
         </div>
          </li>


          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How do I edit family member contact details?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
          1) Select the family member from the Member sidebar.</br><br>
                                2) Scroll to the bottom of the details page and click "Edit."<br><br>
                                3) Edit all details that need to be changed and click "Save."
          </div>
        </div>
         </div>
          </li>
          

           <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How do I add family members and Units?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          We all love growing families! Family Members and Units can be added by your family's Familink administrator, 
          <a href="mailto:<?php echo $admin['email']; ?>" class="external" style="color: blue;"><?php echo $admin['email']; ?></a>. If you are your family's admin:<br><br>

         1) Go to the Admin-only Add/Delete section.<br><br>
                                2) Here you may add or delete family members and add or delete Family Units.<br><br>
                                3) NOTE - This should be done before sending your family the common login credentials.
          </div>
        </div>
         </div>
          </li>


          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How do I see or add a custom family event?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         1) Go to the Events page.</br><br>
                                2) Here you will see a list of all your family's upcoming birthdays, anniversaries and custom events. You may click on any of the custom events to view its details.<br><br>
                                3) If you would like to create a custom event, click the "Add an event" tab, enter your event details along with who the event is for, select yourself as the creator, and click "Add event."<br><br>
                                4) After clicking "Add event," the event will show in the upcoming events section when its start date is less than 60 days away.<br><br>
                                5) After clicking "Add event," members of the family unit you created the event for will recieve an email letting them know you created an event with its details.
          </div>
        </div>
         </div>
          </li>
          
          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How do I post a message on the open forum?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         1) Go to the Forum page.</br><br>
                                2) Here you will see a list of all the open messages your family members have posted. You may click on any of them and reply.<br><br>
                                3) If you would like to post your own message, click "Post a message," type your message, select yourself as the poster, and click "Post!"
          </div>
        </div>
         </div>
          </li>
          

          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >I have email. Why would I want to use this instead?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         The answer to this question is actually one of the biggest inspirations for the creation of this app!...contact details always change! 
          People get new phone numbers, email addresses, and homes...but you don't. What you have in your phone or computer address book today 
          may be outdated in a month...and you won't know when it is! Familink was inspired by the idea of a common address book that everyone 
          can add to and edit, giving every family member access to that family's most-current contact info from a central location. 
          Through the app, users can take advantage of this benefit with the integrated email/messaging, calling, and Family Unit features to 
          minimize app switching! This service was designed to be a natural extension of your every-day phone/computer use...to visit it just as 
          you would your contact, address, or social media apps...but knowing this app's data is more reliable. Gone are the days when you get 
          bounced emails or need to prelude every communication with, "send to those I missed." Gone are the days when Fred pick up the phone 
          without knowing who Fred is, or even worry that people are not seeing your messages. Familink solves this.<br><br>
          Familink is, truly, family connected. It is family linked!
          </div>
        </div>
         </div>
          </li>
          
          
          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >Why do I have a shared username/password?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         In one word, simplicity. Many families are quite large and the their members have very busy lives. The concept that a single administrator, 
                                at a family's Familink account creation, is in charge of creating the Family Units and adding individual family members ensures the account 
                                is good-to-go. To wait on each family member to add themselves takes away from the reliability of the service. From here, the Familink administrator creates a common username/password to be used by all family members. This allows the administrator to 
                                easily share the account, giving everyone in the family instant access to the app...essentially, plug-and-play. It also means any family member can edit any contact details at any time to ensure the most up-to-date info. At any time, the administrator can change the common username/password, add or delete members, and add or delete units.
          </div>
        </div>
         </div>
          </li>
          

          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >How will Familink emails show up in my Inbox?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         All emails sent from Familink will be sent from <a href="mailto:familink@codingerik.com" class="external" style="color: blue;">familink@codingerik.com</a>. They should be delivered to your Inbox, but we still recommend
                                adding this email address to your contacts so they don't, accidentally, end up in your Spam Folder or anywhere else. The Reply-To address
                                for each email will be to the person selected in the "Sent From" dropdown when composing the email. All reply threads will be to and from
                                this person's email address.
          </div>
        </div>
         </div>
          </li>

          
          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >Can Uncle Jim send an email from Cousin Sarah?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         Yes. But why would he? We are all family here!<br><br>
          The "Sent From" feature is in place because of the common family username. It is needed so all 
          replies to any email go to the intended recipient. Plus, all emails sent 
          from Familink will be from familink@codingerik.com so there is no confusion.
          </div>
        </div>
         </div>
          </li>
        

          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >Do you have any tips for using this site?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         Familink can be an extrememly useful tool for your family's ability to keep in touch. To maximize it's services, if you have any new personal
                                details, or know of any family members who do, change them in the individual member details page right away. This will ensure everyone has access to the most up-to-date info!
          </div>
        </div>
         </div>
          </li>
      

          <li style="padding-bottom: 2%;">
            <div class="accordion-item">
            <div class="accordion-item-toggle">
              <i class="icon icon-plus material-icons" style="font-size:35px;color: #2ad5dc;">chevron_right</i>
              <i class="icon icon-minus material-icons" style="font-size:35px;color: #2ad5dc;">keyboard_arrow_down</i>
              <span class="faq" >I found a bug! How do I report it?</span>
            
          <!--<i class="material-icons" style="display: inline-block; font-size: 35px; margin-right: 19px; color: #2ad5dc;">chevron_right</i><h4 style="color: #2a3452; display: inline-block; font-size:18px;">I'm new to Familink. Now what?</h4>-->
        </div>
        <div class="accordion-item-content">
          <div class="feat_small_details" style="padding-bottom: 20px; padding-left:50px;">
          
         First off, sorry! Secondly, thank you! Please let me know at <a href="mailto:helloworld@codingerik.com" style="color: blue;" class="external">helloworld@codingerik.com</a>.
           While zero bugs is pretty impossible, I do strive to minimize them as much as I can!
          </div>
        </div>
         </div>
          </li>
          
          
      </ul>
    </div>

      <br>
      <br>
      <button class="button" style="margin: 0 auto;"><a href="familink-secure.php">Back</a></button>
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>