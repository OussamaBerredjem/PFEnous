var items = document.getElementsByClassName("item");
var info = document.getElementById("info");
var list = document.getElementById("list");
var tableBody = document.getElementById('tbody');
var tg = document.getElementById("tg");

    var request = new XMLHttpRequest();
    

    function openRequest(index){

        

        switch (index) {
            case 0:
                request.open("GET","http://localhost/PFEnous/php/requests.php?medaille=bronze",true);
                console.log("bronze")
                break;
            case 1:
                request.open("GET","http://localhost/PFEnous/php/requests.php?medaille=argent",true);
                break;
            case 2:
                request.open("GET","http://localhost/PFEnous/php/requests.php?medaille=or",true);
                break;
            case 3:
                request.open("GET","http://localhost/PFEnous/php/requests.php?medaille=platine",true);
                break;
            case 4:
                request.open("GET","http://localhost/PFEnous/php/requests.php?medaille=vermeil",true);
                break
            case 5:
                request.open("GET","http://localhost/PFEnous/php/requests.php?medaille=couronne",true);
                break;
           
        }

        request.onreadystatechange = function(){
            if(this.status == 200 && this.readyState == 4){
                console.log("here add data")

                var response = JSON.parse(this.responseText);
                viderTable();
                addResponse(response);
            }
        }

        request.send();

       
    }

    // Convert HTMLCollection to array
    var itemsArray = Array.from(items);

    var arr = [
        "Médaille de bronze",
        "Médaille d'argent",
        "Médaille d'or",
        "Médaille de platine",
        "Médaille de vermeil",
        "Médaille de couronne"
    ];

    // Iterate over each item using forEach
    for (let index = 0; index < itemsArray.length; index++) {
        const element = itemsArray[index];
        element.onclick = function (event) {
            openRequest(index);
           
            list.style.marginLeft = "-100%";
            info.style.marginRight ="0%";
            info.style.display = ""
            tg.textContent = arr[index];
         }
    }
   
    info.onclick = function (params) {
        list.style.marginLeft = "0%";
        info.style.marginRight ="-100%";
        info.style.display = ""
    }


    function viderTable(){
        while (tableBody.firstChild) {
            tableBody.removeChild(tableBody.firstChild);
        }

        var trow = document.createElement('tr');
        var tnom = document.createElement('td');
        var tprenom = document.createElement('td');
        var tmatricule = document.createElement('td');
        //var tmedailles = document.createElement('td');
        var tstatus = document.createElement('td');

        tnom.textContent = "Nom";
        tprenom.textContent =  "Prénom";
        tmatricule.textContent =  "Matricule";
        tstatus.textContent = "Status";

        trow.appendChild(tnom);
        trow.appendChild(tprenom);
        trow.appendChild(tmatricule);
     //trow.appendChild(tmedailles);
        trow.appendChild(tstatus);

       // tableBody.appendChild(trow);



    }

    function addResponse(response){

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
            var tmedailles = document.createElement('td');
            var tfonction = document.createElement('td');
            var tstatus = document.createElement('td');


            tnom.textContent = element['nom'];
            tprenom.textContent =  element['prenom'];
            tmatricule.textContent =  element['matricule'];
            tcode_structure.textContent =  element['code_structure'];
            tdate_naissance.textContent =  element['date_naissance'];
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
        

            trow.appendChild(tnom);
            trow.appendChild(tprenom);
            trow.appendChild(tmatricule);
            /*trow.appendChild(tcode_structure);
            trow.appendChild(tnumero_compte);
            trow.appendChild(tfonction);

            trow.appendChild(tdate_naissance);
            trow.appendChild(tdate_recrutement);*/
            //trow.appendChild(tmedailles);
            trow.appendChild(tstatus);


            tableBody.appendChild(trow);


        });
    }
}
    