<div class="col p-0 mt-3">
  <span class="text-uppercase">{{ $role }}</span>
  <div class="row align-items-center justify-items-between my-2">
    <div class="col">
      <div class="mb-1">
        <span class="text-uppercase text-grey">
          Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $name }}
        </span>
      </div>
      <span class="text-uppercase text-grey">
        Jurusan/Program Studi&nbsp;&nbsp;&nbsp; : {{ $major }}
      </span>
    </div>

    <x-buttons.outlined-button label="show profile" style="max-height: 3em" data-toggle="modal"
      data-target="#show-{{ $id }}"/>
  </div>
</div>