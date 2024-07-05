var dialog = document.getElementById("dialog")
var sendmail = document.getElementById('shot')
var contu = document.getElementById("dc")
var ajo = document.getElementById("ajouter")
var ed = document.getElementById("em")

sendmail.onclick = function () {

    var en = "email a ete envoye a tout les employees qui remise medailles a "+getNearDate();
    ed.textContent = en;

    

    emailrequest.send();

  
    dialog.classList.toggle('show');
    dialog.style.opacity = "1"
    contu.style.top = "10%"
       
    


}

var emailrequest = new XMLHttpRequest();
emailrequest.open("GET","http://localhost/PFEnous/php/sendmail.php",true);

ajo.onclick = function(){

    contu.style.position = "fixed"
    contu.style.top = '100%'
    dialog.classList.toggle('show');
    dialog.style.opacity = "0"
}

function getNearDate() {
    const today = new Date();
    const month = today.getMonth() + 1; // Months are zero-indexed (January is 0)
    const day = today.getDate();
    const year = today.getFullYear();
  
    if (month < 2 || (day <= 24 && month === 2)) {
      return `${year}/02/24`;
    } else if (month > 2 && month < 5 || (day <= 1 && month === 5)) {
      return `${year}/05/01`;
    } else if (month > 5 && month < 7 || (day <= 5 && month === 7)) {
      return `${year}/07/05`;
    } else if (month > 7 && month < 11 || (day <= 1 && month === 11)) {
      return `${year}/11/01`;
    } else {
      return `${year}/12/31`;
    }
  }
  


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
            
            t.textContent = element['email']


           

            
            newRow.appendChild(n);
            newRow.appendChild(p);
            newRow.appendChild(m);
            newRow.appendChild(t);
            newRow.appendChild(d);

           

            newRow.appendChild(f);
            newRow.appendChild(r);

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
                    Email
                </th>
                <th>
                    Direction
                </th>
                <th>
                    Medaille
                </th>
                
                <th id="rj">
                    Date Remise
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
           
            
            
            
            n.textContent = element['nom'];
            p.textContent = element['prenom'];
            m.textContent = element['matricule'];
            d.textContent = element['direction'];
            f.textContent = element['type'];
            r.textContent = element['date_prevu'];
            t.textContent = element['email']


           

            
            newRow.appendChild(n);
            newRow.appendChild(p);
            newRow.appendChild(m);
            newRow.appendChild(t);
            newRow.appendChild(d);
            newRow.appendChild(f);
            newRow.appendChild(r);

            tab.appendChild(newRow);
}

