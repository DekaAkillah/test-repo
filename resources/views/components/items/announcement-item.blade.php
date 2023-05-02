<div class="d-flex flex-column p-2">
    <div class="d-flex align-items-center">
        <i class="far fa-bell" style="color:#EC167F"></i>
        <span class="text-uppercase font-weight-bold ml-2">
            {{ $title }}
        </span>
    </div>
    <span class="my-2" style="line-height: normal;">
        {{ $message }}
    </span>
    <div class="d-flex justify-content-end">
        <small class="text-muted"> {{ $datetime }} </small>
    </div>

    <div class="border border-solid border-dark"></div>
</div>