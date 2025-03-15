$(document).ready(function () {
  $("#comment").click(function () {
      let commentText = $("#comment-text").val().trim(); // Get comment text

      if (commentText === "") {
          alert("Please write a comment before submitting.");
          return;
      }
      $("#comment-text").val("")
   /*
       $.ajax({
      url: "function.php",
      type: "POST",
      data: { add_quantity: quantity, product_id: productId }
    });
   */

  });

  $("#cancel-comment").click(function () {
      $("#comment-text").val(""); // Clear comment box correctly
  });
});
