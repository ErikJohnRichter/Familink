<?php
require("common.php"); 
//Include database connection here
$Id = $_GET["id"]; //escape the string if you like
// Run the Query

echo '<div class="modal-body">';
   
    
        $query = " 
            SELECT * FROM family_member 
            WHERE 
                id = :memberid
            
        "; 
         
        $query_params = array( 
            ':memberid' => $Id
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
                	echo '<h3>'.$x['first_name'].'&nbsp'.$x['last_name'].'</h3>'.
                	'<strong>Email: </strong>'.$x['email'].'<br>'.
                	'<strong>Mobile: </strong>'.$x['mobile_phone'].'<br>';
                	if ($x['home_phone'] != null) {
	                	echo '<strong>Home: </strong>'.$x['home_phone'].'<br>';
	                }
                	echo '<strong>Address: </strong><br>'.
                	$x['address1'].'<br>';
                	if ($x['address2'] != null) {
                		echo $x['address2'].'<br>';
                	}
                	echo $x['city'].', '.$x['state'].' '.$x['zip'].'<br><br>'.
                	'<strong>Birthday: </strong>'.$x['dob'].'<br>'.
                	'<strong>Family Unit: </strong>'.$x['family_unit_id'].'<br>';
                }
                
            }
           

     

echo '</div>'.
'<div class="modal-footer">'.
    '<button type="button" class="btn btn-default">Submit</button>'.
    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'.
'</div>';
?> 