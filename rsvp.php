<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 

        if ($_POST['action'] == 'yes') {

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                yes = :yes AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $yes = $stmt->fetchAll();

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                no = :no AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $no = $stmt->fetchAll();

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                maybe = :maybe AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $maybe = $stmt->fetchAll();

            if ($no) {

                $query = " 
                DELETE 
                FROM event_rsvp
                WHERE 
                    event_id = :eventid AND
                    no = :no AND
                    family_id = :id
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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


                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    yes,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :yes,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }

            else if ($maybe) {

                $query = " 
                DELETE 
                FROM event_rsvp
                WHERE 
                    event_id = :eventid AND
                    maybe = :maybe AND
                    family_id = :id
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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


                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    yes,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :yes,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }

            else if ($yes) {

            }

            else {

                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    yes,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :yes,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }

        }

        if ($_POST['action'] == 'no') {

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                yes = :yes AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $yes = $stmt->fetchAll();

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                no = :no AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $no = $stmt->fetchAll();

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                maybe = :maybe AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $maybe = $stmt->fetchAll();

            if ($yes) {

                $query = " 
                DELETE 
                FROM event_rsvp
                WHERE 
                    event_id = :eventid AND
                    yes = :yes AND
                    family_id = :id
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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


                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    no,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :no,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }

            else if ($maybe) {

                $query = " 
                DELETE 
                FROM event_rsvp
                WHERE 
                    event_id = :eventid AND
                    maybe = :maybe AND
                    family_id = :id
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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


                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    no,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :no,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }

            else if ($no) {

            }
            else {
                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    no,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :no,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }
            
        }

        if ($_POST['action'] == 'maybe') {

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                no = :no AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $no = $stmt->fetchAll();

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                maybe = :maybe AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $maybe = $stmt->fetchAll();

            $query = " 
            SELECT 
                * 
            FROM event_rsvp
            WHERE 
                event_id = :eventid AND
                yes = :yes AND
                family_id = :id
            "; 
             
            $query_params = array( 
                ':eventid' => $_POST['event-id'],
                ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
             
            $yes = $stmt->fetchAll();

            if ($no) {

                $query = " 
                DELETE 
                FROM event_rsvp
                WHERE 
                    event_id = :eventid AND
                    no = :no AND
                    family_id = :id
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':no' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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


                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    maybe,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :maybe,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }

            else if ($yes) {

                $query = " 
                DELETE 
                FROM event_rsvp
                WHERE 
                    event_id = :eventid AND
                    yes = :yes AND
                    family_id = :id
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':yes' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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


                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    maybe,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :maybe,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }

            else if ($maybe) {

            }
            else {
                $query = " 
                INSERT INTO event_rsvp ( 
                    event_id,
                    maybe,
                    family_id
                    
                ) VALUES ( 
                    :eventid,
                    :maybe,
                    :familyid
                    
                ) 
                "; 
                 
                $query_params = array( 
                    ':eventid' => $_POST['event-id'],
                    ':maybe' => nl2br(htmlspecialchars($_POST['rsvp'], ENT_QUOTES)),
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
            }
            
        }

        header("Location: familink-secure.php"); 
         
        die("Redirecting to familink-secure.php");

    } 
     
?> 