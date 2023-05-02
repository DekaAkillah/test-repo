@extends('layouts.master')

@section('content')

@if(auth()->user()->is_complete == 0)
<x-modals.warning-modal title="Hey, maaf sebelumnya"
  message="Kamu baru bisa membuat/gabung tim setelah profile kamu lengkap ya!" primaryLabel="Lengkapin Profile"
  primaryAction="/dashboard/edit-profile?competition={{ $program->slug }}" secondaryAction="history.back()" />
@endif

<section>
  <div class="container-sm border border-dark rounded py-3 px-4" style="width: 60%">
    <div class="row justify-content-center">
      <span class="h4 text-white">Create Team</span>
    </div>

    <form action="{{ route('competition.store-team', $program->slug) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="d-flex align-items-center my-4">
        <div class="mr-3" style="width: 20%">
          <input type="file" class="filepond" name="logo" accept="image/png, image/jpeg" />
        </div>
        {{-- <img class=" img-fluid rounded-circle mr-3" style="width: 20%"
          src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/822e6a3e-aa59-423a-b62a-6b48776c3218/d9n9s7c-829f616b-09bf-4a8e-b614-9a118193a899.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzgyMmU2YTNlLWFhNTktNDIzYS1iNjJhLTZiNDg3NzZjMzIxOFwvZDluOXM3Yy04MjlmNjE2Yi0wOWJmLTRhOGUtYjYxNC05YTExODE5M2E4OTkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.BngEaYYNnh8CCThLqJ1QCf04wfNWGM8aRGdFT7qYQ8k"
          alt="avatar"> --}}

        <x-inputs.stroke-input placeholder="Enter a cool team name" name="name" value="{{ old('name') }}" />
        @error('name')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="row px-3 my-4">
        <div class="col p-0 mr-2">
          <div class="form-group mb-4">
            <label for="">Team Leader Institution</label>
            <x-inputs.outlined-input name="institution" value="{{ auth()->user()->institution }}" readonly />
          </div>
          <div class="form-group">
            <label for="">Team Leader Major</label>
            <x-inputs.outlined-input name="major" value="{{ auth()->user()->class_major }}" readonly />
          </div>
        </div>

        <div class="col p-0 ml-2">
          <div class="form-group">
            <label for="">Team Code</label>
            <x-inputs.outlined-input class="code" placeholder="Team unique code" name="code" value="{{ old('code') }}"
              maxlength="6" />
            <small class="text-muted">Help other member identify their team</small>
            @error('code')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end">
        <x-buttons.text-button type="button" label="join existing team"
          onclick="location.href = '{{ route('competition.join-team', $program->slug) }}'" />
        <x-buttons.outlined-button type="submit" label="setup team" />
      </div>
    </form>
  </div>
</section>
@endsection

@push('scripts')
<script>
  $(window).on('load', function() {
        $('#warningModal').modal('show');
    });
</script>
<script>
  FilePond.registerPlugin(
    FilePondPluginFileEncode,
    FilePondPluginFileValidateType,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview,
    FilePondPluginImageCrop,
    FilePondPluginImageResize,
    FilePondPluginImageTransform
  );

  FilePond.create(
    document.querySelector('.filepond'),
    {
      labelIdle: `Drop your avatar or <span class="filepond--label-action">Browse</span>`,
      imagePreviewHeight: 128,
      imageCropAspectRatio: '1:1',
      imageResizeTargetWidth: 128,
      imageResizeTargetHeight: 128,
      stylePanelLayout: 'compact circle',
      styleLoadIndicatorPosition: 'center bottom',
      styleButtonRemoveItemPosition: 'center bottom'
    }
  );

  FilePond.setOptions({
    server : {
      url : '{{ route("apiStoreLogo") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    }
  })

</script>

<script src="{{ asset('js/custom/simple-notify.min.js') }}"></script>
<script src="{{ asset('js/custom/toast.js') }}"></script>
<script>
  const checkSession = '{{ Session::has("success") ? "success" : (Session::has("error") ? "error" : "") }}';

  if(checkSession === 'success'){
    successToast('{{ Session::get("success") }}')
  }

  if(checkSession === 'error'){
    errorToast('{{ Session::get("error") }}')
  }

</script>
@endpush