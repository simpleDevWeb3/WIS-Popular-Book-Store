let productId = product_details.product_id; 

$(document).ready(function () {
  $("#comment").click(function () {
      let commentText = $("#comment-text").val().trim(); // Get comment text
      console.log("Comment Text:", commentText);
      console.log("Product ID:", productId);

      if (commentText === "") {
          alert("Please write a comment before submitting.");
          return;
      }
      $("#comment-text").val("");

      $.ajax({
        url: "/comment",
        type: "POST",
        data: { comment: commentText, product_id: productId },
        success: function(response) {
          console.log(" Server Response:", response);
          location.reload(); // Refresh the page
        
       },
      
      });
  });

  $("#cancel-comment").click(function () {
      $("#comment-text").val(""); // Clear comment box correctly
  });
});
