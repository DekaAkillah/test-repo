<?php 
  switch(strtolower($stage['title'])){
    case 'eliminated':
      $theme = 'danger';
      break;
    case 'technical meeting':
      $theme = 'warning';
      break;
    default:
      $theme = 'dark';
  }
?>

<div class="d-flex flex-column my-3">

  <div class="d-flex justify-content-between mb-2">
    <div class="d-flex align-items-center">
      <img
        src="{{ asset('logo-program') }}/{{ $competition['slug'] }}.webp"
        alt="icon" style="width: 2.5em; height: 2.5em">
      <span class="text-uppercase ml-3" style="font-weight: 900; font-size: 1.5em; letter-spacing: .17em">
        {{ $competition['title'] }}
      </span>
    </div>

    <span class="text-uppercase font-weight-bold text-muted" style="letter-spacing: .17em">
      {{ $competition['is_group'] == 1 ? $team['name'] : 'individu' }}
    </span>
  </div>

  <div class="d-flex justify-content-between py-3">
    <div class="d-flex flex-column pb-0">

      @foreach ($stage['todos'] as $todo)
      <x-miscs.todo-checklist :title="$todo['title']" :isChecked="$todo['isChecked']" />
      @endforeach

    </div>

    <div class="d-flex align-items-end flex-end">
      @php
      $slug = $competition['slug'];
      $code = $team['code'] ?? 'user_id';
      // $code = $team['code'] ?? auth()->user()->id;
      @endphp
      <div class="d-flex">
        <x-miscs.badge label="{{ $stage['title'] }}" :theme="$theme" />
        <x-buttons.outlined-button label="View" onclick="openWindow('{{ $slug }}', '{{ $code }}')" />
      </div>
    </div>
  </div>

  <div class="border border-dark"></div>
</div>

@push('scripts')
<script>
    function openWindow(slug, code){
      window.open(`{{ url('dashboard/${slug}/${code}') }}`)
    }
</script>
@endpush