<div class="mb-2 mt-2">
    @auth
        <form method="post" action="{{ $route }}">
            @csrf
            <div class="form-group">
            <label for="exampleFormControlTextarea1">Leave your comment</label>
            <textarea class="form-control" name="content" rows="3"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Add Comment</button>
            </div>
        </form>
    @else
        <a href="{{ route('login') }}">Sign-in</a> to post comments!
    @endauth
    </div>
    <hr/>
<x-alert/>