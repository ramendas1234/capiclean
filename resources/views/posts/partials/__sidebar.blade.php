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