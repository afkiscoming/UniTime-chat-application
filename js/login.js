const loginButton = document.getElementById("login-button");
const errorText = document.getElementById("error-txt");
const form = document.querySelector(".login form");

form.onsubmit = (e)=>{
    e.preventDefault();
}

loginButton.onclick = ()=>{
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "login-code.php", true)
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success")
                {
                    location.href = "messages.php";
                }
                else if(data === "admin")
                {
                    location.href = "admin.php";
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