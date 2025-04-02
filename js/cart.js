
$(document).ready(function () {


  /////////////////////////////////////
  ///////GLOBAL VARIABLE///////////////
  /////////////////////////////////////

  let cartCount = parseInt($("#cart-count").text()); // Update cart UI count
  
  let stock = parseInt(product_details.stock); // Ensure stock is a number
  let productId = product_details.product_id; 

  // Store initial stock in localStorage if not set
  if (!localStorage.getItem(`stock_${productId}`)) {
    localStorage.setItem(`stock_${productId}`, stock);
  }



  let timeout;

  /////////////////////////////////////////////////////
  // ADDING TO CART
  /////////////////////////////////////////////////////

  $("#add-to-cart-btn").click(function () {
    let quantity = parseInt($("#quantity").val()); // Get user-selected quantity
    
    

    console.log("quantity_in cart: " + cart_product);
    console.log("User Wants to Buy: " + quantity);
    console.log("Stock: " + stock);

    // Prevent user from buying more than allowed
    if (cart_product + quantity> stock ) {
      alert("User have been exceeds buying limits (Stock: " + cart_product+ " User want to Buy: " + quantity + ")" );
      $("#quantity").val(1);
      return; // Stop further execution
    }

    if(!quantity){
      alert("User must input quantity");
      $("#quantity").val(1);
      return; // Stop further execution
    }

    // Decrease buy limit
    
   

    cartCount += quantity;
    $("#cart-count").text(cartCount); // Update cart UI

    $("#info")
      .html("The item has been added to cart!")
      .show()
      .addClass("pop");

    if (timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(() => {
      $("#info").removeClass("pop").hide();
    }, 1400);

    // Send quantity update to backend
    $.ajax({
      url: "/cart", // Calls the PHP function
      type: "POST",
      data: { add_quantity: quantity, product_id: productId },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
                location.reload();
                console.log("Cart updated:", response);
                $.ajax({
                  url: "/product", // Backend route to get updated quantity
                  type: "GET",
                  data: { product_id: productId },
                  dataType: "json",
                  success: function (cartData) {
                      cart_product = cartData.quantity; // ✅ Update cart_product dynamically
                      console.log("Updated quantity in cart:", cart_product);
                    
                    
                  }
              });
        } else {
          alert(response.message);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      },
    });
  });

  /////////////////////////////////////////////////////
  // INCREASE/DECREASE QUANTITY
  /////////////////////////////////////////////////////

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


  //////////////////////////////
  //quantity-input validation//
  ///////////////////////////
  
   // Ensure only numeric input for quantity
   $("#quantity").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
});