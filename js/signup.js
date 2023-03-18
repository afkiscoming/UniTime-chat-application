const signupButton = document.getElementById("signup-button");
const signupForm = document.getElementById("signup-form");
const loginLink = document.getElementById("login-link");
const loginHref = document.getElementById("login-href");

const errorText = document.getElementById("error-txt");
const successText = document.getElementById("success-txt");
const form = document.querySelector(".signup form");

form.onsubmit = (e)=>{
    e.preventDefault();
}

let userSaved = false;

signupButton.onclick = ()=>{
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "signup-code.php", true)
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success")
                {
                    userSaved = true
                    let xhr2 = new XMLHttpRequest();    //creating XML object
                    xhr2.open("POST", "email-activation-send-code.php", true)
                    xhr2.onload = ()=> {
                        if(xhr2.readyState === XMLHttpRequest.DONE){
                            if(xhr2.status === 200){
                                let data = xhr2.response;
                                if(data === "success")
                                {
                                    signupForm.style.display = "none";
                                    errorText.style.display = "none";
                                    successText.textContent = "Activation email has been sent. Please check your email inbox.";
                                    successText.style.display = "block";

                                    loginHref.textContent = "Login Page";
                                    loginLink.innerHTML = "Turn back to ";
                                    loginLink.appendChild(loginHref);
                                }
                                else
                                {
                                    errorText.textContent = data;
                                    errorText.style.display = "block";
                                }
                            }
                        }
                    }
                    xhr2.send(formData);
                }
                else
                {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    //we have to send data from form trough ajax to php
    let formData = new FormData(form);  //creating new formData object
    xhr.send(formData);                 //sending form data to php

}