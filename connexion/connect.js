var form= document.getElementById("loginform");
var mail= document.getElementById("email");
var mdp= document.getElementById("passwords");

var errormail=document.getElementById("errormail");
/* var errormdp=document.getElementById("errorpwd");
 */

var button = document.getElementById("submit");
button.setAttribute("disabled", true)

mail.addEventListener('keyup', ()=>{
    if(mail.value.trim() === ""){
         errormail.classList.remove('text-success')
         errormail.classList.add('text-danger')
        errormail.innerHTML = "Ce champ est requis"
    button.setAttribute("disabled", true)
        mail.setAttribute("data-valid", false); 
        return;
    }
    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
        errormail.classList.remove('text-success')
        errormail.classList.add('text-danger')
        errormail.innerHTML = "email invalide"
        button.setAttribute("disabled", true)
        mail.setAttribute("data-valid", false);
       return;
        } 
   errormail.classList.remove('text-danger')
      errormail.classList.add('text-success')
     mail.setAttribute("data-valid", true);
     errormail.innerHTML = "saisit!"
  
 validate()
})
pwd.addEventListener('keyup', ()=>{
    if(pwd.value === ""){
       errorpwd.classList.remove('text-success')
       errorpwd.classList.add('text-danger')
        errorpwd.innerHTML = "Ce champ est requis"
        button.setAttribute("disabled", true)
        pwd.setAttribute("data-valid", false);
        return;
    }

    errorpwd.classList.remove('text-danger')
    errorpwd.classList.add('text-success')
  pwd.setAttribute("data-valid", true);
      errorpwd.innerHTML = "saisit!"
     validate()
}) 

function validate(){
    if(mail.getAttribute("data-valid") == "true" && pwd.getAttribute("data-valid") == "true" ){
        button.removeAttribute("disabled")
    }
}


