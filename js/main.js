
$(window).load(function(){
    $('#page-loader').fadeOut(500);
  }); 

//Input validation
$(document).ready(function(){
    $('.desktopInput').focus(function(){
        $("input").keyup(function(){
            var value = this.value;
            if (value == '') {
                $(this).prev("label").css("color", "black");
            }
            else {
                $(this).prev("label").css("color", "#29b958");
            }
        });
    });
});

/*$(document).ready(function() {
$('.delete-confirm').on('click', function (e){
    var $form = $(this).closest('form');
    e.preventDefault();
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        
});
});*/

//Add Unit appear
$(document).ready(function(){
    $("#addUnitButton").click(function(){
        $(this).blur();
        $("#addUnitForm").toggle('fast');
    });
});

//Add Member appear
$(document).ready(function(){
    $("#addMemberButton").click(function(){
        $(this).blur();
        $("#addMemberForm").toggle('fast');
    });
});

//Typed strings
$(function(){

    $("#typed").typed({
        // strings: ["Family, linked!", "familink"],
        stringsElement: $('#typed-strings'),
        typeSpeed: 30,
        backDelay: 500,
        loop: false,
        contentType: 'html', // or text
        // defaults to false for infinite loop
        loopCount: false,
        callback: function(){ foo(); },
        resetCallback: function() { newTyped(); }
    });

    $(".reset").click(function(){
        $("#typed").typed('reset');
    });

});

function newTyped(){ /* A new typed object */ }

function foo(){ console.log("Callback"); }

$("#loginBox").delay(3100).fadeIn(300);


// Sliding Labels
$(function(){ $('#contactform').slidinglabels({ 
    /* these are all optional */ 
    className : 'slider', // the class you're wrapping the label & input with -> default = slider 
    topPosition : '6px', // how far down you want each label to start 
    leftPosition : '0px', // how far left you want each label to start 
    axis : 'x', // can take 'x' or 'y' for slide direction 
    speed : 'fast' // can take 'fast', 'slow', or a numeric value 
    }); 
});

// Sliding Labels
$(function(){ $('#contactform1').slidinglabels2({ 
    /* these are all optional */ 
    className : 'slider', // the class you're wrapping the label & input with -> default = slider 
    topPosition : '6px', // how far down you want each label to start 
    leftPosition : '10px', // how far left you want each label to start 
    axis : 'x', // can take 'x' or 'y' for slide direction 
    speed : 'fast' // can take 'fast', 'slow', or a numeric value 
    }); 
});


// Resets Member Details Modal
/*$( document ).ready(function() {
    $('#memberDetails').on('hidden.bs.modal', function () {
          $(this).removeData('bs.modal');
    });
});*/


$('#deleteForm').on('submit', function( event ) {
    event.preventDefault();
    var url = 'delete.php';
    $.post( url, { id: id }, function(d) { 
       alert( 'This configuration has been deleted.' ); 
    });
});


// Generate Data Submit Button
$(document).ready(function() {
    $('#submitButton').click(function() {
        $('#dataForm').submit();
    });
});

