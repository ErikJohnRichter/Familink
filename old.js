'<tr>'+
                        '<td><input type="text" id="Title-'+x+'" class="form-control form-control-text" name="Title-'+x+'" placeholder="Column Title" /></td>'+
                        '<td><select class="form-control" id="Type-'+x+'">'+
                                '<option value="select">Select Data Category</option>'+
                                '<option value="human">Human</option>'+
                                '<option value="geo">Geo</option>'+
                                '<option value="text">Text</option>'+
                                '<option value="numeric">Numeric</option>'+
                                '<option value="other">Other</option>'+
                            '</select>'+
                        '</td>'+
                        '<td><select class="form-control" id="Data-'+x+'">'+
                                '<option value="">Select a Data Category</option>'+
                            '</select>'+
                        '</td>'+
                        '<script type="text/javascript">'+
                            '$("#Type-'+x+'").change(function() {'+
                            '    var val = $(this).val();'+
                            '    if (val == "select") {'+
                            '        $("#Data-'+x+'").html("<option>Select a Data Category</option>");'+
                            '    }'+
                            '   else if (val == "human") {'+
                            '        $("#Data-'+x+'").html("<option>Select a Data Type</option><option value=\u0039test\u0039>Human</option>");'+
                            '    } '+
                            '    else if (val == "geo") {'+
                            '        $("#Data-'+x+'").html("<option>Select a Data Type</option><option>Geo</option>");'+
                            '    } '+
                            '    else if (val == "text") {'+
                            '        $("#Data-'+x+'").html("<option>Select a Data Type</option><option>Text</option>");'+
                            '    } '+
                            '    else if (val == "numeric") {'+
                            '        $("#Data-'+x+'").html("<option>Select a Data Type</option><option>Numeric</option>");'+
                            '    } '+
                            '    else if (val == "other") {'+
                            '        $("#Data-'+x+'").html("<option>Select a Data Type</option><option>Other</option>");'+
                            '    }'+
                            '});'+
                        '</script>'+
                        '<td><input type="text" id="Options-'+x+'" class="form-control form-control-text" name="Options-'+x+'" placeholder="Options" /></td>'+
                        '<td><a href="#" class="removeRow"><i class="fa fa-times" aria-hidden="true" style="color: red;"></i></a></td>'+
                    '</tr>'