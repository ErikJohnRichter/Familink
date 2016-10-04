<div class="panel panel-default" <?php if ($row['is_admin'] != 1) { echo 'style="display: none;"'; } ?>>
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
        <h3 class="panel-title">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              Family Units
            </a>
        </h3>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
        <div class="panel-body text-center">
            <button type="button" id="addUnitButton" class="btn btn-default btn-green" style="width: 30px; height: 30px; margin-right: 4px; margin-bottom: 4px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
            <form action="delete-unit.php" method="post" id="familyUnitForm" style="display: inline-block;">
                <select class="form-control" id="familyUnitSelect" style="display: inline-block; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="unit-name">
                  
                <?php

                $query = " 
                    SELECT 
                        * 
                    FROM family_unit
                    WHERE 
                        family_id = :id
                    ORDER BY unit_name asc;
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
                 
                $rows = $stmt->fetchAll();
                if ($rows) {
                    echo '<option value="" selected="selected">Select Family Unit</option>';
                    $count = 1;
                    foreach ($rows as $x) {
                    echo '<option value="'.$x['unit_name'].'">'.$count.')&nbsp&nbsp'.$x['unit_name'].'</option>';
                    $count++;
                    }
                    
                }
                else {
                    echo '<option value="">None added yet</option>';
                }

                ?>
                </select>
              
                <?php echo '<input type="hidden" name="family-id" value="'.$row['family_id'].'">'; ?>
                <button disabled type="submit" id="deleteUnit" class="btn btn-default btn-file btn-red delete-confirm" style="width: 30px; height: 30px; margin-bottom: 4px;" name="submit"/><i class="fa fa-remove" aria-hidden="true"></i></button>
            </form>
  
            <script type="text/javascript">
                                    
            $("#familyUnitSelect").change(function() {
                var dataVal = $(this).val();
                if (dataVal != "") {
                    document.getElementById("deleteUnit").disabled = false;
                }
                else {
                    document.getElementById("deleteUnit").disabled = true;
                }
                
            }).trigger('change');

            </script>
            <script>
                function validateUnitForm() {
                  var isValid = true;
                  $('.validateUnit').each(function() {
                    if ( $(this).val() === '' ) {
                        $(this).addClass('inputError');

                        isValid = false;
                    }
                    else if ($(this).val() != '') {
                        $(this).removeClass('inputError');
                    }
                  });
                  if (isValid == false) {
                    alert("Whoa, whoa, whoa! You definitely need to add a unit name first!")
                  }
                  return isValid;
                }

                

            </script>

            <div class="form-group" id="addUnitForm" style="margin-top: 5px;">
                <form onsubmit="return validateUnitForm()" action="add-family-unit.php" method="post">
                <table align="center">
                    <tr>
                        <td><p style="font-size: 25px; color: blue; font-weight: 300;">The</p></td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <input class="desktopInput2 validateUnit" id="unitInput" type="text" name="unit-name" placeholder="Family Unit Name" value="" style="height: 40px; font-size: 25px; margin-top: -20px; margin-bottom: 2px; border: none; border-bottom: solid 2px blue;" />
                        </td>
                    </tr>
                    <tr>
                        <td><p style="font-size: 25px; color: blue; font-weight: 300;">Family</p></td>
                    </tr>
                    <?php echo '<input type="hidden" name="family-id" value="'.$row['family_id'].'">'; ?>
                    <tr>
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                        <td><button id="addUnit" type="submit" class="btn btn-default btn-file btn-green" style="margin-top: 5px; width: 80px;"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></td>
                        
                    </tr>
                </table>
                </form>
            </div>     
        </div>
    </div>
</div>