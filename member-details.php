<?php
require("common.php"); 
//Include database connection here
$memberId = $_GET["id"]; 
// Run the Query
   $query = " 
            SELECT * FROM family_member 
            WHERE 
                id = :memberid AND
                family_id = :familyid
            
        "; 
         
        $query_params = array( 
            ':memberid' => $memberId,
            ':familyid' => $_SESSION['family_id']
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

        $rows = $stmt->fetchAll();
?>

<div class="pages">
  <div data-page="shopitem" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">  
      <div class="shop_header_title">
          
          <a href="#" data-panel="left" class="open-panel">BACK TO MEMBERS</a>
      </div>
      
      <div class="page_content">
          <div class="shop_item_details" style="font-size: 18px;">
          <?php    
        
            if ($rows) {
                foreach ($rows as $x) {
                  $lastname = str_replace('&nbsp;', ' ', $x['last_name']);
                  echo '<h2 style="font-size: 20px;">'.strtoupper($x['first_name']).'&nbsp'.strtoupper($lastname).'</h2><br>';

                    if ($x['email'] != null) {
                        echo '<strong>Email: </strong><a href="mailto:'.$x['email'].'?body=<br><br><br>Sent from Familink" class="external">'.$x['email'].'</a><br>';
                    }
                  
                    if ($x['mobile_phone'] != null) {
                        echo '<strong>Mobile: </strong><a href="tel:'.$x['mobile_phone'].'" class="external">'.$x['mobile_phone'].'</a><br>';
                    }
                  
                    if ($x['home_phone'] != null) {
                    echo '<strong>Home: </strong><a href="tel:'.$x['home_phone'].'" class="external">'.$x['home_phone'].'</a><br>';
                    }

                    if ($x['address1'] != null) {
                      echo '<strong>Address: </strong><br>'.
                      $x['address1'].'<br>';

                      if ($x['address2'] != null) {
                        echo $x['address2'].'<br>';
                      }

                      echo $x['city'].', '.$x['state'].' '.$x['zip'].'<br><br>';
                    }

                    if ($x['dob'] != null) {
                        echo '<strong>Birthday: </strong>'.$x['dob'];
                        if ($x['dob_year'] != null) {
                          
                          $birthmonth = date('m', strtotime($x['dob_month']));
                          $birthday = $x['dob_year'].'-'.$birthmonth.'-'.$x['dob_day'];
                          $date1 = date("Y-m-d", strtotime($birthday));
                          $date2 = date("Y-m-d");

                          $datetime1 = date_create($date1);
                          $datetime2 = date_create($date2);
                          $interval = date_diff($datetime1, $datetime2);
                          $howOld = $interval->format('%y');
                          
                           echo ', '.$x['dob_year'].' - <i>'.$howOld.'</i>';
                         }
                         echo '<br>';
                    }

                    if ($x['anniversary'] != null) {
                        echo '<strong>Anniversary: </strong>'.$x['anniversary'];
                        if ($x['anniversary_year'] != null) {

                          $aniversarymonth = date('m', strtotime($x['anniversary_month']));
                          $aniversaryday = $x['anniversary_year'].'-'.$aniversarymonth.'-'.$x['anniversary_day'];
                          $date3 = date("Y-m-d", strtotime($aniversaryday));
                          $date4 = date("Y-m-d");

                          $datetime3 = date_create($date3);
                          $datetime4 = date_create($date4);
                          $interval2 = date_diff($datetime3, $datetime4);
                          $howMany = $interval2->format('%y');

                           echo ', '.$x['anniversary_year'].' - <i>'.$howMany.'</i>';
                         }
                         echo '<br>';
                    }

                    if ($x['family_unit_1'] != null) {
                        echo '<strong>Family Units: </strong>'.$x['family_unit_1'];
                        
                        if ($x['family_unit_2'] != null) {
                            echo ', '.$x['family_unit_2'];
                            
                            if ($x['family_unit_3'] != null) {
                                echo ', '.$x['family_unit_3'];
                            }
                        }
                    }

                    if ($x['notes'] != null) {
                        echo '<br><strong>Notes: </strong>'.$x['notes'].'<br>';
                    }

                    echo '<br><br><table style="padding-top: 20px; margin: 0 auto;">';
                    echo '<tr>';

                    if ($x['mobile_phone'] != null) {
                      echo '<td style="padding: 10px; text-align: center"><a href="tel:'.$x['mobile_phone'].'" class="external" ><img src="images/icons/blue/phone.png" alt="" title="" style="margin: 0 auto; text-align: center; width: 50px;"/><span style="text-align: center">CALL '.strtoupper($x['first_name']).'</span></a></td>';
                    }
                    else if ($x['home_phone'] != null) {
                      echo '<td style="padding: 10px; text-align: center"><a href="tel:'.$x['home_phone'].'" class="external" ><img src="images/icons/blue/phone.png" alt="" title="" style="margin: 0 auto; text-align: center; width: 50px;"/><span style="text-align: center">CALL '.strtoupper($x['first_name']).'</span></a></td>';
                    }
                    if ($x['email'] != null) {
                      echo'<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                      echo '<td style="padding: 10px; text-align: center"><a href="mailto:'.$x['email'].'?body=<br><br><br>Sent from Familink" class="external" ><img src="images/icons/blue/contact.png" alt="" title="" style="margin: 0 auto; text-align: center; width: 50px;"/><span style="text-align: center">EMAIL '.strtoupper($x['first_name']).'</span></a></td>';
                    } 
                    if ($x['mobile_phone'] != null) {
                      echo'<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                      echo '<td style="padding: 10px; text-align: center"><a href="sms:'.$x['mobile_phone'].'" class="external" ><img src="images/icons/blue/message.png" alt="" title="" style="margin: 0 auto; text-align: center; width: 50px;"/><span style="text-align: center">TEXT '.strtoupper($x['first_name']).'</span></a></td>';
                    }

                    echo '</tr>';
                    echo '</table>';
                }
                
            }
            else {
                echo '<h4>sorry!<br>there seems to be an error now!<br>try again in a bit!</h4>';
            }
           

 ?>     
          <br><br><br>
          <div style="float:right;">
           <form action="edit-member.php" method="post" style="display: inline-block;">
          <input type="hidden" name="member-id" value="<?php echo $memberId ?>" >
          <button type="submit" class="button" style="display: inline-block; width: 70px;">Edit</button>&nbsp;&nbsp;
          </form>
          <button class="button" style="display: inline-block; width: 70px;"><a href="familink-secure.php">Cancel</a></button>

        </div>
          
          </div>

          
      </div>
      
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>