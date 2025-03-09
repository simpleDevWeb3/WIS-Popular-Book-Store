$(document).ready(function() {
///////////////Price Filter////////////////////////////////////////////
  $("#price-range").on("input", function() {
      let price = $(this).val();
      console.log("Dragging price range: " + price); // Check if this updates
      $("#price").text(price);
  });

  $("#apply").click(function() {
      let selectedPrice = $("#price-range").val();

      // Debugging: Log the price before sending
      console.log("Sending Price: " + selectedPrice);

      $.ajax({
          url: "function.php",
          type: "POST",
          data: { price: selectedPrice },
          success: function(response) {
              console.log(" Server Response:", response);
              location.reload(); // Refresh the page
            
          },
          error: function(xhr, status, error) {
              console.log(" AJAX Error:", status, error);
          }
      });
  });
  //////////////////////////////////////////////////////////////////////////



});
