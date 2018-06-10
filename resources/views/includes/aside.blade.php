<aside class="col-md-4">
    <div class="widget search">
        <form action="/search/" method="GET" role="form">
            <input type="text" name="s" value="{{Request::query('s')}}" class="form-control search_box" autocomplete="off"
                   placeholder="Search Here">
        </form>
    </div><!--/.search-->
    <div class="widget categories">
        <h3>Recent Posts</h3>
        <div class="row">
            <div class="col-sm-12">
                <div class="single_comments">
                    <img src="{{URL::to('img/avatar3.png')}}" alt=""/>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                    <div class="entry-meta small muted">
                        <span>By <a href="#">Alex</a></span> <span>On <a href="#">Creative</a></span>
                    </div>
                </div>
                <div class="single_comments">
                    <img src="{{URL::to('img/avatar3.png')}}" alt=""/>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                    <div class="entry-meta small muted">
                        <span>By <a href="#">Alex</a></span> <span>On <a href="#">Creative</a></span>
                    </div>
                </div>
                <div class="single_comments">
                    <img src="{{URL::to('img/avatar3.png')}}" alt=""/>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                    <div class="entry-meta small muted">
                        <span>By <a href="#">Alex</a></span> <span>On <a href="#">Creative</a></span>
                    </div>
                </div>

            </div>
        </div>
    </div><!--/.recent comments-->
    <div class="widget categories">
        <h3>Categories</h3>
        <div class="row">
            <div class="col-sm-6">
                <ul class="blog_category">

                    <li><a href="{{route('navigate',['type'=>'libraries'])}}">ለቤተ መጻሕፍትዎ<span
                                    class="badge">{{$asideCategories[0]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'others'])}}">ልዩ ልዩ <span
                                    class="badge">{{$asideCategories[1]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'devotional'])}}">ከመንፈሳዊዉ ዓለም<span
                                    class="badge">{{$asideCategories[2]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'conservative'])}}">ወግ <span
                                    class="badge">{{$asideCategories[3]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'journey'])}}">የጉዞ ማስታወሻ <span
                                    class="badge">{{$asideCategories[4]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'paper'])}}">ጥናታዊ ጽሑፎች <span
                                    class="badge">{{$asideCategories[5]}}</span></a></li>


                </ul>
            </div>
        </div>
    </div><!--/.categories-->

    <h4>Archive</h4>

    @foreach($asideArchives as $year => $months)
        <div>
            <div id="heading_{{ $loop->index }}">
                <h6 class="mb-0">
                    <span class="btn btn-danger btn-link py-0 my-0" data-toggle="collapse"
                            data-target="#collapse_{{ $loop->index }}"
                            aria-expanded="true"
                            aria-controls="collapse_{{ $loop->index }}">
                       <span>»</span> <span>{{$year}}</span>
                    </button>

                </h6>
            </div>

            <div id="collapse_{{ $loop->index }}" class="collapse" aria-labelledby="heading_{{ $loop->index }}"
                 data-parent="#accordion">
                <div>
                    <ul style="list-style-type: none;">
                        @foreach($months as $month => $posts)
                            <li class="">
                                {{ $month }} ( {{ count($posts) }} )
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</aside>