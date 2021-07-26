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
    if (filter.length > 1){
        let paramStr = filter[1];
        let ticketId = ""+paramStr.split('=')[1];
        setInterval(loadAJAXMessage,5000, ticketId);
    }
}

function changeStatus(selectedElement) {
    //TODO: save selectedElement.value based on selectedElement.id
    //TODO: selectedElement.id is ticketId, selectedElement.value is the updated status.
    //TODO: create php to send ajax to save
    // https://stackoverflow.com/questions/14766103/sending-html-form-multiple-select-box-via-post-request-with-ajax
    //DONE
    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            console.log("Result of status update: "+this.responseText)
        }
    }
    xmlHttpRequest.open("POST", "status-query.php");
    xmlHttpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    let data = JSON.stringify({"ticketId":selectedElement.id, "newTicketStatus":selectedElement.value});
    xmlHttpRequest.send(data);
}