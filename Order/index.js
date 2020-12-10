import swal from 'sweetalert';
function validation() {
    var zip = len(document.getElementById("zip").value);
    var ccnum = len(document.getElementById("ccnum").value);
    if((zip==6)&&(ccnum==15)){
        print("error")
        swal("Great!", "Your Order Successfully Placed!", "success");
    }
    else{
        print("no error")
        swal("Please fill the fields appropriately!","error");
    }
}