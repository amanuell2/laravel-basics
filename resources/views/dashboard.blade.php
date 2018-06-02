@extends ('layouts.master')
@section('content')
    @include('includes.message-blog')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="{{URL::to('js/tinymce/js/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <section class="row new-post">
        <div class="col-md-12 col-md-offset-0">
            <header>
                <h3> What do You Want To say</h3>
                <form action="{{route('post.create')}}" method="post" class="form-group">
                    <div class="form-group">
                        <textarea name="body" id="new-post" class="form-control"></textarea>
                        <div class="form-group">
                            <label for="categories"> Categories</label>
                            <select id="categories" name="categories">
                                <option value="1">ለቤተ መጻሕፍትዎ</option>
                                <option value="2">ልዩ ልዩ</option>
                                <option value="3">ከመንፈሳዊዉ ዓለም</option>
                                <option value="4">ወግ</option>
                                <option value="5">የጉዞ ማስታወሻ</option>
                                <option value="6">ጥናታዊ ጽሑፎች</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Create Post</button>
                    <input type="hidden" value="{{Session::token()}}" name="_token">
                </form>
            </header>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3> What Other people say ...</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                    <p>{!!$post->body!!}</p>
                    <div class="info">
                        posted by {{$post->user->first_name}} on {{$post->created_at}}
                    </div>
                    <div class="interaction">
                        <a href="#"
                           class="likeblog">{{Auth::User()->likes()->where('post_id',$post->id)->first()? Auth::User()->likes()->where('post_id',$post->id)->first()->like ==1 ? 'You like this post': 'Like':'Like'}}</a>
                        |
                        <a href="#"
                           class="likeblog">{{Auth::User()->likes()->where('post_id',$post->id)->first()? Auth::User()->likes()->where('post_id',$post->id)->first()->like ==0 ? 'You don\'t like this post': 'DisLike':'DisLike'}}</a>
                        @if(Auth::user() == $post->user)
                            |
                            <a href="#" class="edit">Edit</a> |
                            <a href="{{route('post.delete', ['post_id'=>$post->id])}}">Delete</a>
                        @endif
                    </div>

                </article>
            @endforeach
        </div>
    </section>
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
                            <label for="post-body"> Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save-modal" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- TinyMCE init -->
    {{--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}

    <script>
        var route_prefix = "{{ url(config('lfm.prefix')) }}";
        var token = '{{Session::token()}}';
        var urlEdit = '{{route('edit')}}';
        var urlLike = '{{route('like')}}';
        var editor_config = {
            path_absolute: "",
            selector: "textarea[name=body]",
            plugins: [
                "link image"
            ],
            relative_urls: false,
            height: 329,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>

@endsection
