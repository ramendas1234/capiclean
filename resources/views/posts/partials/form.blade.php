
<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control"
        value="{{ old('title', $post->title ?? null) }}"/>
</div>
@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label>Content</label>
    {{-- <input type="text" name="content" class="form-control"
        value="{{ old('content', $post->content ?? null) }}"/> --}}
    <textarea rows="10" type="text" name="content" class="form-control">{{ old('content', $post->content ?? null) }}</textarea>    
</div>
@error('content')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

{{-- @if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}