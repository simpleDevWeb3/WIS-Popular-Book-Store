$(document).ready(function () {
  let cartCount = parseInt($("#cart-count").text());

  $("#add-to-cart-btn").click(function () {
    let quantity = parseInt($("#quantity").val()); // Get updated quantity
    cartCount += quantity; // Add the selected quantity to cart count
    $("#cart-count").text(cartCount); // Update cart UI
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
});


