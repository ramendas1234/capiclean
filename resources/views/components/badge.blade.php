@if (!isset($show) || $show)
    <strong class="alert alert-{{ $type ?? success }}">{{ $message }}</strong>    
@endif
