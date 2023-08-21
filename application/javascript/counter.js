$(document).on("click", "#btnSelect", function () {
  var counter_name = $(this).data("counter");
  var counter_format_no = $(this).data("counterformatno");

  $("#counter_name").val(counter_name);
  $("#counter_format_no").val(counter_format_no);

  document.getElementById("btnSubmit").style.display = "none";
});

$(document).on("click", "#btnAdd", function () {
  $("#counter_name").val("");
  $("#counter_format_no").val("");
  document.getElementById("btnSubmit").style.display = "show";
});
