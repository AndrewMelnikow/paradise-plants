// remove on click
$(function(){
  $(".cookies-alert").click(function() {
      $(this).parent().remove();
  });
});
// send status to session
$(function(){
  $(".cookies-alert").on("click", function(){
    $.post(
      "comp/component_cookiesalert.php",
      {status: true}
    );
  });
});