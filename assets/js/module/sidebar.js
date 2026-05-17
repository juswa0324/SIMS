$(document).on("mouseenter", ".sidebar a", function () {
  const $this = $(this);
  $this
    .data("prehovercolor", $this.css("background-image"))
    .css("background-image", "linear-gradient(#FFFFFF, #FFFFFF)")
    .css("color", "#000000");
  $this.find("path").css("fill", "#000000");
});

$(document).on("mouseleave", ".sidebar a", function () {
  const $this = $(this);
  $this
    .css("background-image", $this.data("prehovercolor"))
    .css("color", "#FFFFFF");
  $this.find("path").css("fill", "#FFFFFF");
});
