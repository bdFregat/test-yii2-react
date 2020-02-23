$(function () {
    $('[data-author-modal]').click(function () {
        var author = $(this).data('author-id');
        var action = $(this).data('action');
        $('#author-books')
            .find('.modal-body')
            .load(action + "?author-id=" + author)
            .closest('#author-books')
            .modal('show');
    })
})