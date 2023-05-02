@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/simple-notify.min.css') }}" type="text/css">
@endpush

<form action="{{ route('dashboard.stage-two', [
    'competitionSlug' => $competition['slug'],
    'team_code' => $competition['team']['code']
  ]) }}" method="post">
  @csrf
  <div class="col">
    <div class="row">
      <div class="col-md-6">
        <div class="mb-2">
          <span class="text-uppercase" style="letter-spacing: .17em">berkas final</span>
        </div>

        <div class="col d-flex flex-column justify-content-center border-dash rounded mt-4 mb-2">
          <input type="file" name="presentation" id="presentation">
        </div>

        <small>
          File yang harus ada di folder:
          <ul class="px-3">
            <li>PPT : slide.ppt/pptx</li>
            <li>Link demo : link-demo.txt</li>
          </ul>
          <span style="color: #aaa">
            <span style="color: #EC167F">*</span> .zip/rar, max 10MB
          </span>
        </small>
      </div>
    </div>

    <div class="row justify-content-end mt-5 p-3">
      <x-buttons.outlined-button label="save permanently" />
    </div>
  </div>
</form>


@push('scripts')
<script>
  const presentation = document.querySelector('#presentation')
  const presentationPond = FilePond.create(presentation)

  presentationPond.setOptions({
    server : {
      url : '{{ route("apiStoreUiUxPresentation") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP PPT/PPTX FILE'
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