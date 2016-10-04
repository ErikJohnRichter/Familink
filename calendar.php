<?php
    require("common.php"); 
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
      
      <h2 class="page_title">EVENTS</h2>
      
      <div class="page_content" style="margin: 0 auto;">
      
      
      <?php

                        $query = " 
                            SELECT 
                                * 
                            FROM family_member
                            WHERE 
                                family_id = :id 
                            
                        "; 
                         
                        $query_params = array( 
                            ':id' => $_SESSION['family_id'] 
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
                        if ($rows) {
                            foreach ($rows as $x) {
                              if ($x['dob'] != null) {
                            echo $x['first_name'].' '.$x['last_name'].' - Birthday: '.$x['dob'].'<br>';
                            }
                          }
                            
                        }
                        else {
                            echo 'No events';
                        }

                        ?>

      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>