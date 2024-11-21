<form action="{{ route('user.submit') }}" method="POST">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <button type="submit">Submit</button>
</form>
