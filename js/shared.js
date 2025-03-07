$(document).ready(function () {

  /////////////////////////////////////////////////////
  // SEARCH FUNCTIONALITY
  /////////////////////////////////////////////////////

  $("#search").click(function (e) {
    e.preventDefault();
    window.location.href = "/search?keyword=" + $("#search-bar").val();
  });

  $("#search-bar").on("keypress", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      window.location.href = "/search?keyword=" + $(this).val();
    }
  });

 
});
