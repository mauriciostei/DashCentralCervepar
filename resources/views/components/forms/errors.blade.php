<ul class="list-group mb-3">
    @foreach($errors->all() as $error)
        <li class="list-group-item text-muted"> {{$error}} </li>
    @endforeach
</ul>