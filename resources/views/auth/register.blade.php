@extends("layouts.guest")
@section("content")
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="user-box">
                <input type="text" name="name" required autocomplete="off">
                <label>Nick Name</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required autocomplete="off">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="user-box">
                <input type="password" name="repeat-password" required>
                <label>Repeat Password</label>
            </div>

            <button style="background: linear-gradient(#141e30, #243b55)" type="submit" >
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </button>

        </form>

    </div>
@endsection

