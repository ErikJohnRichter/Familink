<?php
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
<div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseFour">
        <h3 class="panel-title">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
              Help and FAQs
            </a>
        </h3>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
        <div class="panel-body">

            <div class="text-center">
                <h5>frequently asked questions</h5>
                <br><br>
            </div>


                        
                            <p><strong>How will this app help me and my family?</strong></p>
                            <p>One of the beautiful things about familink is you never have to worry about keeping up with everyone's current contact info! It is
                                always here! If Uncle Bob gets a new cell phone number, he can edit his details...and Mom doesn't need to change it in her phone. If Cousin
                                Julie graduates and loses her school email, she can change that to her new work address...so the next time Grandma sends an email inviting
                                people to dinner next Friday, Judy will definitely be showing up! Even though a detail may change for one member, everyone
                                else in the family instantly has access to that change all from a central location.</p>
                            <p>Extending from this, through familink, users are able to leverage their family members' current emails with the Family Unit feature!
                                When sending emails from familink, Julie no longer needs to remember to type every cousin's email address, some of which may be outdated, 
                                when sending the invite to the cousins' baseball game next month. She can simply select "Cousins" and send! With Family Units, users
                                can send emails to the Whole Family, individual Family Units, or individual members...knowing every email will get sent to the right people
                                at valid addresses, and, more importantly, received by them!</p>
                            <p>Familink. Keeping families linked!</p>
                            <br>  
                            <p><strong>How do I see a family member's contact info?</strong></p>
                            <p> 1) In the Family Member section, select a family member from the dropdown list.<br>
                                2) Click the magnifying glass to view that member's contact info and other details.<br>
                                3) Edit contact info and details so everyone in the family has the most up-to-date info!</p>
                            <br>
                            <p><strong>How do I email family members?</strong></p>
                            <p> 1) Select the Whole Family, individual Family Units, and/or individual family members and add (+) them to the email.<br>
                                2) Type the subject of your email and email body.<br>
                                3) Select your name as the sender. This is the person who will receive all replys to the current email.<br>
                                4) Send your email!</p>
                            <br>
                            <p><strong>Why do I have a shared family username/password? Why can't I have my own?</strong></p>
                            <p>In one word, simplicity. Many families are quite large and the their members have very busy lives. The concept that a single administrator, 
                                at a family's familink account creation, is in charge of creating the Family Units and adding individual family members ensures the account 
                                is good-to-go. To wait on each family member to add themselves takes away from the reliability of the service. From here, the familink administrator creates a common username/password to be used by all family members...created by the administrator. This allows the administrator to 
                                easily share the account with everyone, giving everyone in the family instant access.</p>
                            <br>
                            
                            <p><strong>How will familink emails show up in my Inbox?</strong></p>
                            <p>All emails sent from familink will be sent from "familink@codingerik.com". They should be delivered to your Inbox, but we still recommend
                                adding this email address to your contacts so they don't, accidentally, end up in your Spam Folder or anywhere else. The Reply-To address
                                for each email will be to the person selected in the "Sent From" dropdown when composing the email. All reply threads will be to and from
                                this person's email address.</p>
                            <br>
                            <p><strong>Can Uncle Jim send an email saying it was sent from Cousin Sarah?</strong></p>
                            <p>Yes. But why would he? We're family here.</p>
                            <br>
                            <p><strong>How do I edit family member contact details?</strong></p>
                            <p>1) Select that family member in the Family Member section and click the magnifying glass.</br>
                                2) Click "Edit."<br>
                                3) Edit all details that need to be changed and click "Save."</p> 
                            <br>
                            <p><strong>How do I add a family member to my family?</strong></p>
                            <p>Family Members can be added by your family's familink administrator, <a href="mailto:<?php echo $admin['email']; ?>"><?php echo $admin['email']; ?></a>.</p> 
                            <br>
                            <p><strong>How do I add a family unit to my family?</strong></p>
                            <p>Family Units can be added by your family's familink administrator, <a href="mailto:<?php echo $admin['email']; ?>"><?php echo $admin['email']; ?></a>.</p> 
                            <br>
                            <p><strong>Do you have any tips to maximize my family's use of this site?</strong></p>
                            <p>Familink can be an extrememly useful tool for your family's ability to keep in touch. To maximize it's services, if you have any new personal
                                details, change them in your individual family member profile. This will ensure everyone has access to your most up-to-date details!</p> 
                            <br>



        </div>
    </div>
</div>