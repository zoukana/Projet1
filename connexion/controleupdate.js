var form= document.getElementById("loginform");
var prenom= document.getElementById("prenom");
let nom= document.getElementById("nom");
var email= document.getElementById("email");

let erreurNom = document.getElementById("erreurNom");
let erreurprenom = document.getElementById("erreurprenom");
let erreuremail= document.getElementById("erreuremail");

var button = document.getElementById("submit");

nom.addEventListener('keyup', ()=>{
    if(nom.value.trim() === ""){
        erreurNom.classList.remove('text-success')
        erreurNom.classList.add('text-danger')
        erreurNom.innerHTML = "Ce champ est requis"
     
        return;
    }

    erreurNom.classList.remove('text-danger')
    erreurNom.classList.add('text-success')
    nom.setAttribute("data-valid", true);
    erreurNom.innerHTML = "valide!"
})
prenom.addEventListener('keyup', ()=>{
    if(prenom.value.trim() === ""){
        erreurprenom.classList.remove('text-success')
        erreurprenom.classList.add('text-danger')
        erreurprenom.innerHTML = "Ce champ est requis"
    
        return;
    }

    erreurprenom.classList.remove('text-danger')
    erreurprenom.classList.add('text-success')
    prenom.setAttribute("data-valid", true);
    erreurprenom.innerHTML = "valide!"
})
email.addEventListener('keyup', ()=>{
    if(email.value.trim() === ""){
        erreuremail.classList.remove('text-success')
        erreuremail.classList.add('text-danger')
        erreuremail.innerHTML = "Ce champ est requis"
 
        return;
    }
   if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
    erreuremail.classList.remove('text-success')
    erreuremail.classList.add('text-danger')
    erreuremail.innerHTML = "email invalide"

    console.log(!/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/.test(email.value));
    return;
    } 
 
    erreuremail.classList.remove('text-danger')
    erreuremail.classList.add('text-success')
    erreuremail.innerHTML = "valide!"
    
})


/* console.log(nom.getAttribute("data-valid"));
 */

