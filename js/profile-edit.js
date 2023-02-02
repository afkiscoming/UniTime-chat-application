const updateButton = document.getElementById("update-button");
const errorText = document.getElementById("error-txt");
const form = document.querySelector(".edit form");

form.onsubmit = (e)=>{
    e.preventDefault();
}

updateButton.onclick = ()=>{
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "edit-code.php", true)
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success")
                {
                    location.href = "user-profile.php";
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