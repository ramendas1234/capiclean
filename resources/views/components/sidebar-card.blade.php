
<div class="card mt-3" style="width: 18rem;">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>

        @switch($type)
            @case('post')
                
                    <ul class="list-group list-group-flush">
                        
                        @foreach ($items as $item)
                        <li class="list-group-item">
                            <h6 class="card-subtitle mb-3 text-muted">
                            <a href="{{ route('posts.show', ['post'=> $item->id]) }}" class="card-link">{{ $item->title }}</a>
                            </h6>
                        </li>
                        @endforeach
                    </ul>

                @break
            
                
            @case('user')

                    <ul class="list-group list-group-flush">
                        
                        @foreach ($items as $item)
            
                        <li class="list-group-item">
                            <h6 class="card-subtitle mb-3 text-muted">
                                {{ $item->name }}
                            </h6>
                        </li>
            
                        @endforeach
                    </ul>
            
                @break    
        
            @default
                
        @endswitch
        



    </div>
</div>
