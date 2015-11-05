$('#removeModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var article_id = button.data('id');
    var modal = $(this);
    modal.find("input:hidden[name='article_id']").val(article_id);
});