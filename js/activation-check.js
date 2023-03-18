const errorText = document.getElementById("error-txt");
const successText = document.getElementById("success-txt");
const loginPageLink = document.getElementById("login-page-link");

const urlParams = new URLSearchParams(window.location.search);
const token = urlParams.get('token');


window.onload = function() {
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "activation-check-code.php", true)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "success") {

                    errorText.textContent = "";
                    errorText.style.display = "none";

                    successText.textContent = "Your account successfully activated. Please login to continue.";
                    successText.style.display = "block";

                    loginPageLink.style.display =  "block";

                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    loginPageLink.style.display = "block";
                }
            }
        }
    }
    xhr.send('token=' + token);
}