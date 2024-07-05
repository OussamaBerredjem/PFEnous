var modifier = document.getElementById("modifier");
var supprimer = document.getElementById("supprimer");
var annuller_modifier = document.getElementById("annuller_modifier");
var anuller_supprimer = document.getElementById("annuller_supprimer");
const btnback = document.getElementById('back') 
var info_fonction =  document.getElementById("info_fonction");
var fonct = document.getElementById("fonction");
var contu = document.getElementById("contu");
var conta = document.getElementById("conta");

const info_fullname = document.getElementById("info_fullname");
const info_prenom = document.getElementById("info_prenom");

var archive = 0

const info_email = document.getElementById("info_email");
const info_direction = document.getElementById("info_direction");
const info_matricule = document.getElementById("info_matricule");
const info_code_structure = document.getElementById("info_code_structure");
const info_date_naissance = document.getElementById("info_date_naissance");
const info_date_recrutement = document.getElementById("info_date_recrutement");
const info_num_compte = document.getElementById("info_num_compte");

const tab_conges = document.getElementById("tab_conges");
const tab_medailles = document.getElementById("tab_medailles");

const matricule = document.getElementById("matricule");
const num_compte = document.getElementById("numero_compte");
const code_structure = document.getElementById("code_structure");
const date_naissance = document.getElementById("date_naissance");
const date_recrutement = document.getElementById("date_recrutement");
const nom = document.getElementById("nom");
const prenom = document.getElementById("prenom");
const email = document.getElementById("email");
const direction = document.getElementById("direction");


const set_modifier = document.getElementById("set_modifier");
const set_supprime = document.getElementById("set_supprime");

const dialog = document.getElementById('dialog');
const dialog2 = document.getElementById('dialog2');
const alrt = document.getElementById("alrt")
const arc = document.getElementById("arc");


btnback.onclick = function click(params) {
  window.close();
}



var request;
var sh = false;
var ch = false;



function toggleDialog() {
    sh = !sh;
    contu.style.marginBottom = sh?"0%":"-100%" 
    dialog.classList.toggle('show');
}

function toggleDialog2() {
    ch = !ch;
    conta.style.marginBottom = ch?"0%":"-100%" 
  dialog2.classList.toggle('show');
}



modifier.onclick = toggleDialog;

supprimer.onclick = toggleDialog2;

annuller_modifier.onclick = toggleDialog;


anuller_supprimer.onclick = toggleDialog2;

set_supprime.onclick = function (event) {
  request = new XMLHttpRequest(); // Create the XMLHttpRequest object
  archive==0?request.open('GET', 'http://localhost/PFEnous/php/requests.php?archive='+id, true):request.open('GET', 'http://localhost/PFEnous/php/requests.php?disarchive='+id, true); 
  

  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      archive = archive==0?1:0;
      supprimer.textContent = archive==0?"Archiver":"Disarchiver"
      arc.textContent = archive==0?"Archiver":"Disarchiver"
      set_supprime.textContent = archive==0?"Archiver":"Disarchiver"
      alrt.textContent = archive==0?"vous ete sure de archiver ?":"vous ete sure de disarchiver ?"

      toggleDialog2()
    }
}
  request.send();
};

set_modifier.onclick = function (event){
  event.preventDefault(); // Prevent the default form submission
  
  var request = new XMLHttpRequest(); // Create the XMLHttpRequest object
  request.open('POST', 'http://localhost/PFEnous/php/requests.php', true); // Initialize the request

  var data = new FormData();
  data.append("nom", nom.value);
  data.append("prenom", prenom.value);
  data.append("code_structure", code_structure.value);
  data.append("numero_compte", numero_compte.value); // corrected variable name
  data.append("date_naissance", date_naissance.value);
  data.append("date_recrutement", date_recrutement.value);
  data.append("matricule", matricule.value);
  data.append("fonction", fonction.value); // corrected variable name
  data.append("email", email.value);
  data.append("direction", direction.value);

  data.append("emp_id", id);
  data.append("edit", email.value);

  request.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
              toggleDialog();
              setTimeout(()=>{
                window.location.reload();
              },500)
          
      }
  }

  request.send(data); // Send the request
}


const urlParams = new URLSearchParams(window.location.search);

// Get the value of the 'id' parameter
const id = urlParams.get('id');


// Check if the matricule exists
if (id) {
  console.log("id : ", id);

  var requests = new XMLHttpRequest(); 
  requests.open('GET', 'http://localhost/PFEnous/php/requests.php?emp_id=' + id + '&profile=a', true); 
  requests.onreadystatechange = function (){
      if(this.readyState == 4 && this.status == 200) {
          var res = JSON.parse(this.responseText);
          if (res) {
          archive = res['profile']['archive'];

          supprimer.textContent = archive==0?"Archiver":"Disarchiver"
          set_supprime.textContent = archive==0?"Archiver":"Disarchiver"
          alrt.textContent = archive==0?"vous ete sure de archiver ?":"vous ete sure de disarchiver ?"
          arc.textContent = archive==0?"Archiver":"Disarchiver"

          nom.value = res['profile']['nom'];
          prenom.value = res['profile']['prenom'];
          email.value = res['profile']['email'];
          direction.value = res['profile']['direction'];
          matricule.value = res['profile']['matricule'];
          code_structure.value = res['profile']['code_structure'];
          num_compte.value = res['profile']['numero_compte'];
          date_naissance.value = res['profile']['date_naissance'];
          date_recrutement.value = res['profile']['date_recrutement'];
          fonct.value = res['profile']['fonction'];

          info_fullname.textContent = nom.value;
          info_prenom.textContent = prenom.value;
          info_code_structure.textContent = code_structure.value;
          info_date_naissance.textContent = date_naissance.value;
          info_matricule.textContent = matricule.value;
          info_date_recrutement.textContent = date_recrutement.value;
          info_num_compte.textContent = num_compte.value;
          info_fonction.textContent = fonct.value;
          info_email.textContent = res['profile']['email'];
          info_direction.textContent = res['profile']['direction'];


          if(res['conges']){
            var keys = Object.keys(res['conges']);

             // Get the length of the array (size of the object)
            var size = keys.length;
            var l = 0;
            res["conges"].forEach(element => {
              ++l;
              var tr_conges = document.createElement("tr");
              var t = document.createElement("td");
              var d = document.createElement("td");
              var f = document.createElement("td");
              var r = document.createElement("td");
              var v =  document.createElement("td");

              t.classList.add("bord-right");
              d.classList.add("bord-right");
              f.classList.add("bord-right");
              v.classList.add("bord-right");
              if(l<size){
              t.classList.add("bord-bottom");
              d.classList.add("bord-bottom");
              f.classList.add("bord-bottom");
              v.classList.add("bord-bottom");
              r.classList.add("bord-bottom");
            }
  
              t.textContent = element['types'];
              tr_conges.appendChild(t);
              d.textContent = element['date_debut'];
              tr_conges.appendChild(d);
              f.textContent = element['date_fin'];
              tr_conges.appendChild(f);
              r.textContent = transformDurationAsString(element['duration']);
              v.textContent = element['validable'] == 0? "non":"oui";
              tr_conges.appendChild(v);
              tr_conges.appendChild(r);


              tab_conges.appendChild(tr_conges);
  
            });
          }
          var i = 0;
          res["medailles"].forEach(element => {
            ++i;
            var tr_medailles = document.createElement("tr");
            var type = document.createElement("td");
            var r = document.createElement("td");
            var p = document.createElement("td");
            var s = document.createElement("td");

            
              type.classList.add("bord-right");
              r.classList.add("bord-right");
              p.classList.add("bord-right");
              if(i<=5){
              type.classList.add("bord-bottom");
              r.classList.add("bord-bottom");
              p.classList.add("bord-bottom");

              s.classList.add("bord-bottom");
            }

            type.textContent = element['type'];
            tr_medailles.appendChild(type);
            r.textContent = element['date_remise'];
            tr_medailles.appendChild(r);
            p.textContent = element['date_prevu'];
            tr_medailles.appendChild(p);

            var date = new Date(element['date_prevu']);
            var today = new Date();

            if(date <= today){
              s.textContent = "Remized";

            }else{
              s.textContent = "Attente";
            }

            tr_medailles.appendChild(s);

            tab_medailles.appendChild(tr_medailles);

          });

         
        }
         

      }
  }

  requests.send(); // Send the request
}
else {
  console.log("id not found in the URL query string.");
}

function transformDurationAsString(days) {
  const years = Math.floor(days / 365);
  const months = Math.floor((days % 365) / 30);
  const remainingDays = ((days % 365) % 30) ;

  let result = '';

  if (years > 0) {
      result += years + ' anné' + (years > 1 ? 's' : '') + ' ';
  }
  if (months > 0) {
      result += months + ' mois' + (months > 1 ? '' : '') + ' ';
  }
 
  if (remainingDays > 0) {
      result += remainingDays + ' jour' + (remainingDays > 1 ? 's' : '');
  }

  return result.trim(); // Remove trailing space if any
}