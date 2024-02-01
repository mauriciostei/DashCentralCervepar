@props([
    'type' => 'text',
    'label' => '',
    'placeholder' => ''
])

<div class="mb-4">
    <label class="form-label">{{$label}}</label>
    <input type="{{$type}}" class="form-control" placeholder="{{$placeholder}}" {{$attributes}}>
</div>