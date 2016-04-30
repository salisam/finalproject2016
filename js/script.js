function sendRequest(u){
  // Send request to server
  //u a url as a string
  //async is type of request
  var obj=$.ajax({url:u,async:false});
  //Convert the JSON string to object
  var result=$.parseJSON(obj.responseText);
  //  alert("request sent");
  return result;  //return object
}

$(document).ready(function () {
    alert("Hey");
});

$(function(){
 $('#logo').click(function(e){
  login();
 });

});
$(function(){
 $('#addwine').click(function(e){
  addWine();
 });
});
  /*function all2(){
    var obj=sendRequest("../lab1/controller.php?cmd=1");
    if(obj.result==1){
      var win=obj.wine;
      var html="";
      for (var i = 0; i < win.length; i++) {
        if(i%2==0){
          html+='<tr style="background-color:khaki"><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
        else{
          html+='<tr><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
      }
      document.getElementById("MyResult").innerHTML=html;
      return;
    }
  }
  function searchName(){
    var name=document.getElementById("search.twig.twig").value;
    if(name==""){
      alert("Sorry, enter the name of wine searching");
      return;
    }
    else{
      var obj=sendRequest("../lab1/controller.php?cmd=2&name="+name);
      if(obj.result==1){
        var win=obj.wine;
        var html="";
        for (var i = 0; i < win.length; i++) {
          if(i%2==0){
          html+='<tr style="background-color:khaki"><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
          }
          else{
            html+='<tr><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
          }
        }
        document.getElementById("MyResult").innerHTML=html;
        return;
      }
    }
    
  }
  function allTitles(){
    var obj=sendRequest("../lab1/controller.php?cmd=4");
    if(obj.result==1){
      var win=obj.tit;
      var html="<option>Search Wine By Category</option>";
      for (var i = 0; i < win.length; i++) {
        html+='<option value='+win[i]['wine_type']+'>'+win[i]['wine_type']+'</option>';
      }
      document.getElementById("selector").innerHTML=html;
      return;
    }
  }
  function searchTitle(){
    var name=document.getElementById("selector").value;
    if(name==""){
      alert("Sorry, Select Category of wine searching");
      return;
    }
    else{
      var obj=sendRequest("../lab1/controller.php?cmd=3&category="+name);
      if(obj.result==1){
        var win=obj.wine;
        var html="";
        for (var i = 0; i < win.length; i++) {
          if(i%2==0){
          html+='<tr style="background-color:khaki"><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
          }
          else{
            html+='<tr><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
          }
        }
        document.getElementById("MyResult").innerHTML=html;
        return;
      }
    }
  }
  function sortA(){
    var obj=sendRequest("../lab1/controller.php?cmd=5");
    if(obj.result==1){
      var win=obj.wine;
      var html="";
      for (var i = 0; i < win.length; i++) {
        if(i%2==0){
          html+='<tr style="background-color:khaki"><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
        else{
          html+='<tr><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
      }
      document.getElementById("MyResult").innerHTML=html;
      return;
    }
  }
  function sortB(){
    var obj=sendRequest("../lab1/controller.php?cmd=6");
    if(obj.result==1){
      var win=obj.wine;
      var html="";
      for (var i = 0; i < win.length; i++) {
        if(i%2==0){
          html+='<tr style="background-color:khaki"><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
        else{
          html+='<tr><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
      }
      document.getElementById("MyResult").innerHTML=html;
      return;
    }
  }
  function sortC(){
    var obj=sendRequest("../lab1/controller.php?cmd=7");
    if(obj.result==1){
      var win=obj.wine;
      var html="";
      for (var i = 0; i < win.length; i++) {
        if(i%2==0){
          html+='<tr style="background-color:khaki"><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
        else{
          html+='<tr><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
      }
      document.getElementById("MyResult").innerHTML=html;
      return;
    }
  }
  function sortD(){
    var obj=sendRequest("../lab1/controller.php?cmd=8");
    if(obj.result==1){
      var win=obj.wine;
      var html="";
      for (var i = 0; i < win.length; i++) {
        if(i%2==0){
          html+='<tr style="background-color:khaki"><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
        else{
          html+='<tr><td><a href=oneDetail.html?id='+win[i]['wine_id']+'>'+win[i]['wine_name']+'</a></td><td>'+win[i]['wine_type']+'</td><td>'+win[i]['cost']+'</td><td>'+win[i]['year']+'</td></tr>';
        }
      }
      document.getElementById("MyResult").innerHTML=html;
      return;
    }
  }

  function swap(){
    var key=$('#so').val();
    if(key==1){
      sortA();
    }
    else if(key==2){
      sortB();
    }
    else if(key==3){
      sortC();
    }
    else if(key==4){
      sortD();
    }
  }
  function disP(id){
  var obj=sendRequest("../lab1/controller.php?cmd=9&id="+id);
  if(obj.result==1){
    window.location.href="oneDetail.html";
    return;
  }
  else{
    document.getElementById('diserror').innerHTML=obj.message;
    return;
  }
}
  function displayDetails(){
    var id=getURLParameter('id');
     var obj=sendRequest("../lab1/controller.php?cmd=9&id="+id);
    if(obj.result==1){
      var win=obj.wine;
      var html="";
      var image="";
      for (var i = 0; i < win.length; i++) {
        var folder = "../images/";
        image1=win[i]['image'];

        $.ajax({
          url : folder,
          success: function (image) {
           
              $(image).find("a").attr("href", function (id, image) {
                 if(image==image1){
                  if( image.match(/\.jpg|\.png|\.gif/) ) { 
                      $("#imageID").append( "<img src='"+ folder + image1 +"' height=120px>" );
                  }
                  else{
                    $("#imageID").append( "Sorry, Image Removed" );
                  } 
                }
              });
            
              
          }
          
        });
        
        html+='Wine Name: <b>'+win[i]['wine_name']+'</b><br>Wine Category: <b>'+win[i]['wine_type']+'</b><br>Wine Price: <b>'+win[i]['cost']+'</b><br>Year: <b>'+win[i]['year']+'</b><br>Winery: <b>'+win[i]['winery_name']+'</b><br>Quantity in Stock: <b>'+win[i]['on_hand']+'</b><br>Region: <b>'+win[i]['region_name']+'</b>';
      }
      document.getElementById("infoID").innerHTML=html;
      // document.getElementById("imageID").innerHTML=image;
      return;
    }
  }
  function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search.twig.twig)||[,""])[1].replace(/\\+/g, '%20'))||null
}
function login(){
  var username=$('#uslo').val();
  var password=$('#pwd').val();
  if(username==""){
    alert("Enter your Username");
    return;
  }
  else if(password==""){
    alert("Enter your Password");
    return;
  }
  else{
    var obj=sendRequest("../lab1/controller.php?cmd=10&username="+username+"&password="+password);
    if(obj.result==1){
      alert(obj.message);
      window.location.href="viewWines.html";
      return;
    }
    else if(obj.result==2){
      alert(obj.message);
      window.location.href="updateUser.html";
      return;
    }
    else{
      alert(obj.message);
      document.getElementById("dereport").innerHTML=obj.message;
      return;
    }
  }
}
function imageUp(){
  var image=$('#imag').val();
  var obj=sendRequest("../lab1/controller.php?cmd=12&imag="+image);
  if(obj.result==1){
    alert(obj.message);
    return;
  }
  else{
    alert(obj.message);
    return;
  }
}
function addWine(){
  var name=$('#wn').val();
  var type=$('#wt').val();
  var year=$('#wy').val();
  var winery=$('#wry').val();
  var desc=$('#wd').val();
  var image=$('#imag').val();
  if(name==""){
    alert("Enter Wine Name");
    return;
  }
  else if(type==""){
    alert("Enter Wine Category Code");
    return;
  }
  else if(year==""){
    alert("Enter Production Year");
    return;
  }
  else if(winery==""){
    alert("Enter Winery Number");
    return;
  }
  else{
    var obj=sendRequest("../lab1/controller.php?cmd=11&name="+name+"&type="+type+"&year="+year+"&winery="+winery+"&desc="+desc+"&image="+image);
    if(obj.result==1){
      imageUp();
      alert(obj.message);
      return;
    }
    else{
      alert(obj.message);
      return;
    }
  }
}*/