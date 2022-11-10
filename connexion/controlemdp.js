

var form= document.getElementById("loginform");
var email= document.getElementById("email");
var ancien= document.getElementById("opwd");
var pwd= document.getElementById("pwd");
var pwd1= document.getElementById("pwd1");
 

let erreuremail= document.getElementById("erreuremail");
let erreurancien= document.getElementById("erreurancien");
let erreurpwd= document.getElementById("erreurpwd");
 let erreurpwd1= document.getElementById("erreurpwd1");
 

var button = document.getElementById("submit");
button.setAttribute("disabled", true)


pwd.addEventListener('keyup', ()=>{
    if(pwd.value === ""){
        erreurpwd.classList.remove('text-success')
        erreurpwd.classList.add('text-danger')
        erreurpwd.innerHTML = "Ce champ est requis"
        button.setAttribute("disabled", true)
        pwd.setAttribute("data-valid", false);
        return;
    }

    erreurpwd.classList.remove('text-danger')
    erreurpwd.classList.add('text-success')
    pwd.setAttribute("data-valid", true);
    erreurpwd.innerHTML = "valide!"
    validate()
}) 

 pwd1.addEventListener('keyup', ()=>{
    if(pwd1.value === ""){
        erreurpwd1.classList.remove('text-success')
        erreurpwd1.classList.add('text-danger')
        erreurpwd1.innerHTML = "Ce champ est requis"
        button.setAttribute("disabled", true)
        pwd1.setAttribute("data-valid", false);
        return;
    }    else if (pwd1.value !== pwd.value) {
        erreurpwd1.classList.remove('text-success')
        erreurpwd1.classList.add('text-danger')
        erreurpwd1.innerHTML = "Les mots_de_passe ne correspondent pas!"
        button.setAttribute("disabled", true)
        pwd1.setAttribute("data-valid", false);
        return;
    }  else {
        erreurpwd1.classList.remove('text-danger')
        erreurpwd1.classList.add('text-success')
        pwd1.setAttribute("data-valid", true);
        erreurpwd1.innerHTML = "valide!"
        validate()
    }
 
})  

ancien.addEventListener('change', ()=>{
    if(opwd.value === ""){
        erreurancien.classList.remove('text-success')
       erreurancien.classList.add('text-danger')
       erreurancien.innerHTML = "Ce champ est requis"
        button.setAttribute("disabled", true)
        role.setAttribute("data-valid", false);
        return;
    }

   erreurancien.classList.remove('text-danger')
   erreurancien.classList.add('text-success')
    role.setAttribute("data-valid", true);
   erreurancien.innerHTML = "valide!"
    validate()
}) 

/* email.addEventListener('keyup', ()=>{
    if(email.value.trim() === ""){
        erreuremail.classList.remove('text-success')
        erreuremail.classList.add('text-danger')
        erreuremail.innerHTML = "Ce champ est requis"
        button.setAttribute("disabled", true)
        email.setAttribute("data-valid", false);
        return;
    }
   if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
    erreuremail.classList.remove('text-success')
    erreuremail.classList.add('text-danger')
    erreuremail.innerHTML = "email invalide"
    button.setAttribute("disabled", true)
    email.setAttribute("data-valid", false);
    console.log(!/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/.test(email.value));
    return;
    } 
 
    erreuremail.classList.remove('text-danger')
    erreuremail.classList.add('text-success')
    email.setAttribute("data-valid", true);
    erreuremail.innerHTML = "valide!"
    
    validate()
}) */


/* console.log(nom.getAttribute("data-valid"));
 */
function validate(){
    if(pwd.getAttribute("data-valid") == "true" &&  pwd1.getAttribute("data-valid") == "true" ){
        button.removeAttribute("disabled")
    }
}




