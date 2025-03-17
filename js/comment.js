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


 
  $(".ri-thumb-up-line").click(function () {
    let commentId = $(this).attr("data-id"); // Get comment ID
    let likeIcon = $(this);
    let dislikeIcon = likeIcon.closest(".like-container").siblings(".dislike-container").find(".ri-thumb-down-line");

    likeIcon.toggleClass("active"); // Toggle like
    dislikeIcon.removeClass("active"); // Remove dislike if like is clicked
});

$(".ri-thumb-down-line").click(function () {
    let commentId = $(this).attr("data-id"); // Get comment ID
    let dislikeIcon = $(this);
    let likeIcon = dislikeIcon.closest(".dislike-container").siblings(".like-container").find(".ri-thumb-up-line");

    dislikeIcon.toggleClass("active"); // Toggle dislike
    likeIcon.removeClass("active"); // Remove like if dislike is clicked
});

});
