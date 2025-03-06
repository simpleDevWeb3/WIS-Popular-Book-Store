$(document).ready(function () {

  /////////////////////////////////////
  ///////GLOBAL VARIABLE////////////////
  /////////////////////////////////////

  let cartCount = parseInt($("#cart-count").text
  ()); //FOR UPDATE CART 
  
  let timeout;
 

   /////////////////////////////////////////////////////
  //ADDING TO CART                                   / /
  /////////////////////////////////////////////////////


  $("#add-to-cart-btn").click(function () {
    let quantity = parseInt($("#quantity").val
    ()); // Get updated quantity


    $.ajax({
      url:'/product',
      type:'GET',
      data:{stock: stock}

    });

    

 
     
  if(!stock || stock <=0){
    alert("User already exceed the purchase limit");
  }

    $("#quantity").on("input",function(){
      this.value = this.value.replace(/[^0-9]/g, ""); // Remove non-numeric characters
    })

    if(quantity <= stock && quantity > 0){
      cartCount += quantity;
      stock -= quantity;
      console.log(stock);
      
      // Add the selected quantity to cart count
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
    }
    
    else if(quantity > stock || quantity <= 0 || !quantity){

        $("#info")
        .html("Invalid Quantity")
        .show()
        .addClass("pop");
     

       
      
      if(timeout){
        clearTimeout(timeout);
      }
      timeout = setTimeout(()=>{
        $("#info").removeClass("pop").hide();
      },1400);// after 1.4 sec remove pop
      
      
     quantity = 1;

    $("#quantity").val
    (quantity);
    
    }

   


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


  $("#search").click(function(e){
    //console.log($("#search-bar").val());
   e.preventDefault();
   // console.log($(this).val());
    window.location.href='/search?keyword=' + $("#search-bar").val();

    
  })

  $("#search-bar").on("keypress",function(e){
    if(e.key === "Enter"){
      e.preventDefault();
      //console.log($(this).val());
      window.location.href='/search?keyword=' + $(this).val();
   
    }
  })

  // Apply input filter globally
  $(document).ready(function () {
    $("#quantity").on("input", function () {
      this.value = this.value.replace(/[^0-9]/g, ""); // Allow only numbers
    });
  });


});


