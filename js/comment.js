let productId = product_details.product_id; 
const maxCharacters = 200;

$(document).ready(function () {
  $("#comment-text").click(function(){
    $("#comment-buttons").removeClass("hidden");
    $("#error-text").hide();
   $("#comment-text").addClass("comment-section-active");
  });


  $("#comment-text").on("input", function () {
    this.style.height = "auto"; // Reset height
    this.style.height = this.scrollHeight + "px"; // Adjust height based on content
  });


  $("#comment").click(function () {
      let commentText = $("#comment-text").val().trim(); // Get comment text
     
      $("#comment-text").removeClass("comment-section-active");
      $("#comment-buttons").addClass("hidden");
      $("#error-text").addClass("hidden");
      if (commentText === "") {
         
          return;
      }
      $("#comment-text").val("");

      if(commentText.length > maxCharacters){
        $("#error-text").text(`❌ Comment exceeds ${maxCharacters} characters!`).show();
        return;
      }

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
      $("#comment-buttons").addClass("hidden");
      $("#comment-text").removeClass("comment-section-active");
  });


 
 

});
