<?php
require("common.php"); 
//Include database connection here
$memberId = $_GET["id"]; 
// Run the Query

echo '<div class="modal-body">';
   
    
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
            if ($rows) {
                foreach ($rows as $x) {
                	echo '<h3 class="mobileView">'.$x['first_name'].'&nbsp'.$x['last_name'].'</h3>';
                	
                    if ($x['email'] != null) {
                        echo '<strong>Email: </strong><a href="mailto:'.$x['email'].'">'.$x['email'].'</a><br>';
                    }
                	
                    if ($x['mobile_phone'] != null) {
                        echo '<strong>Mobile: </strong><a href="tel:'.$x['mobile_phone'].'">'.$x['mobile_phone'].'</a><br>';
                    }
                	
                    if ($x['home_phone'] != null) {
	                	echo '<strong>Home: </strong><a href="tel:'.$x['home_phone'].'">'.$x['home_phone'].'</a><br>';
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
                        echo '<strong>Birthday: </strong>'.$x['dob'].'<br>';
                    }

                    if ($x['anniversary'] != null) {
                        echo '<strong>Anniversary: </strong>'.$x['anniversary'].'<br>';
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
                }
                
            }
            else {
                echo '<h4>sorry!<br>there seems to be an error now!<br>try again in a bit!</h4>';
            }
           

     

echo '</div>'.
'<div class="modal-footer">'.
    '<form action="edit-member.php" method="post" style="display: inline-block;">'.
    '<input type="hidden" name="member-id" value="'.$memberId.'" >'.
    '<button type="submit" class="btn btn-default">Edit</button>&nbsp;&nbsp;'.
    '</form>'.
    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'.
'</div>';
?> 