document.addEventListener("DOMContentLoaded", function() {
    loadMessages();
    setInterval(loadMessages, 3000);
});

function handleKeyPress(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
}

function sendMessage() {
    let username = document.getElementById("username").value;
    let message = document.getElementById("message").value;
    
    if (username === "" || message === "") return;
    
    fetch("send_message.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `username=${username}&message=${message}`
    }).then(() => {
        document.getElementById("message").value = "";
        loadMessages();
    });
}

function loadMessages() {
    fetch("get_messages.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("chat-box").innerHTML = data;
        });
}