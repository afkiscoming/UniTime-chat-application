const passwordField = document.getElementById("password");
const toggleButton = document.getElementById("show-hide-button");

toggleButton.onclick = ()=>{
    if(passwordField.type == "password")
    {
        passwordField.type = "text";
        toggleButton.style.color = "#333";
    }
    else
    {
        passwordField.type = "password";
        toggleButton.style.color = "#ccc";
    }
}