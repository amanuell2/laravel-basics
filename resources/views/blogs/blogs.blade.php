@extends ('layouts.master')
@section('content')
    @include('includes.message-blog')
    <script src="{{URL::to('js/tinymce/js/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <div class="col-md-12 header-section">
        <div class="col-md-12 col-md-offset-1">
            <header class="banner-container">
                <div class="col-md-2">
                    <img class="img-responsive" src="{{URL::to('img/banner.png')}}"/>
                </div>
                <div class="col-lg-offset-3 description">
                    <h2>የዳንኤል ክብረት እይታዎች </h2>
                    <h2>Daniel Kibret's Views</h2>
                    <P>ስለ ኢትዮጵያ ታሪክ፤ ባህል፤ እምነት፤ ፖለቲካ እና ትውፊት ምልከታዎች ይቀርቡበታል</P>
                    <p>Reflection on Ethiopian’s History, Culture, Religion, Politics and Tradition</p>
                </div>

            </header>
        </div>

    </div>
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

                                               <span> <i class="fa fa-thumbs-up"> </i>
                                                <a href="#" class="like">
                                                    @if(Auth::check())
                                                        {{Auth::User()->likes()->where('post_id',$post->id)->first()?
                                                         Auth::User()->likes()->where('post_id',$post->id)->first()->like ==1 ?
                                                          'You like this post': 'Like':'Like'}}
                                                    @else
                                                        Like
                                                    @endif

                                                </a></span>


                                            <span><i class="fa fa-thumbs-down"></i>
                                            <a href="#" class="like">
                                                   @if(Auth::check())
                                                    {{Auth::User()->likes()->where('post_id',$post->id)->first()?
                                                    Auth::User()->likes()->where('post_id',$post->id)->first()->like ==0 ?
                                                    'You don\'t like this post': 'DisLike':'DisLike'}}
                                                @else
                                                    DisLike
                                                @endif

                                            </a> </span>

                                        </div>

                                        <span class="comments"> </span>

                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    {{--<a href="#"><img class="img-responsive img-blog" src="{{URL::to('img/sample.jpg')}}"--}}
                                    {{--width="100%" alt=""/></a>--}}

                                    <p>{!!str_limit($post->body,500);!!}</p>
                                    <a class="btn btn-primary readmore"
                                       href="{{route('blog.readmore', ['post_id'=>$post->id])}}">Read More <i
                                                class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!--/.blog-item-->
                    @endforeach
                    <ul class="pagination pagination-lg">

                        <li>{{$posts->links()}}</li>

                    </ul><!--/.pagination-->
                </div><!--/.col-md-8-->
                @include('includes.aside')
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

    <script>
        var token = '{{Session::token()}}';
        var urlEdit = '{{route('edit')}}';
        var urlLike = '{{route('like')}}';
        var getComments = '{{route('get.comments')}}';

    </script>
@endsection
