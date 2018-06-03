document.addEventListener('DOMContentLoaded', function () {
    var postId = 0;
    var commentId = 0;
    var commentBodyElement = null;
    var postBodyElement = null;
    var show = false;
    var spanLikes = document.querySelectorAll('.comments');
    spanLikes.forEach(function (spanLike) {
        var commentId = spanLike.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
console.log(spanLike.childNodes);
        getComments(commentId, spanLike);
    });


    $('.post').find('.interaction').find('.edit').on('click', function (event) {
        event.preventDefault();
        postBodyElement = event.target.parentNode.parentNode.childNodes[1];
        var postBody = postBodyElement.textContent;
        postId = event.target.parentNode.parentNode.dataset['postid'];
        $('#post-body').val(postBody);
        $('#edit-modal').modal();
    });
    $('#save-modal').on('click', function () {

        $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {body: $('#post-body').val(), postId: postId, _token: token}
        })
            .done(function (msg) {
                $(postBodyElement).text(msg['new_body']);
                $('#edit-modal').modal('hide');

            });
    });
    $('.like').on('click', function (event) {
        event.preventDefault();
        var isLike = event.target.parentElement.previousElementSibling == null ? true : false;

        postId = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['postid'];

        $.ajax({
            method: 'POST',
            url: urlLike,
            data: {isLike: isLike, postId: postId, _token: token}
        })
            .done(function () {
                event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'DisLike' ? 'You don\'t like this post' : 'DisLike';
                if (isLike) {


                    event.target.parentElement.nextElementSibling.lastElementChild.innerText = 'DisLike';
                }
                else {

                    event.target.parentElement.previousElementSibling.lastElementChild.innerText = 'Like';
                }

            });

    });
    $('.likeblog').on('click', function (event) {
        event.preventDefault();
        var isLike = event.target.previousElementSibling == null ? true : false;
        console.log(isLike);
        postId = event.target.parentNode.parentNode.dataset['postid'];
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: {isLike: isLike, postId: postId, _token: token}
        })
            .done(function () {
                event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'DisLike' ? 'You don\'t like this post' : 'DisLike';
                if (isLike) {


                    event.target.nextElementSibling.innerText = 'DisLike';
                }
                else {

                    event.target.previousElementSibling.innerText = 'Like';
                }

            });

    });
    $('#commentBtn').on('click', function (event) {
        event.preventDefault();
        if ($('#comment-body').val() !== '') {
            postId = event.target.parentNode.parentNode.parentNode.parentNode.firstChild.nextSibling.dataset['postid'];

            $.ajax({
                method: 'POST',
                url: urlComment,
                data: {body: $('#comment-body').val(), postId: postId, _token: token}
            })
                .done(function (msg) {
                    location.reload(true);
                });
        }
        else {
            alert('comment is empty');
        }

    });


    $('.editComment').on('click', function (event) {
        event.preventDefault();

        commentId = event.target.parentNode.parentNode.parentNode.dataset['comment_id'];
        commentBodyElement = event.target.parentNode.parentNode.childNodes[5];
        var commentBody = commentBodyElement.textContent;

        $('#post-body').val(commentBody);
        $('#edit-modal').modal();
    });
    $('#save-comment-modal').on('click', function () {

        $.ajax({
            method: 'POST',
            url: editComment,
            data: {body: $('#post-body').val(), postId: commentId, _token: token}
        })
            .done(function (msg) {
                $(commentBodyElement).text(msg['new_body']);
                $('#edit-modal').modal('hide');

            });
    });
    $('.deleteCommentBtn').on('click', function (event) {
        event.preventDefault();
        commentId = event.target.parentNode.parentNode.parentNode.dataset['comment_id'];
        console.log(commentId);
        $.ajax({
            method: 'POST',
            url: deleteComment,
            data: {postId: commentId, _token: token}
        })
            .done(function (msg) {

                location.reload(true);
            });
    });
    const replys = document.querySelectorAll('.reply');
    Array.from(replys, function (reply) {
        reply.addEventListener('click', function (event) {
            event.preventDefault();
            var state = event.target.textContent;
            const replySection = event.target.parentNode.parentNode.childNodes[7];
            commentId = event.target.parentNode.parentNode.parentNode.dataset['comment_id'];
            if (state === 'Show Reply') {
                $.ajax({
                    method: 'POST',
                    url: getReply,
                    data: {commentId: commentId, _token: token}

                })
                    .done(function (msg) {
                        for (var k in msg['replies']) {
                            var data = msg.replies[k];
                        }
                        replySection.style.display = 'block';
                        event.target.textContent = 'Hide Reply';

                    });


            }
            else {
                replySection.style.display = 'none';
                event.target.textContent = 'Show Reply';
            }

        });

    });
    const replyBodys = document.querySelectorAll('.reply-body');
    Array.from(replyBodys, function (replybody) {
        replybody.addEventListener('keypress', function (event) {
            const replyForm = event.target.parentNode;
            const replyValue = replyForm.querySelector('input[type="text"]');
            var key = event.which || event.keyCode;
            postId = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.firstChild.nextSibling.dataset['postid'];
            commentId = event.target.parentNode.parentNode.parentNode.parentNode.dataset['comment_id'];
            if (key === 13) {
                event.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: urlReply,
                    data: {body: replyValue.value, commentId: commentId, postId: postId, _token: token}

                })
                    .done(function (msg) {
                        console.log(postId);
                        location.reload(true);
                        replyValue.value = '';
                    });

            }
        });
    });


});

function getComments(commentId, SpanLike) {

    $.ajax({
        method: 'post',
        url: 'getComments',
        data: {postId: commentId, _token: token}

    }).done(function (msg) {
        const i= document.createElement('i');
        i.classList.add('fa','fa-comment');
        SpanLike.prepend(i);
       SpanLike.append(msg['new_body'] + ' Comments');

    });
}
