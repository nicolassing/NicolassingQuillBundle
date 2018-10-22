var containers = $(".quill");
containers.each(function () {
  var quill = new Quill($(this).get(0), {
    theme: $(this).data('theme')
  });
  var textareaId = $(this).data('id');
  quill.on('text-change', function(delta, oldDelta, source) {
    $("#"+textareaId).val(quill.root.innerHTML);
  });
});