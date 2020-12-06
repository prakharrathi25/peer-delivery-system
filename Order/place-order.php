<?php

$user_id = $_GET['id'];

?>

<!DOCTYPE html>
<html><head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="order.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Place Order</title>
</head>

<body>
    <h2 style="text-align:center;">Place a new delivery order</h2><br>
<h3>Order Details</h3>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form method="post" enctype="multipart/form-data" action="order_process.php?id=<?php echo $user_id?>">

        <div class="row">
          <div class="col-50">
            <h3>Destination Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Recepients Name</label>
            <input type="text" id="fname" name="name" placeholder="John Doe" required>
            <label for="email"><i class="fa fa-envelope"></i> Recepients Number</label>
            <input type="text" id="email" name="email" placeholder="john@doe.com" required>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Hostel 1A, SNU" required>
            <label for="city"><i class="fa fa-institution"></i> Destination City</label>
            <input type="text" id="city" name="city" placeholder="Greater Noida" required>

            <div class="row">
              <div class="col-50">
                <label for="zip">Pin Code</label>
                <input type="text" id="zip" name="zip" placeholder="200301" required>
              </div>
            </div>

            <!-- Parcel Details -->
            <div class="row">
              <div class="col-50">
                <label for="expyear">Weight (gms)</label>
                <input type="text" id="Weight" name="weight" placeholder="500" required>
              </div>
              <div class="col-50">
                <label for="cvv">Height (cm)</label>
                <input type="text" id="height" name="height" placeholder="35" required>
              </div>
            </div>

            <div class="row">
              <div class="col-50">
                <label for="expyear">Width (cm)</label>
                <input type="text" id="width" name="width" placeholder="25" required>
              </div>
              <div class="col-50">
                <label for="cvv">Length (cm)</label>
                <input type="text" id="length" name="length" placeholder="35" required>
              </div>
            </div>
            <label for="city">Content Desctiption (Optional)</label>
            <textarea type="textarea" rows="4" cols="50" id="description" name="description" placeholder="Box Color, Contents etc.">
            </textarea>

          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Kartikey Garg">
            <label for="ccnum">Card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
              <label for="cost">  Price Offering </label>
              <input type="text" id="cost" name="cost" placeholder="250" required>

            </div>
          </div>
        </div>
        <br><label for="image">Upload Parcel Image</label>
        <label>
            <input type="file" id="file" name="startImage" accept="image/*" required>
        </label>
        <button type="button" name="order-submit" class="btn" id="btn">Place Order</button>
      </form>

    </div>
  </div>


  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4>
      <p><a href="#">Estimated Distance</a> <span class="price"> 5 KM</span></p>
      <p><a href="#">Charges</a> <span class="price">Estimated Distance * 15</span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b>75 Rupees </b></span></p>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script>
    $("#btn1").click(function(){
        var name=$("#cname").val();
        var ccnum=$("#ccnum").val();
        var fname=$("#fname").val();
        var email=$("#email").val();
        var adr=$("#adr").val();
        var city=$("#city").val();
        var zip=$("#zip").val();
        var expmonth=$("#expmonth").val();
        var expyear=$("#expyear").val();
        var cvv=$("#cvv").val();
        var file=$("#file").val();
        if(name=='' || ccnum=='' ||fname=='' ||email=='' ||adr=='' ||city=='' ||zip=='' || file=='')
        {
            swal("Error!", "Please fill all the fields!", "error");
        }
        else{
            swal("Great!", "Your Order Successfully Placed!", "success");
        }
})
</script> -->
</body>
</html>
