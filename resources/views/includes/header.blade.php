<header>
    <nav class="navbar navbar-inverse" role="banner">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('blogs')}}">BLOG</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li><a href="{{route('navigate',['type'=>'libraries'])}}">ለቤተ መጻሕፍትዎ</a></li>
                    <li><a href="{{route('navigate',['type'=>'others'])}}">ልዩ ልዩ</a></li>
                    <li><a href="{{route('navigate',['type'=>'devotional'])}}">ከመንፈሳዊዉ ዓለም</a></li>
                    <li><a href="{{route('navigate',['type'=>'conservative'])}}">ወግ</a></li>
                    <li><a href="{{route('navigate',['type'=>'journey'])}}">የጉዞ ማስታወሻ</a></li>
                    <li><a href="{{route('navigate',['type'=>'paper'])}}">ጥናታዊ ጽሑፎች</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::check())
                                <li><a href="{{route('account')}}"> Profile</a></li>
                                <li><a href="{{route('logout')}}"> Logout</a></li>
                            @else
                                <li><a href="{{route('login')}}"> Sign In</a></li>
                                <li><a href="{{route('login')}}"> Sign Up</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

</header>
