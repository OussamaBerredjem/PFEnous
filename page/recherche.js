var container = document.getElementById("container");
var searchInput = document.getElementById("search");
var selectFilter = document.getElementById("select");
var button = document.getElementById("button-search");
var employee = document.getElementById("employee");

var text = "";
var filtre = "nom";
var responseData;



// Check if the Page Visibility API is supported by the browser
if (typeof document.hidden !== "undefined") {
  // Add event listeners for visibility change
  document.addEventListener("visibilitychange", handleVisibilityChange);
}

// Function to handle visibility change
function handleVisibilityChange() {
  if (document.hidden) {
      window.location.reload()
  } else {
    window.location.reload()

  }
}



// Écouter les événements de changement sur le champ de recherche et le bouton de recherche
searchInput.addEventListener("input", function(event) {
    // Your event handling code goes here
    localStorage.setItem('search',searchInput.value)
    localStorage.setItem('filtre',selectFilter.value)

    text = searchInput.value;
    filtre = selectFilter.value;
    filtrer(filtre,text);
});



selectFilter.onchange = function (event) {
    text = searchInput.value;
    filtre = selectFilter.value;
    filtrer(filtre,text);
}

// Écouter l'événement de clic sur le bouton de recherche

var request = new XMLHttpRequest();
      request.open("GET", "http://localhost/PFEnous/php/requests.php?employee=all", true);
      request.onreadystatechange = function () {
          if (request.readyState == 4) {
              if (request.status == 200) {
                   try {
                        responseData = JSON.parse(request.responseText);

                        if(responseData){
                      
                        responseData.forEach(function (student) {

                          var clone = employee.cloneNode(true);
                          var cerd = clone.querySelector('#cerd');
                          var nm = clone.querySelector("#nom")
                          nm.textContent = student['nom'];
                         var pr = clone.querySelector("#prenom")
                         pr.textContent = student['prenom'];
                         var mt = clone.querySelector("#matricule")
                         mt.textContent = student['matricule'];

                          clone.querySelector("#go").onclick = function (event){
                            window.open("../profile.html?id="+student['emp_id'], "_blank");
                          }


                          
                          clone.style.display = '';
                          var archive = student['archive'];

                          cerd.style.backgroundColor = archive==0?"white":"#3C3C3C"
                          nm.style.color=archive==0?"black":"white"
                          pr.style.color=archive==0?"black":"white"
                          mt.style.color=archive==0?"black":"white"
                          container.appendChild(clone);
                        });
                        var s = localStorage.getItem('search')
                        var f = localStorage.getItem('filtre')

                        if(s && f){
                       searchInput.value = s
                        selectFilter.value = f
                        filtrer(f,s);
                        console.log("reback data")
                        }
                      }

                } catch (error) {
                  alert("Error parsing JSON: "+ error);
                }
            } else {
                  alert('Error: ' + request.status);
  }
}
}
request.send();
//function change
function filtrer(type,search) {

    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
    
    if(responseData){
    responseData.forEach(function (student) {

        if(type==1&&student['nom'].toLowerCase().startsWith(search.toLowerCase())){
            addChild(student,1,search)
            
          }else if(type==2&&student['prenom'].toLowerCase().startsWith(search.toLowerCase())){
            addChild(student,2,search)
            
          }else if(type==3&&student['matricule'].toLowerCase().startsWith(search.toLowerCase())){
            addChild(student,3,search)
           
          }else if(search==""){
            addChild(student,4,"")
          }  
         
          
       
       
     
      });}

     
       
}

function addChild(stud,type,text) {
   
        var clone = employee.cloneNode(true);

        clone.querySelector("#go").onclick = function (event){
          //window.open("../profile.html?id="+stud['emp_id'], "_blank");
          window.open("../profile.html?id="+stud['emp_id'], "_blank")
        }

        var cerd = clone.querySelector('#cerd');

        var archive = stud['archive'];

        var nm = clone.querySelector("#nom")
        var pr = clone.querySelector("#prenom")
        var mt = clone.querySelector("#matricule")

        var c = archive==0?"black":"white";
        cerd.style.backgroundColor = archive==0?"white":"#3C3C3C"
        nm.style.color=c
        pr.style.color=c
        mt.style.color=c

        if(type==1){

            var c = stud['nom'].slice(0,text.length);
            var d = stud['nom'].slice(text.length);
            clone.querySelector("#nom").innerHTML = "<span style='color: green;'>" + c + "</span>" +
                                                    
                                                    "<span style='color: "+c+";'>" + d + "</span>";
            
          }else{
            clone.querySelector("#nom").textContent = stud['nom'];
          }
          
          if(type==2){
  
            var c = stud['prenom'].slice(0,text.length);
            var d = stud['prenom'].slice(text.length);
            clone.querySelector("#prenom").innerHTML = "<span style='color: green;'>" + c + "</span>" +
                                                        "<span style='color: "+c+";'>" + d + "</span>";
  
          }else{
            clone.querySelector("#prenom").textContent = stud['prenom'];}
            if(type==3){
  
            var c = stud['matricule'].slice(0,text.length);
            var d = stud['matricule'].slice(text.length);
            clone.querySelector("#matricule").innerHTML = "<span style='color: green;'>" + c + "</span>" +
                                                          "<span style='color: "+c+";'>" + d + "</span>";

  
            }else{
              clone.querySelector("#matricule").textContent = stud['matricule'];
           }

           
           clone.style.display = '';
           container.appendChild(clone);
}


