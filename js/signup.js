const signupButton = document.getElementById("signup-button");
const errorText = document.getElementById("error-txt");
const form = document.querySelector(".signup form");

form.onsubmit = (e)=>{
    e.preventDefault();
}

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
                    location.href = "users-in-messages.php";
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