const resetButton = document.getElementById("reset-password-button");
const newPassInput = document.getElementById("new-pass-input");

const errorText = document.getElementById("error-txt");
const successText = document.getElementById("success-txt");
const loginPageLink = document.getElementById("login-page-link");

const form = document.querySelector(".form2 form");

const urlParams = new URLSearchParams(window.location.search);
const token = urlParams.get('token');


form.onsubmit = (e)=>{
    e.preventDefault();
}

let correctToken = false;

window.onload = function() {
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "reset-token-check.php", true)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success")
                {
                    correctToken = true;
                    resetButton.style.display = "block";
                }
                else
                {
                    resetButton.style.display = "none";
                    newPassInput.style.display = "none";
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    loginPageLink.style.display =  "block";

                }
            }
        }
    }
    xhr.send('token=' + token);     //sending form data to php

    resetButton.onclick = ()=>{
        if (correctToken)
        {
            let password = newPassInput.querySelector('input').value.trim();
            //AJAX
            let xhr = new XMLHttpRequest();    //creating XML object
            xhr.open("POST", "new-password-code.php", true)
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = ()=> {
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if(data === "success")
                        {
                            resetButton.style.display = "none";
                            newPassInput.style.display = "none";
                            errorText.textContent = "";
                            errorText.style.display = "none";

                            successText.textContent = "Your password successfully changed. You can login into your account.";
                            successText.style.display = "block";

                            loginPageLink.style.display =  "block";
                        }
                        else
                        {
                            errorText.textContent = data;
                            errorText.style.display = "block";
                            loginPageLink.style.display =  "block";
                        }
                    }
                }
            }
            //we have to send data from form trough ajax to php
            xhr.send("password=" + password + "&token=" + token);        }
        else
        {
            errorText.textContent = "Invalid or expired token! Please request new password reset link.";
            errorText.style.display = "block";
            loginPageLink.style.display =  "block";
        }
    }
};


