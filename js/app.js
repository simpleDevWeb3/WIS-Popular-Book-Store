$(document).ready(function () {

  /////////////////////////////////////
  ///////GLOBAL VARIABLE////////////////
  /////////////////////////////////////

  let cartCount = parseInt($("#cart-count").text()); //FOR UPDATE CART 
  let timeout;
 

   /////////////////////////////////////////////////////
  //ADDING TO CART                                   / /
  /////////////////////////////////////////////////////
 

  $("#add-to-cart-btn").click(function () {
    let quantity = parseInt($("#quantity").val()); // Get updated quantity
    cartCount += quantity; // Add the selected quantity to cart count
    $("#cart-count").text(cartCount); // Update cart UI
    $("#info")
    .html("The item has added to cart!")
    .show()
    .addClass("pop");

    if(timeout){
      clearTimeout(timeout);
    }
    timeout = setTimeout(()=>{
      $("#info").removeClass("pop").hide();
    },1400);// after 1.4 sec remove pop

        
      $.ajax({
        url:'function.php',
        type:'POST',
        data:{add_quantity: quantity}

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



  /////////////////////////////////////////////////////
  ////////           SEARCHING           ///////////
  ////////////////////////////////////////////////

  /////GLOBAL VARIABLE////
  


  $("#search").click(function(){
    //console.log($("#search-bar").val());
   
    console.log($(this).val());
    window.location.href='/search?keyword=' + $(this).val();

    
  })

  $("#search-bar").on("keypress",function(e){
    if(e.key === "Enter"){
      e.preventDefault();
      console.log($(this).val());
      window.location.href='/search?keyword=' + $(this).val();
   
    }
  })




});


