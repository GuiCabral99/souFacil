<div>
  <h1>Dashboard</h1>
  @if(Auth::check())
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            Logout
        </button>
    </form>
@endif
</div>