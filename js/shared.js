$(document).ready(function () {

  /////////////////////////////////////////////////////
  // SEARCH FUNCTIONALITY
  /////////////////////////////////////////////////////

  $("#search").click(function (e) {
    e.preventDefault();
    performSearch();
  });

  $("#search-bar").on("keypress", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      performSearch();
    }
  });



  /////function for search/////
  function performSearch() {
    let keyword = $("#search-bar").val();

    if (keyword !== "") {
      window.location.href = `/search?keyword=${encodeURIComponent(keyword)}`;
    }
  }

 
});
