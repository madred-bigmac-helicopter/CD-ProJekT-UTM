<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">CD-ProJekT-UTM</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/">General</a></li>

            <li><a href="{{route('task-index')}}">Practice</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right" style="float: right; margin-right: 50px">


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">@if(is_null(Auth::user()))
                        Guest
                    @else
                        {{Auth::user()->name}}
                    @endif <span class="caret"></span></a>

                <ul class="dropdown-menu">

                    @if(Auth::check())

                        @if(Auth::user()->hasAnyRole(['admin','editor']))
                            <li>
                                <a class="dropdown-item" href="{{route('task.index')}}" style="">Admin</a>
                            </li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')"
                                   class="dropdown-item"
                                   onclick="event.preventDefault();
                                                            this.closest('form').submit();"
                                   style=" display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;">
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </li>
                    @else
                        <li>
                            <a class="dropdown-item" href="/login">Login</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/register">Register</a>
                        </li>
                    @endif

                </ul>
            </li>
        </ul>
    </div>
</nav>

