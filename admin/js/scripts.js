$(document).ready(function(){
    

$('#selectAllBoxes').click(function(event){
    if(this.checked){
        $('.checkBoxes').each(function(event){
            this.checked=true;
        });
    }
    else{
       $('.checkBoxes').each(function(event){
            this.checked=false;
        });
    }
});
    
    var div_box="<div id='load-screen'><div id='loading'></div></div>";
$('body').prepend(div_box);
$('#load-screen').delay(1500).fadeOut(900,function(){
    $this.remove();
});
 
    });

//function loadUsersOnline(){
//    $.get("functions.php?loadusersonline=result", function(data){
//        $.("usersonline").text(data);
//    })
//}
//setInterval(function(){
//    loadUsersOnline();
//},500);

