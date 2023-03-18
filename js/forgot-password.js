const mailSendButton = document.getElementById("mail-send-button");
const errorText = document.getElementById("error-txt");
const successText = document.getElementById("success-txt");
const form = document.querySelector(".reset-password form");

form.onsubmit = (e)=>{
    e.preventDefault();
}

mailSendButton.onclick = ()=>{
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "forgot-password-code.php", true)
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                try {
                    const jsonData = JSON.parse(xhr.response);
                    if (jsonData === true) {
                        errorText.textContent = "";
                        errorText.style.display = "none";

                        successText.textContent = "Email successfully sent! Please check your inbox.";
                        successText.style.display = "block"
                    } else {
                        errorText.textContent = jsonData;
                        errorText.style.display = "block";
                    }
                } catch (e) {
                    successText.textContent = "";
                    successText.style.display = "none";
                    errorText.textContent = xhr.response;
                    errorText.style.display = "block";
                }
            }
        }
    }
    //we have to send data from form trough ajax to php
    let formData = new FormData(form);  //creating new formData object
    xhr.send(formData);                 //sending form data to php
}