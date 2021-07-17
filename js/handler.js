let xmlHttpRequest = new XMLHttpRequest();
function loadAJAXMessage(ticketId) {

    xmlHttpRequest.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200){
            document.getElementById("list_messages").innerHTML = this.responseText;
        }
    }
    xmlHttpRequest.open("GET","current-messages.php?id="+ticketId);
    xmlHttpRequest.send();
}

window.onload = function (){
    let url = location.search;
    let filter = url.split('?');
    let paramStr = filter[1];
    let ticketId = ""+paramStr.split('=')[1];
    setInterval(loadAJAXMessage,5000, ticketId);
}