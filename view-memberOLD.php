<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            SELECT * FROM family_member 
            WHERE 
                id = :memberid AND
                family_id = :familyid
            
        "; 
         
        $query_params = array( 
            ':memberid' => $_POST['member-id'],
            ':familyid' => $_POST['family-id']
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
            echo '<form action="delete-member.php" method="post" id="deleteFamilyMember" style="display: inline-block;">';
            echo '<input type="hidden" name="member-id" value="'.$_POST['member-id'].'">';
            echo '<input type="hidden" name="family-id" value="'.$_POST['family-id'].'">';
            echo '<button type="submit" id="deleteMember" class="btn btn-default btn-file btn-red" style="width: 30px; height: 30px; margin-bottom: 4px; margin-left: 3px;" name="submit"/><i class="fa fa-remove" aria-hidden="true"></i></button>';
         	echo '</form>';
    } 
     
?> 