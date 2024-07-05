var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

var recherche = document.getElementById('recherche');
var occasion = document.getElementById('occasion');
var employee = document.getElementById('list');
var nouveau = document.getElementById("nouveau");
var Medaille = document.getElementById("medaille");
var conges = document.getElementById("conges");
var gratification = document.getElementById("gratification");
var notification = document.getElementById("notification");
var title = document.getElementById("title");
var iframe = document.getElementById("iframe");
var sidebar = document.getElementById("sidebar-wrapper");
var logout = document.getElementById("logout")

document.querySelector("#menu-toggle").addEventListener("click", function() {
    document.getElementById("wrapper").classList.toggle("toggled");
  });

  var isLogin = localStorage.getItem("isLogin");

  if(isLogin=="true"){
  }else{
    localStorage.setItem("isLogin",false);
    window.location.href = "home.html"; 
  }



var occasion1 = document.getElementById("occassion1");
var occasion2 = document.getElementById("occassion2");
var occasion3 = document.getElementById("occassion3");
var occasion4 = document.getElementById("occassion4");
var occasion5 = document.getElementById("occassion5");
var lastactive = 3;
var active = 3;


var oindex = 1;

logout.onclick = function onclick(params) {
    localStorage.setItem("isLogin",false);
    window.location.href = "home.html"; 
}

function change() {
    
    if (lastactive == 1) {
    nouveau.classList.replace("active", "fw-bold");
   } if (lastactive == 2) {
        recherche.classList.replace("active", "fw-bold");
    } else if (lastactive == 3) {
        employee.classList.replace("active", "fw-bold");
    } else if (lastactive == 4) {
        Medaille.classList.replace("active", "fw-bold");
    } else if (lastactive == 5) {
        conges.classList.replace("active", "fw-bold");
    } else if (lastactive == 6) {
        occasion.classList.replace("active", "fw-bold");
        dropdownMenu.style.display = "none"; 
        if(active!=6){tg = false;}
    } else if (lastactive == 7) {
        gratification.classList.replace("active", "fw-bold");
    } else if (lastactive == 8) {
        notification.classList.replace("active", "fw-bold");
    } else {
        nouveau.classList.replace("active", "fw-bold");
    }
    if (active == 1) {
        nouveau.classList.replace("fw-bold", "active");
        title.textContent = "Nouveau Employee";
        iframe.src = "page/ajouter.html";
        iframe.focus(); 
        }
     else if (active == 2) {
        recherche.classList.replace("fw-bold", "active");
        title.textContent = "Rechercher";
        iframe.src = "page/recherche.html";
        iframe.focus();
    } else if (active == 3) {
        employee.classList.replace("fw-bold", "active");
        title.textContent = "Tableau de Bord";
        iframe.src = "page/liste.html";
        iframe.focus();
    } else if (active == 4) {
        Medaille.classList.replace("fw-bold", "active");
        title.textContent = "Les Medailles";
        iframe.src = "page/medaille.html";
        iframe.focus();
    } else if (active == 5) {
        conges.classList.replace("fw-bold", "active");
        title.textContent = "Les Congés";
        iframe.src = "page/congesp.html";
        iframe.focus();
    } else if (active == 6) {
        occasion.classList.replace("fw-bold", "active");
        title.textContent = "Les Occasions";
        dropdownMenu.style.display = "block"; 

        
    } else if (active == 7) {
        gratification.classList.replace("fw-bold", "active");
        title.textContent = "Les Gratifications";
        iframe.src = "page/gratification.html";
        iframe.focus();
    } else if (active == 8) {
        notification.classList.replace("fw-bold", "active");
        title.textContent = "Les  Notifications";
        iframe.src = "page/notification.html";
        iframe.focus();
    } else {
        nouveau.classList.replace("fw-bold", "active");
        title.textContent = "Nouveau Employee";
        iframe.src = "page/ajouter.html";
        iframe.focus();
    }
}
nouveau.onclick = function click(params) {
    lastactive = active;
    active = 1;
    change();
};

recherche.onclick = function click(params) {
    lastactive = active;
    active = 2;
    change();
};

employee.onclick = function click(params) {
    lastactive = active;
    active = 3;
    change();
};

Medaille.onclick = function click(params) {
    lastactive = active;
    active = 4;
    change();
};
conges.onclick = function click(params) {
   
    lastactive = active;
    active = 5;
    change();
    

};
occasion.onclick = function click(params) {
    dropdownMenu.classList.toggle('show');
    lastactive = active;
    active = 6;
    change();
    if(lastactive!=6){tog()}
};

function tog() {

    if(oindex==1){
        iframe.src = "page/occasion.html?date=/02/24";
       
    }else if(oindex ==2){
        iframe.src = "page/occasion.html?date=/05/01";
    }else if(oindex==3){    
        iframe.src = "page/occasion.html?date=/07/05";

    }else if(oindex==4){
        iframe.src = "page/occasion.html?date=/11/01";

    }else{
        iframe.src = "page/occasion.html?date=/12/31";

    }
    iframe.focus();
}

gratification.onclick = function click(params) {
    lastactive = active;
    active = 7;
    change();
};

notification.onclick = function click(params) {
    lastactive = active;
    active = 8;
    change();
};

const dropdownToggle = document.querySelector('.dropdown-toggle');
const dropdownMenu = document.querySelector('.dropdown-menu');

var tg = false

dropdownToggle.addEventListener('click', () => {
    
    tg = !tg;
    if(tg){
        dropdownMenu.style.display = "block"; 


    }else{
        dropdownMenu.style.display = "none"; 


    }
    

  });
  



occasion1.onclick = function click(params) {
    oindex =1;
    tg = false;
    dropdownMenu.style.display = "none"; 

    occasion1.classList.add('selected')
    occasion2.classList.remove('selected')
    occasion3.classList.remove('selected')
    occasion4.classList.remove('selected')
    occasion5.classList.remove('selected')
    tog()
}

occasion2.onclick = function click(params) {
    oindex =2;

    tg = false;
    dropdownMenu.style.display = "none"; 
    occasion1.classList.remove('selected')
    occasion2.classList.add('selected')
    occasion3.classList.remove('selected')
    occasion4.classList.remove('selected')
    occasion5.classList.remove('selected')
    tog()
}

occasion3.onclick = function click(params) {
    oindex =3;

    tg = false;
    dropdownMenu.style.display = "none"; 

    occasion1.classList.remove('selected')
    occasion2.classList.remove('selected')
    occasion3.classList.add('selected')
    occasion4.classList.remove('selected')
    occasion5.classList.remove('selected')
    tog()
}

occasion4.onclick = function click(params) {
    oindex =4;

    tg = false;
    dropdownMenu.style.display = "none"; 

    occasion1.classList.remove('selected')
    occasion2.classList.remove('selected')
    occasion3.classList.remove('selected')
    occasion4.classList.add('selected')
    occasion5.classList.remove('selected')
    tog()
}

occasion5.onclick = function click(params) {
    oindex =5;

    tg = false;
    dropdownMenu.style.display = "none"; 

    occasion1.classList.remove('selected')
    occasion2.classList.remove('selected')
    occasion3.classList.remove('selected')
    occasion4.classList.remove('selected')
    occasion5.classList.add('selected')
    tog()
}





  