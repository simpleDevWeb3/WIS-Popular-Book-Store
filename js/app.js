$(document).ready(function () {

  /////////////////////////////////////
  ///////GLOBAL VARIABLE////////////////
  /////////////////////////////////////

  let cartCount = parseInt($("#cart-count").text()); //FOR UPDATE CART 

 

   /////////////////////////////////////////////////////
  //ADDING TO CART                                   / /
  /////////////////////////////////////////////////////
 

  $("#add-to-cart-btn").click(function () {
    let quantity = parseInt($("#quantity").val()); // Get updated quantity
    cartCount += quantity; // Add the selected quantity to cart count
    $("#cart-count").text(cartCount); // Update cart UI

        
      $.ajax({
        url:'function.php',
        type:'POST',
        data:{add_quantity: quantity},
      });

  });

  $("#increase").click(function () {
    let quantity = parseInt($("#quantity").val()); // Get updated value
    quantity += 1;
    $("#quantity").val(quantity);
  });

  $("#decrease").click(function () {
    let quantity = parseInt($("#quantity").val()); // Get updated value
    if (quantity > 1) { // Prevent going below 1
      quantity -= 1;
      $("#quantity").val(quantity);
    }
  });


  //////////////////////////////////////////////////////////////////////////
});


