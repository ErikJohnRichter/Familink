<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 

        $repliedBy = $_POST['replied-by'];
        $repliedFirstLast = explode(" ", $repliedBy, 2);
        $repliedlastname = htmlentities($repliedFirstLast[1], ENT_QUOTES);
        $query = " 
            SELECT 
                * 
            FROM family_member
            WHERE 
                first_name = :repliedfirstname AND
                last_name = :repliedlastname AND
                family_id = :id
        "; 
         
        $query_params = array( 
            ':repliedfirstname' => $repliedFirstLast[0],
            ':repliedlastname' => $repliedlastname,
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
         
        $rowz = $stmt->fetchAll();
        if ($rowz) {
            foreach ($rowz as $y) {
                $repliedFirst = $y['first_name'];
                $repliedLast = $y['last_name'];
            }
            
        }

        $query = " 
            INSERT INTO event_replies ( 
                event_id,
                reply,
                family_id,
                replied_by_first,
                replied_by_last
                
            ) VALUES ( 
                :event_id,
                :reply,
                :familyid,
                :repliedbyfirst,
                :repliedbylast
                
            ) 
        "; 
         
        $query_params = array( 
            ':event_id' => $_POST['event-id'],
            ':reply' => nl2br(htmlspecialchars($_POST['reply-body'], ENT_QUOTES)),
            ':familyid' => $_SESSION['family_id'],
            ':repliedbyfirst' => $repliedFirst,
            ':repliedbylast' => $repliedLast
            
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

         
        header("Location: familink-secure.php"); 

        die("Redirecting to familink-secure.php");

    } 
     
?> 