<?php
    require("common.php"); 
     
   
    if(empty($_SESSION['user'])) 
    { 
        
        header("Location: index.php"); 
         
        
        die("Redirecting to index.php"); 
    } 

    $query = " 
        SELECT 
            * 
        FROM users
        WHERE 
            id = :id 
    "; 
     
    $query_params = array( 
        ':id' => $_SESSION['userid'] 
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
     
    $row = $stmt->fetch();

    if ($row['is_admin'] != 1) {

        header("Location: index.php"); 
        
        die("Redirecting to index.php"); 
    }

    $query = " 
        SELECT 
            * 
        FROM users
        WHERE 
            id = :id 
    "; 
     
    $query_params = array( 
        ':id' => $row['family_id'] 
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
     
    $rows = $stmt->fetch();

?>

<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<div class="pages">
  <div data-page="features" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">
      
      <h2 class="page_title">EDIT ACCOUNT</h2>
      
      <div class="page_content">
      
      
          <!--Change Admin Username and Password-->
<br>
<div class="form-group" id="changeAdminCredentials">
    <form action="change-admin-credentials.php" method="post">
    <table align="center" style="margin: 0 auto;">
        <thead>
        <h4 style="margin-bottom: 15px;">admin credentials</h4>
        </thead>
        <tbody>
        <tr> 
            <td style="width: 100px;">
                <label for="changeAdminUsernameInput" style="font-size: 20px;">Username</label>
            </td>
            <td>
                <input class="desktopInput2 generalInput" id="changeAdminUsernameInput" type="text" name="new-admin-username" placeholder="New Username" style="font-size: 20px; width: 170px;" value="<?php echo $row['username']; ?>"/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr> 
            <br>
            <td style="width: 100px;">
                <label for="changeAdminPasswordInput" style="font-size: 20px;">Password</label>
            </td>
            <td>
                <input class="desktopInput2 generalInput" id="changeAdminPasswordInput" type="password" name="new-admin-password" style="font-size: 20px; width: 170px;" placeholder="New Password" value=""/>
            </td>
        </tr>
    </table>
        <table style="margin: 0 auto;">
        <tr>
            <td><br><button id="changeAdmin" type="submit" class="button" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Change</button></td>
            
        </tr>
    </tbody>
    </table>
    </form>
</div>   
<br>  
<!--Change Family Username and Password-->

<hr>
<br>
<div class="form-group" id="changeFamilyCredentials">
    <form action="change-family-credentials.php" method="post">
    <table align="center" style="margin: 0 auto;">
        <thead>
        <h4 style="margin-bottom: 15px;">family credentials</h4>
        </thead>
        <tbody>
        <tr> 
            <td style="width: 100px;">
                <label for="changeFamilyUsernameInput" style="font-size: 20px;">Username</label>
            </td>
            <td>
                <input class="desktopInput2 generalInput" id="changeFamilyUsernameInput" type="text" name="new-family-username" style="font-size: 20px; width: 170px;" placeholder="New Username" value="<?php echo $rows['username']; ?>"/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr> 
            <td style="width: 100px;">
                <label for="changeFamilyPasswordInput" style="font-size: 20px;">Password</label>
            </td>
            <td>
                <input class="desktopInput2 generalInput" id="changeFamilyPasswordInput" type="password" name="new-family-password" style="font-size: 20px; width: 170px;" placeholder="New Password" value=""/>
            </td>
            </tr>
            </table>
            <table style="margin: 0 auto;">
        <tr>
            <td><br><button id="changeFamily" type="submit" class="button" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Change</button></td>
            
        </tr>
    </tbody>
    </table>
    </form>
</div>     

<!--Change Family Name-->
<br><br>
<div class="form-group" id="changeFamilyName">
    <form action="change-family-name.php" method="post">
    <table align="center" style="margin: 0 auto;">
        <tr> 
            <td>
                <label for="changeFamilyNameInput" style="font-size: 20px;">Family&nbsp;&nbsp;</label>
            </td>
        
            <td>

                <input class="desktopInput2 generalInput" id="changeFamilyNameInput" type="text" name="new-family-name" style="font-size: 20px; width: 170px;" placeholder="New Family Name" value="<?php echo $row['family_name']; ?>"/>
            </td>
        </tr>
    </table>
    <table style="margin: 0 auto;">
                <tr>
            <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
            <td><br><button id="changeFamilyName" type="submit" class="button" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Change</button></td>
            
            </tr>
    </table>
    </form>
</div> 
<br>    

<!--Delete Account-->

<hr>
<br>
<div class="form-group" id="deleteFamilyAccount">
    <form action="delete-account.php" method="post">
    <table align="center" style="margin: 0 auto;">
        <thead>
        <h4 style="margin-bottom: 15px;">delete account</h4>
        </thead>
        <tr> 
            <input type="hidden" name="family-id" value="<?php echo $_SESSION['family_id'] ?>">
            <td><button id="deleteFamily" type="submit" class="button" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Delete Family</button></td>
        </tr>
    </table>
    </form>
</div>

</div>  

<script>
$(function() {
   $("#deleteFamily").click(function(){
      if (confirm("Are you sure you want to delete your familink account? This is perminant and you and your family will no longer have access to this account.")){
         $('#deleteFamilyAccount').submit();
      }
      else {
        return false;
      }
   });
});

</script>       

      
      
      </div>
      
     </div>
      
      
    </div>
  </div>
</div>