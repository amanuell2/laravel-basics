@extends ('layouts.master')
@section('content')
    @include('includes.message-blog')
    <script src="{{URL::to('js/tinymce/js/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <section id="blog" class="container">
        <div class="blog">
            <div class="row">
                <div class="col-md-8">
                    @foreach($posts as $post)
                        <div class="blog-item" data-postid="{{$post->id}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div id="controller" class="entry-meta">
                                        <span id="publish_date">{{$post->created_at}}</span>
                                        <span><i class="fa fa-user"></i> <a
                                                    href="#">By {{$post->user->first_name}}</a></span>
                                        <div class="interaction entry-meta">
                                        <span>
                                                <i class="fa fa-thumbs-up"></i>
                                                <a href="#" class="like">
                                                    @if(Auth::check())
                                                        {{ Auth::User()->likes()->where('post_id',$post->id)->first()?
                                                         Auth::User()->likes()->where('post_id',$post->id)->first()->like ==1 ?
                                                        'You like this post': 'Like':'Like'}}
                                                    @else
                                                        Like
                                                    @endif

                                                </a>
                                                                                    </span>
                                            <span><i class="fa fa-thumbs-down"></i>
                                            <a href="#" class="like">
                                                 @if(Auth::check())
                                                    {{ Auth::User()->likes()->where('post_id',$post->id)->first()?
                                                       Auth::User()->likes()->where('post_id',$post->id)->first()->like ==0 ?
                                                     'You don\'t like this post': 'DisLike':'DisLike'}}
                                                @else
                                                    DisLike
                                                @endif

                                            </a>
                                            </span>
                                        </div>
                                        <span class="comments"> </span>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    {{--<a href="#"><img class="img-responsive img-blog" src="images/blog/blog1.jpg"--}}
                                    {{--width="100%" alt=""/></a>--}}

                                    <p>{!!$post->body!!}</p>
                                </div>
                            </div>
                        </div><!--/.blog-item-->
                    @endforeach
                    @foreach($comments as $comment)
                        <div class="media comment_section" data-comment_id="{{$comment->id}}">
                            @if(Storage::disk('local')->has($comment->user_id. '.jpg'))
                                <div class="pull-left post_comments">

                                    <a href="#"><img style="border-radius: 50px"
                                                     src="{{ route('account.image', ['filename'=>$comment->user_id. '.jpg']) }}"
                                                     alt=""
                                                     class="img-responsive"></a>
                                </div>
                            @endif
                            <div class="media-body post_reply_comments">
                                <h3>{{$comment->user->first_name}}</h3>
                                <h4>{{$comment->created_at}}</h4>
                                <p>{{$comment->comment}}</p>
                                <div class="media-body post_reply_comments">

                                    <div class="interaction pull-left">

                                        @if(Auth::user() == $comment->user)
                                            <button type="submit" id="editComment"
                                                    class="btn btn-primary btn-lg editComment">Edit
                                            </button>
                                            <button type="submit" id="deleteCommentBtn"
                                                    class="btn btn-primary btn-lg deleteCommentBtn">
                                                Delete
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(Auth::check())
                        <div class="media comment_section">
                            <div class="pull-left post_comments">
                                <a href="#"><img style="border-radius: 50px"
                                                 src="{{ route('account.image', ['filename'=>$user->id.'.jpg']) }}"
                                                 class="img-circle" alt=""></a>
                            </div>
                            <div class="media-body post_reply_comments">
                                <form action="">
                            <textarea class="form-control input-sm " name="comment-body" id="comment-body"
                                      style="margin-bottom: 30px;" required
                                      placeholder=" comment what you feel"> </textarea>
                                    <a id="commentBtn" href="#">Comment</a>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div id="contact-page clearfix">
                        <div class="status alert alert-success" style="display: none"></div>
                        <div class="message_heading">
                            <h4>Send a Replay by Email</h4>
                            <p>Make sure you enter the(*)required information where indicate.HTML code is not
                                allowed</p>
                        </div>

                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post"
                              action="sendemail.php" role="form">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="name">Name * </label>
                                        <input type="text" name="name" class="form-control" required="required">

                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email * </label>
                                        <input type="email" name="email" class="form-control" required="required">

                                    </div>
                                    <div class="form-group">
                                        <label for="url">URL </label>
                                        <input name="url" type="url" class="form-control">

                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label>Message *
                                            <textarea name="message" id="message" required="required"
                                                      class="form-control" cols="40" rows="8"></textarea>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg">Submit Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--/.col-md-8-->
                @include('includes.aside')
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form class="modal-body">
                        <div class="form-group">
                            <label for="post-body"> Edit the Comment</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save-comment-modal" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var token = '{{Session::token()}}';
        var urlLike = '{{route('like')}}';
        var urlComment = '{{route('comment')}}';
        var editComment = '{{route('edit.comment')}}';
        var deleteComment = '{{route('delete.comment')}}';
        var urlReply = '{{route('post.reply')}}';
        var getReply = '{{route('post.get.reply')}}';
        var getComments = '{{route('readmore.get.comments')}}';

    </script>
@endsection
