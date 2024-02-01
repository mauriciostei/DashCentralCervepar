<div class="toast-container position-absolute bottom-0 end-0 mb-3 me-3">
    @if(Session::has('toast') || Session::has('error'))
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success-subtle">
            <strong class="me-auto">Mensaje del sistema</strong>
            <small class="text-body-secondary"> {{ date('Y-m-d H:i:s') }} </small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{Session::get('toast')}}
        </div>
        </div>
    @endif
</div>