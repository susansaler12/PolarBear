window.onload = function(){
    var deleteRow = document.getElementById("delete_row");
    deleteRow.onclick = function(){
        var confirm = alert("Would you really like to permanently delete this row?");

        if(confirm != true){
            return false;
        }
    }
}

