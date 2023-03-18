let userCountButton = document.querySelector("#user-count-button");
let adminCountButton = document.querySelector("#admin-count-button");
let mostMessagesButton = document.querySelector("#most-messages-button");
let recentMatchButton = document.querySelector("#recent-match-button");

let userCountResult = document.querySelector("#user-count-result");
let adminCountResult = document.querySelector("#admin-count-result");
let mostMessagesResult = document.querySelector("#most-messages-result");
let recentMatchResult = document.querySelector("#recent-match-result");

userCountButton.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin-code.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = xhr.responseText;
                userCountResult.innerHTML = response;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("user_count=true");
}

adminCountButton.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin-code.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                adminCountResult.innerHTML = xhr.responseText;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("admin_count=true");
}

mostMessagesButton.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin-code.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = xhr.responseText;
                if (response.includes("No messages found.")) {
                    mostMessagesResult.innerHTML = "No messages found.";
                } else {
                    let result = response.split("|");
                    let user = result[0].split(",");
                    mostMessagesResult.innerHTML = user[0] + " " + user[1] + " (" + user[2] + ") - " + result[1] + " messages";
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("most_messages=true");
}

recentMatchButton.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin-code.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = xhr.responseText;
                if (response.includes("No match found.")) {
                    recentMatchResult.innerHTML = "No match found.";
                } else {
                    let result = response.split("|");
                    let matchReceiver = result[0];
                    let matchedUser = result[1];
                    let matchCreationTime = result[2];
                    recentMatchResult.innerHTML = "Match Receiver: " + matchReceiver + "<br>Matched User: " + matchedUser + "<br>Match Creation Time: " + matchCreationTime;
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("recent_match=true");
}
