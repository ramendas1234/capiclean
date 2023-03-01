@extends('layout.app')


@section('title', 'posts')
@section('content')

<div class="row">
    <div class="col-md-8">
        <h2>All Posts</h2>


        @forelse ($posts as $post)
            <div class="mb-3">

                <h3>
                    @if ($post->trashed())
                        <del>
                    @endif
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post['title'] }}</a>
                    @if ($post->trashed())
                        </del>
                    @endif
                </h3>
                
                <p class="text-muted">
                    Added {{ $post->created_at->diffForHumans() }}
                    by <strong> {{ $post->user->name }} </strong>
                </p>
                <p>{{ $post['content'] }}</p>
                @if ($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
                @else
                <p>0 comments</p>
                @endif
                
                @can('update', $post)
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>    
                @endcan
                
                @can('delete', $post)
                    <form method="POST" class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete!" class="btn btn-primary"/>
                    </form>
                @endcan

                @can('restore', $post)
                    <form method="POST" class="d-inline" action=" {{ route('posts.restore', ['id' => $post->id ]) }} ">
                        @csrf
                        <input type="submit" value="Restore" class="btn btn-primary"/>
                    </form>
                @endcan
                
                
            </div>
        @empty
        <p class="alert alert-danger">Sorry no posts found.</p>
        @endforelse

    </div>
    <div class="col-md-4">
            {{-- <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h4 class="card-title">Most Commented Post</h4>
                <ul class="list-group list-group-flush">
                    @foreach ($mostCommentPosts as $post)
                    <li class="list-group-item">
                        <h6 class="card-subtitle mb-3 text-muted">
                        <a href="{{ route('posts.show', ['post'=> $post->id]) }}" class="card-link">{{ $post->title }}</a>
                        </h6>
                    </li>
                    @endforeach
                </ul>
                
                
                
                </div>
            </div> --}}
<?php  
$test_array = ['Rohit', 'Shamm', 'Dinu'];
?>
           
            <x-sidebarCard title="Most Commented Post" :items="$mostCommentPosts" type="post" />


            {{-- <div class="card mt-3" style="width: 18rem;">
                <div class="card-body">
                <h4 class="card-title">Most Active User</h4>
                <ul class="list-group list-group-flush">
                    @foreach ($mostActiveUsers as $user)
                    <li class="list-group-item">
                        <h6 class="card-subtitle mb-3 text-muted">
                            {{ $user->name }}
                        </h6>
                    </li>
                    @endforeach
                </ul>
                
                
                
                </div>
            </div> --}}
            
            <x-sidebarCard title="Most Active User" :items="$mostActiveUsers" type="user" />
            <x-sidebarCard title="Recent Active User" :items="$mostActiveLastMonth" type="user" />

    </div>

</div>



@endsection