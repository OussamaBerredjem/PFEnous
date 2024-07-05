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





var request = new XMLHttpRequest();
request.open("GET", "http://localhost/PFEnous/php/requests.php?medailles&&to", true);
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
            var un = document.createElement("u")
            
            var gr = document.createElement("a");
            var empid = element['emp_id'];

            gr.textContent = "voir";

            gr.style.cursor = "pointer"
            
            
            gr.onclick = function () {
                var requestgr = new XMLHttpRequest();
                requestgr.open("GET", "http://localhost/PFEnous/php/requests.php?id="+empid+"&pdf", true);
                requestgr.send();
                requestgr.onreadystatechange = function () {
                    if(this.status ==200 && this.readyState == 4){
                        window.open("../output/output.pdf", "_blank");
                    }
                }

            }
           
            n.textContent = element['nom'];
            p.textContent = element['prenom'];
            m.textContent = element['matricule'];
            d.textContent = element['direction'];
            f.textContent = element['type'];
            r.textContent = element['date_prevu'];
            un.appendChild(gr)
            t.appendChild(un);


           

            
            newRow.appendChild(n);
            newRow.appendChild(p);
            newRow.appendChild(m);
            newRow.appendChild(d);

           

            newRow.appendChild(f);
            newRow.appendChild(r);
            newRow.appendChild(t);

            tab.appendChild(newRow);


            
        });}
    }
};












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
                <th id="nj">
                    Nom
                </th>
                <th>
                    Prenom
                </th>
                <th>
                    Matricule
                </th>
                <th>
                    Direction
                </th>
                <th>
                    Medaille
                </th>
                <th>
                    Date Remise
                </th>
                
                <th id="rj">
                    Gratification
                </th>`;

    tab.appendChild(newRow)

    
    if(result.length >0){
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
    }else{
        
    }

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
           
            var un = document.createElement("u")
            
            var gr = document.createElement("a");
            var empid = element['emp_id'];

            gr.textContent = "voir";

            gr.style.cursor = "pointer"
            
            
            gr.onclick = function () {
                var requestgr = new XMLHttpRequest();
                requestgr.open("GET", "http://localhost/PFEnous/php/requests.php?id="+empid+"&pdf", true);
                requestgr.send();
                requestgr.onreadystatechange = function () {
                    if(this.status ==200 && this.readyState == 4){
                        window.open("../output/output.pdf", "_blank");
                    }
                }

            }
           
            n.textContent = element['nom'];
            p.textContent = element['prenom'];
            m.textContent = element['matricule'];
            d.textContent = element['direction'];
            f.textContent = element['type'];
            r.textContent = element['date_prevu'];
            un.appendChild(gr)
            t.appendChild(un);


           

            
            newRow.appendChild(n);
            newRow.appendChild(p);
            newRow.appendChild(m);
            newRow.appendChild(d);
            newRow.appendChild(f);
            newRow.appendChild(r);
            newRow.appendChild(t);

            tab.appendChild(newRow);
}

