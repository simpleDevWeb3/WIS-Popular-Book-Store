$(document).ready(function () {
  let urlParams = new URLSearchParams(window.location.search);
  let selectedValue = urlParams.get('sort');

  if (selectedValue) {
      $('#sortOptions').val(selectedValue); // Set dropdown to current sort
  }

  $('#sortOptions').change(function () {
      let selectedValue = $(this).val();
      urlParams.set('sort', selectedValue);
      window.location.search = urlParams.toString(); // Reloads the page 
  });
});
