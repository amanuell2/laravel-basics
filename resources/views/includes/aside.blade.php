<aside class="col-md-4">
    <div class="widget search">
        <form role="form">
            <input type="text" class="form-control search_box" autocomplete="off"
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

                    <li><a href="{{route('navigate',['type'=>'libraries'])}}">ለቤተ መጻሕፍትዎ<span class="badge">{{$asideCategories[0]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'others'])}}">ልዩ ልዩ <span class="badge">{{$asideCategories[1]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'devotional'])}}">ከመንፈሳዊዉ ዓለም<span class="badge">{{$asideCategories[2]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'conservative'])}}">ወግ <span class="badge">{{$asideCategories[3]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'journey'])}}">የጉዞ ማስታወሻ <span class="badge">{{$asideCategories[4]}}</span></a></li>
                    <li><a href="{{route('navigate',['type'=>'paper'])}}">ጥናታዊ ጽሑፎች <span class="badge">{{$asideCategories[5]}}</span></a></li>



                </ul>
            </div>
        </div>
    </div><!--/.categories-->
    <div class="widget archieve">
        <h3>Archieve</h3>
        <div class="row">
            <div class="col-sm-12">
                <ul class="blog_archieve">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2010 <span
                                    class="pull-right">{{$asideArchives[0]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2011 <span
                                    class="pull-right">{{$asideArchives[1]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2012 <span
                                    class="pull-right">{{$asideArchives[2]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2013 <span
                                    class="pull-right">{{$asideArchives[3]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2014 <span
                                    class="pull-right">{{$asideArchives[4]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2015 <span
                                    class="pull-right">{{$asideArchives[5]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2016 <span
                                    class="pull-right">{{$asideArchives[6]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2017 <span
                                    class="pull-right">{{$asideArchives[7]}}</span></a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i>  2018 <span
                                    class="pull-right">{{$asideArchives[8]}}</span></a></li>
                </ul>
            </div>
        </div>
    </div><!--/.archieve-->
</aside>