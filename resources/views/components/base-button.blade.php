<button type="{{ isset($type) ? $type : 'button'}}"  class="btn btn-{{$btntype}} waves-effect waves-float waves-light">
    {{$slot}}
</button> 