const select  = document.getElementById("selectOption");
var customInput = document.getElementById("customInput");
var customText = document.getElementById("customText");
const matricule = document.getElementById("matricule");

const columna = document.getElementById("collss");
const tab = document.getElementById("tab");
const contu = document.getElementById("dc")
const sho = document.getElementById("sho");

const date_debut = document.getElementById("date_naissance");
const date_fin = document.getElementById("date_recrutement");

const congesOUI = document.getElementById("congesoui");
const congesNON = document.getElementById("congesnon");


const ajouter = document.getElementById("ajouter");
const autrez = document.getElementById("dyt");
const anuller = document.getElementById("anuller");

var request = new XMLHttpRequest();
request.open("GET", "http://localhost/PFEnous/php/requests.php?conges&&all", true);
request.send();

var result = [];

request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        result = JSON.parse(this.responseText); // Parse the response as JSON
        if(result){
        result.forEach(element => {
            var newRow = document.createElement("tr");
            newRow.className = "table-primary text-center"; // Add a class to the new row

            var n = document.createElement("td")
            var p = document.createElement("td")
            var m = document.createElement("td")
            var d = document.createElement("td")
            var f = document.createElement("td")
            var r = document.createElement("td")
            var t = document.createElement("td")
            
            var du = document.createElement("td")

           
            n.textContent = element['nom'];
            p.textContent = element['prenom'];
            m.textContent = element['matricule'];
            d.textContent = element['date_debut'];
            f.textContent = element['date_fin'];
            r.textContent = transformDurationAsString(element['duration']);
            t.textContent = element['types'];
            du.textContent = transformDurationAsString(element['duree']);

           

            
            newRow.appendChild(n);
            newRow.appendChild(p);
            newRow.appendChild(m);
            newRow.appendChild(t);

            newRow.appendChild(d);
            newRow.appendChild(f);
            newRow.appendChild(du);
            newRow.appendChild(r);

            tab.appendChild(newRow);


            
        });}
    }
};



function transformDurationAsString(days) {
    const years = Math.floor(days / 365);
    const months = Math.floor((days % 365) / 30);
    const remainingDays = ((days % 365) % 30) ;

    let result = '';

    if (years > 0) {
        result += years + ' année' + (years > 1 ? 's' : '') + ' ';
    }
    if (months > 0) {
        result += months + ' mois' + (months > 1 ? '' : '') + ' ';
    }
   
    if (remainingDays > 0) {
        result += remainingDays + ' jour' + (remainingDays > 1 ? 's' : '');
    }

    return result.trim(); // Remove trailing space if any
}


sho.onclick = function(event){
    dialog.classList.toggle('show');
    dialog.style.opacity = "1"
    contu.style.top = "0%"
}

select.onchange = function (event){

    var selectedOption = select.value;


    if (selectedOption === "") {
        customInput.style.display = "block";
        customInput.style.opacity = "1";
        customText.value = "";
        contu.style.height = "97%"
        autrez.style.height = "3.8cm"
      } else {
        customInput.style.display = "none";
        customInput.style.opacity = "0";

        contu.style.height = "85%"
        autrez.style.height = "1.8cm"

      }
}

ajouter.onclick = function (event){
    if(matricule.value == ""){
        alert("enter le matricule")
    }
    else if(select.value == "1"){
        alert("choiser le type du conges")
    }else if(select.value == "" && customText.value == ""){
        alert("enter le type du conges")
    }else if(!congesNON.checked && !congesOUI.checked){
        alert("choiser validité du conges")

    }else if(date_debut.value == "" || date_fin.value == ""){
        alert("assurrer vous aver enter date debut et fin du conges")
    }else{
        var valide,type;

        type = select.value==""?customText.value:select.value;

         if(congesOUI.checked){
            valide = 1;
         }else{
           valide = 0;
         }
         request.open("POST",'http://localhost/PFEnous/php/requests.php',true);
         request.onreadystatechange = function(){
            if(this.status==200 && this.readyState == 4){
                alert(success);
            }
        }

        var form = new FormData();
        form.append("matricule",matricule.value);
        form.append("validable",valide);
        form.append("types",type);
        form.append("date_debut",date_debut.value);
        form.append("date_fin",date_fin.value);
        
        request.send(form);

        dialog.classList.toggle('show');
        window.location.reload()
  }
}

anuller.onclick = function (event){
    contu.style.position = "fixed"
    contu.style.top = '100%'
    dialog.classList.toggle('show');
    dialog.style.opacity = "0"

}


/* search */
var filtre_choose = document.getElementById("select");
var search = document.getElementById("search");


filtre_choose.onchange = function changed() {
    var txt = filtre_choose.value;
    var srch = search.value;
    filtre(txt,srch);
}
search.oninput = function(text){
    var txt = filtre_choose.value;
    var srch = search.value;
    filtre(txt,srch);
}
function filtre(type,search) {

    

    while (tab.firstChild) {
        tab.removeChild(tab.firstChild);
    }

    var newRow = document.createElement("tr");

    // Add class to the new row
    newRow.classList.add("tab-pane", "text-center", "text-white");

    newRow.style.backgroundColor = "orange"
    // Define the inner HTML content for the new row
    newRow.innerHTML = `
    <th id="nj">Nom</th>
    <th>Prenom</th>
    <th>Matricule</th>
    <th>Type</th>
    <th>Date debut</th>
    <th>Date fin</th>
    <th>Duration</th>
    <th id="rj">Reste</th>
    `;

    tab.appendChild(newRow)

    
    
    result.forEach(function (student) {
          if(type==1&&student['nom'].toLowerCase().startsWith(search.toLowerCase())){
            addChild(student,1,search)
            
          }else if(type==2&&student['prenom'].toLowerCase().startsWith(search.toLowerCase())){
            addChild(student,2,search)
            
          }else if(type==3&&student['matricule'].toLowerCase().startsWith(search.toLowerCase())){
            addChild(student,3,search)
           
          }else if(search==""){
            addChild(student,4,"")
          }  
         
          
        });

}

function addChild(element,type,text) {
    var newRow = document.createElement("tr");
            newRow.className = "table-primary text-center"; // Add a class to the new row

            var n = document.createElement("td")
            var p = document.createElement("td")
            var m = document.createElement("td")
            var d = document.createElement("td")
            var f = document.createElement("td")
            var r = document.createElement("td")
            var t = document.createElement("td")

            var du = document.createElement("td")

           
            n.textContent = element['nom'];
            p.textContent = element['prenom'];
            m.textContent = element['matricule'];
            d.textContent = element['date_debut'];
            f.textContent = element['date_fin'];
            r.textContent = transformDurationAsString(element['duration']);
            t.textContent = element['types'];
            du.textContent =transformDurationAsString( element['duree']);

            
            newRow.appendChild(n);
            newRow.appendChild(p);
            newRow.appendChild(m);
            newRow.appendChild(t);

            newRow.appendChild(d);
            newRow.appendChild(f);
            newRow.appendChild(du);

            newRow.appendChild(r);

            tab.appendChild(newRow);
}