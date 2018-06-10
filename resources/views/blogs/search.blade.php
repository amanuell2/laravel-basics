@extends ('layouts.master')
@section('title')
    | Search on {{ $s }}
@endsection

@section('content')
    <section id="blog" class="container">
        <div class="blog-header">
            <h1 class="blog-title">Searching for "{{ $s }}"</h1>
            <p>We've found {{ $posts->count() }} results for your search term in all blog entries</p>
        </div>
        <div class="blog">
            <div class="row">
                <div class="col-sm-8 blog-main">

                    @if( $posts->count() )
                        @foreach( $posts as $post )

                            <div class="blog-item" data-postid="{{$post->id}}">

                                <p class="blog-item">{{ date('M j, Y', strtotime( $post->created_at )) }} by <a
                                            href="#">{{$post->user->first_name}}</a></p>

                                <div class="blog-content">
                                    {{--If post content is > 200 in characters display 200 only or else display the whole content--}}
                                    {!! strlen( $post->body ) > 200 ? substr( $post->body, 0, 200) . ' ...' : $post->body !!}
                                </div>
                                <a class="btn btn-primary readmore"
                                   href="{{route('blog.readmore', ['post_id'=>$post->id])}}">Read More <i
                                            class="fa fa-angle-right"></i></a>
                            </div>

                        @endforeach
                    @else

                        <p>No post martch on your term <strong>{{ $s }}</strong></p>

                    @endif

                    {{-- Display pagination only if more than the required pagination --}}
                    @if( $posts->total() > 6 )
                        <nav>
                            <ul class="pager">
                                @if( $posts->firstItem() > 1 )
                                    <li><a href="{{ $posts->previousPageUrl() }}">Previous</a></li>
                                @endif

                                @if( $posts->lastItem() < $posts->total() )
                                    <li><a href="{{ $posts->nextPageUrl() }}">Next</a></li>
                                @endif
                            </ul>
                        </nav>
                    @endif

                </div>
                @include('includes.aside')
            </div>

        </div>

    </section>
@endsection