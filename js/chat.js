const sendButton = document.getElementById("send-button");
const inputField = document.getElementById("input-field");
const form = document.querySelector(".typing-area");
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();

sendButton.onclick = ()=>{
    //AJAX
    let xhr = new XMLHttpRequest();     //creating XML object
    xhr.open("POST", "insert-chat.php", true)
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    //we have to send data from form trough ajax to php
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    //AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "get-chat.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){  //if active class not contains in the chatbox to bottom
                    scrollToBottom();
                }
            }
        }
    }
    //we have to send data from form trough ajax to php
    let formData = new FormData(form);
    xhr.send(formData);

}, 500);    //this function will run frequently after 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}