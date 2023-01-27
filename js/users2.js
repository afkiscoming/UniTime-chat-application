const searchBar = document.getElementById("search-bar");
const searchButton = document.getElementById("search-button");
const usersList = document.getElementById("users-list");

searchButton.onclick = () => {
    searchBar.classList.toggle("active")
    searchBar.focus();
    searchButton.classList.toggle("active")
    searchBar.value = "";
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
//AJAX
    if(searchTerm != "")
    {
        searchBar.classList.add("active")
    }
    else
    {
        searchBar.classList.remove("active")
    }
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("POST", "search-code2.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(()=>{
//AJAX
    let xhr = new XMLHttpRequest();    //creating XML object
    xhr.open("GET", "users-code2.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active"))     //if the active not contains in searchbar then add this data
                {
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();

}, 500);    //this function will run frequently after 500ms