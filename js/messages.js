const usersList = document.getElementById("users-list");

setInterval(()=>{
//AJAX
        let xhr = new XMLHttpRequest();    //creating XML object
        xhr.open("GET", "messages-code.php", true);
        xhr.onload = ()=> {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                        usersList.innerHTML = data;
                }
            }
        }
        xhr.send();
}, 500);    //this function will run frequently after 500ms