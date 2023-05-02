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
          <span class="text-uppercase" style="letter-spacing: .17em">proposal</span>
        </div>

        <div class="col d-flex flex-column justify-content-center border-dash rounded mt-4 mb-2">
          <input type="file" class="@error('proposal') is-invalid @enderror" name="proposal" id="proposal">
        </div>

        @error('proposal')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
        @enderror

        <small>
          <span style="color: #aaa">
            <span style="color: #EC167F">*</span> .pdf, max 10MB
          </span>
        </small>
      </div>
    </div>

    <div class="row justify-content-end mt-5 p-3">
      @if($competition['program_team']['proposal'] == null)
      <x-buttons.outlined-button label="save permanently" />
      @else
      <x-buttons.outlined-button label="save permanently" disabled />
      @endif
    </div>
  </div>
</form>

@push('scripts')
<script>
  const proposal = document.querySelector('#proposal')
  const proposalPond = FilePond.create(proposal)

  proposalPond.setOptions({
    server : {
      url : '{{ route("apiStoreBPCProposal") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP PDF FILE'
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
