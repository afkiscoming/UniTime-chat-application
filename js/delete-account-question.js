
const deleteButton = document.getElementById("delete-account");
const cancelButton = document.getElementById("cancel-button");
const errorText = document.getElementById("error-txt");
const successText = document.getElementById("success-txt");

const loginPageLink = document.getElementById("login-page-link");


window.onload = function() {
    errorText.textContent = "This action is irrevocable! Do you want to delete your account?";
    errorText.style.display = "block";
    errorText.style.fontWeight = "bold";
    errorText.style.fontSize = "18px";
    }

deleteButton.onclick = ()=>{
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "delete-account-code.php", true)
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success")
                {
                    console.log("sc")
                    errorText.textContent = "";
                    errorText.style.display = "none";

                    successText.textContent = "Your account successfully deleted!";
                    successText.style.display = "block";

                    loginPageLink.style.display = "block";

                    deleteButton.style.display = "none";
                    cancelButton.style.display = "none";

                }
                else
                {
                    errorText.textContent = data;
                    errorText.style.display = "block";

                    loginPageLink.style.display = "block";

                    deleteButton.style.display = "none";
                    cancelButton.style.display = "none";
                }
            }
        }
    }
    //we have to send data from form trough ajax to php
    xhr.send(new FormData(document.getElementById('delete-account-form')));
}

cancelButton.addEventListener('click', function (){
    window.location.href = "../php/user-profile.php";
});