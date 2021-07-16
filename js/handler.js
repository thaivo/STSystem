function loadAJAXMessage(ticketId) {
    let xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200){
            //console.log("this.responseText: "+this.responseText);
            document.getElementById("list_messages").innerHTML = this.responseText;
        }
    }
    xmlHttpRequest.open("GET","current-messages.php?id="+ticketId);
    xmlHttpRequest.send();
}

window.onload = function (){

    //let ticketId = "<?php echo"+$id+"; ?>";
    let url = location.search;
    console.log(url);
    let filter = url.split('?');
    let paramStr = filter[1];
    let ticketId = ""+paramStr.split('=')[1];
    console.log("ticket id: "+ticketId);
    setInterval(loadAJAXMessage,5000, ticketId);
}