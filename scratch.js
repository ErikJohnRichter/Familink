					var json = <?php echo $json; ?>;
                    var wrapper         = $(".dataTable"); 
                    var x = 0;
                    var tr;
                    for (var i = 0; i < json.length; i++) {
                        tr = $('<tr/>');
                        tr.append("<td>" + json[i].Title + "</td>");
                        tr.append("<td>" + json[i].Type + "</td>");
                        tr.append("<td>" + json[i].Data + "</td>");
                        tr.append("<td>" + json[i].Options + "</td>");
                        $('#dataTable').append(tr);
                    }
