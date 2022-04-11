<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">CD-ProJekT-UTM</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/">About</a></li>

            <li><a href="{{route('task-index')}}">Practice</a></li>

        </ul>
        <ul class="nav navbar-nav " style="float: right; margin-right: 50px">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="user" data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">@if(is_null(Auth::user()))
                        Guest
                    @else
                        {{Auth::user()->name}}
                    @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="user">
                    <ul>


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
                                                            this.closest('form').submit();">
                                        <p>  {{ __('Logout') }}</p>
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
                </div>
            </li>
        </ul>
    </div>
</nav>

