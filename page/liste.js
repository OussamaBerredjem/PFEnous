var tableBody = document.getElementById('tbody');

var request = new XMLHttpRequest();

request.open('GET','http://localhost/PFEnous/php/requests.php?list=all',true);

request.onreadystatechange = function(){
    if(this.status == 200 &&this.readyState == 4){
        var response = JSON.parse(this.responseText);
        if(response){
            response.forEach(element => {

                var trow = document.createElement('tr');
                var tnom = document.createElement('td');
                var tprenom = document.createElement('td');
                var tmatricule = document.createElement('td');
                var tcode_structure = document.createElement('td');
                var tdate_naissance = document.createElement('td');
                var tdate_recrutement = document.createElement('td');
                var tnumero_compte = document.createElement('td');
                var tduration = document.createElement('td');
                var tmedailles = document.createElement('td');
                var tdate_remise = document.createElement('td');
                var tdate_prevu = document.createElement('td');
                var tfonction = document.createElement('td');
                var temail = document.createElement('td');
                var tdirection = document.createElement('td');

                tnom.textContent = element['nom'];
                tprenom.textContent =  element['prenom'];
                tmatricule.textContent =  element['matricule'];
                tcode_structure.textContent =  element['code_structure'];
                tdate_naissance.textContent =  element['date_naissance'];
                tdate_recrutement.textContent =  element['date_recrutement'];
                tnumero_compte.textContent =  element['numero_compte'];
                tduration.textContent =  element['duration']==0?'/':element['duration'];
                tmedailles.textContent =  element['type'];
                tdate_remise.textContent =  element['date_remise'];
                tdate_prevu.textContent = element['date_prevu'];
                tfonction.textContent = element['fonction']
                temail.textContent = element['email']
                tdirection.textContent = element['direction']

                trow.appendChild(tnom);
                trow.appendChild(tprenom);
                trow.appendChild(temail);
                trow.appendChild(tdirection);
                trow.appendChild(tmatricule);
                trow.appendChild(tcode_structure);
                trow.appendChild(tdate_naissance);
                trow.appendChild(tdate_recrutement);

                trow.appendChild(tnumero_compte);
                trow.appendChild(tfonction);
                trow.appendChild(tmedailles);
                trow.appendChild(tdate_remise);
                trow.appendChild(tdate_prevu);


                tableBody.appendChild(trow);


            });
        }
    }
}

request.send();

