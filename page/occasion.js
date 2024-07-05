const queryParams = new URLSearchParams(window.location.search);

var tableBody = document.getElementById('tbody');

var request = new XMLHttpRequest();

var dates = document.getElementById("dates");

const dateParam = queryParams.get('date');
var imp = document.getElementById('imp')

imp.onclick = function(){
    imp.style.display = "none"
    window.print()
    imp.style.display = ""

}

const IRG = {
    "bronze":7777.78, // bronze
    "argent":8888.89, // argent
    "or":11111.11, // or
    "vermeil":13333.83,
    "platine":16666.67,// platine
    "couronne":20000

}

const BRUT = {
    "bronze":77777.78, // bronze
    "argent":88888.89, // argent
    "or":111111.11, // or
    "vermeil":133333.83,
    "platine":166666.67, // platine
    "couronne":200000
}

const PAYER = {
    "bronze":70000, // bronze
    "argent":80000, // argent
    "or":100000, // or
    "vermeil":120000,
    "platine":150000,// platine
    "couronne":180000

}

if (dateParam) {
    
const currentDate = new Date();
const currentYear = currentDate.getFullYear();
dates.textContent = currentYear+""+dateParam;

request.open('GET','http://localhost/PFEnous/php/requests.php?occasion='+dateParam,true);

var totirg = []
var indirg = 0
var totbrut = []
var indbrut = 0
var totpayer = []
var indpayer = 0

request.onreadystatechange = function(){
    if(this.status == 200 &&this.readyState == 4){
        var response = JSON.parse(this.responseText);

        if(response){
            var ind = 0;
            var ln = response.length;
            var oelemnt = response[0]['type'];


            


            response.forEach(element => {
             

                

                if (oelemnt!=element['type'] ) {

                    console.log("index = "+ind);
                    console.log("length = "+ln);

                    



                    var totp = ind * PAYER[oelemnt]
                    var toti = ind * IRG[oelemnt]
                    var totm = ind * BRUT[oelemnt]
                   
                    totbrut[indbrut++] = totm;
                    totirg[indirg++] = toti
                    totpayer[indpayer++] = totp

                    ind = 0;


                    var trown = document.createElement('tr');
                    var tdElement = document.createElement('td');

                    tdElement.textContent = "Total des Medailles "+oelemnt
                   

                    trown.innerHTML = `
                        <th colspan="5">Total des Medailles `+oelemnt+`</th>
                        <th>`+totm+`</th>
                        <th>`+toti+`</th>
                        <th>`+totp+`</th>
                        <th></th>
                        <th></th>
                        <th></th>

                        `;


                    tableBody.appendChild(trown);

                    
                }


                var trow = document.createElement('tr');

                var cdirection = document.createElement('td');
                var ndirection = document.createElement('td');
                var tbrut = document.createElement('td');
                var tnet = document.createElement('td');
                var tirg = document.createElement('td');
            


                var tnom = document.createElement('td');
                var tprenom = document.createElement('td');
                var tmatricule = document.createElement('td');
                var tcode_structure = document.createElement('td');
                
                var tdate_recrutement = document.createElement('td');
                var tnumero_compte = document.createElement('td');
                var tmedailles = document.createElement('td');
                var tfonction = document.createElement('td');
                var tstatus = document.createElement('td');

                ndirection.textContent = element['direction']
                cdirection.textContent = "N/A"
                tbrut.textContent = ""+BRUT[element['type']]
                tirg.textContent = IRG[element['type']]
                tnet.textContent = PAYER[element['type']]

                tnom.textContent = element['nom'];
                tprenom.textContent =  element['prenom'];
                tmatricule.textContent =  element['matricule'];
                tcode_structure.textContent =  element['code_structure'];
                //tdate_naissance.textContent =  element['date_naissance'];
                tdate_recrutement.textContent =  element['date_recrutement'];
                tnumero_compte.textContent =  element['numero_compte'];
                tmedailles.textContent =  element['type'];
                tfonction.textContent = element['fonction'];
                var currentDate = new Date();
                var dateToCompare = new Date(element['date_prevu']);

                if (dateToCompare < currentDate) {
                    tstatus.textContent = "Remized"
                } else {
                    tstatus.textContent = "Attente"

                }
            

                trow.appendChild(cdirection)
                trow.appendChild(ndirection)
                trow.appendChild(tmatricule)
                trow.appendChild(tnom);
                trow.appendChild(tprenom);
                trow.appendChild(tbrut);
                trow.appendChild(tirg);
                trow.appendChild(tnet);
             /*

                trow.appendChild(tdate_naissance);
                trow.appendChild(tdate_recrutement);*/
                trow.appendChild(tmedailles);
                trow.appendChild(tdate_recrutement);

                trow.appendChild(tnumero_compte);

                tableBody.appendChild(trow);

                console.log("\n type : "+oelemnt);
                    

                oelemnt = element['type']
                
                ind++;


             
            });

            if(oelemnt){

                    console.log("index = "+ind);
                    console.log("length = "+ln);



                    var totp = ind * PAYER[oelemnt]
                    var toti = ind * IRG[oelemnt]
                    var totm = ind * BRUT[oelemnt]
                   

                    totbrut[indbrut++] = totm;
                    totirg[indirg++] = toti;
                    totpayer[indpayer++] = totp;


                    var trown = document.createElement('tr');
                    var tdElement = document.createElement('td');

                    tdElement.textContent = "Total des Medailles "+ oelemnt
                   

                    trown.innerHTML = `
                        <th colspan="5">Total des Medailles `+ oelemnt+`</th>
                        <th>`+totm+`</th>
                        <th>`+toti+`</th>
                        <th>`+totp+`</th>
                        <th></th>
                        <th></th>
                        <th></th>

                        `;

                    var totalirg = 0;
                    var totalbrut = 0;
                    var totalpayer = 0;

                    totbrut.forEach((element)=>{
                        totalbrut +=element; 
                    })
                    totirg.forEach((element)=>{
                        totalirg +=element; 
                    })

                    totpayer.forEach((element)=>{
                        totalpayer +=element; 
                    })

                    tableBody.appendChild(trown);


                    var trown = document.createElement('tr');
                    var tdElement = document.createElement('td');


                    tdElement.textContent = "Total des Medailles "
                   

                    var pind = totalbrut.toString().indexOf(".")
                    totalbrut += 0.001;
                    trown.innerHTML = `
                        <th colspan="5">Total des Medailles</th>
                        <th>`+totalbrut.toString().slice(0,pind+3)+`</th>
                        <th>`+totalirg+`</th>
                        <th>`+totalpayer+`</th>
                        <th></th>
                        <th></th>
                        <th></th>

                        `;

                
                    tableBody.appendChild(trown);

            }
        }
    }
}

request.send();
   
} else {
    console.log("Date parameter not found in the URL");
}






