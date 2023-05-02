  @push('styles')
  <link rel="stylesheet" href="{{ asset('css/custom/simple-notify.min.css') }}" type="text/css">
  @endpush

  <span class="font-weight-bold text-capitalize">biodata peserta</span>
  <div class="col p-0 mt-1">
  
    <x-items.member-item-large id="{{ $competition['team']['leader_id'] }}"
      name="{{ $competition['team']['leader_name'] }}" major="{{ $competition['team']['leader_class_major'] }}"
      role="ketua" institution="{{ $competition['team']['leader_institution'] }}" />
    <x-modals.show-profile-modal id="{{ $competition['team']['leader_id'] }}"
      name="{{ $competition['team']['leader_name'] }}" major="{{ $competition['team']['leader_class_major'] }}"
      avatar="{{ $competition['team']['leader_avatar'] }}"
      institution="{{ $competition['team']['leader_institution'] }}" />
  
    @foreach($competition['team']['member_account'] as $member_account)
    <x-items.member-item-large id="{{ $member_account->user->id }}" name="{{ $member_account->user->name }}"
      major="{{ $member_account->user->class_major }}" role="anggota {{ $loop->iteration }}"
      institution="{{ $member_account->user->institution }}" />
  
    <x-modals.show-profile-modal id="{{ $member_account->user->id }}" name="{{ $member_account->user->name }}"
      major="{{ $member_account->user->class_major }}" avatar="{{ $member_account->user->avatar }}"
      institution="{{ $member_account->user->institution }}" />
  
    @endforeach
  
  
  </div>

  <form action="{{ route('dashboard.stage-one', [
    'competitionSlug' => $competition['slug'],
    'team_code' => $competition['team']['code']
  ]) }}" method="post">
  @csrf 
  <div class="row mt-5">
  
    <div class="col">
      <div class="">
        <span class="text-uppercase" style="letter-spacing: .17em">berkas persyaratan</span>
      </div>
  
      <div class="col d-flex flex-column justify-content-center border-dash rounded my-2 p-0">
        <input type="file" name="file_stage_1" id="file_stage_1" accept=".rar, .zip">
      </div>
  
      <small>
        File yang harus ada di folder:
        <ul class="px-3">
          <li>
            Scan KTM Semua Anggota : <br>
            KTM_Nama Ketua/Anggota 1,2,3_Asal Instansi/Universitas.pdf
          </li>
          <li>
            Bukti follow akun instagram @inspace_itk: <br>
            Follow Inspace_Nama Ketua/Anggota 1,2,3_Asal Instansi/Universitas.jpg/png
          </li>
          <li>
            Bukti follow akun instagram @hmsi_itk : <br>
            Follow HMSI_Nama Ketua/Anggota 1,2,3_Asal Instansi/Universitas.jpg/png
          </li>
          <li>
            SS bukti up twibbon : <br>
            Twibbon_Nama Ketua/Anggota 1,2,3_Asal Instansi/Universitas.jpg/png
            <a href="https://bit.ly/TemplateTwibbonINSPACE2022" target="_blank" rel="noopener noreferrer"
              style="color: #893ff8">
              [download]
            </a>
          </li>
        </ul>
        <span class="text-grey">
          <span style="color: #EC167F">*</span> .zip/rar, max 10MB
        </span>
      </small>
    </div>
  
    <div class="col pr-0 pl-2">
      <div class="">
        <span class="text-uppercase" style="letter-spacing: .17em">proposal</span>
      </div>
  
      <div class="col d-flex flex-column justify-content-center border-dash rounded my-2 p-0">
        <input type="file" name="proposal" id="proposal">
      </div>
  
      <small>
        File yang harus ada di folder:
        <ul class="px-3">
          Surat orisinalitas karya
            <a href="https://bit.ly/LembarOrisinalitasUIUX" target="_blank" rel="noopener noreferrer"
              style="color: #893ff8">
              [download]
            </a>
          <li>Proposal : proposal.pdf</li>
          <li>
            Format penamaan rar/zip : <br>
            Nama Tim_Nama Instansi
          </li>
        </ul>
        <span class="text-grey">
          <span style="color: #EC167F">*</span> .zip/rar, max 10MB
        </span>
      </small>
    </div>
  
  </div>
  
  
  <div class="row mt-5 justify-content-end">
    @if($competition['program_team']['file_stage_1'] == null or $competition['program_team']['proposal'] == null)
      <x-buttons.outlined-button label="save permanently" />
    @else 
      <x-buttons.outlined-button label="save permanently" disabled/>
    @endif
  </div>

</form>


@push('scripts')
<script>
  const fileStageOne = document.querySelector('#file_stage_1')
  const proposal = document.querySelector('#proposal')
  
  const fileStageOnePond = FilePond.create(fileStageOne)
  fileStageOnePond.setOptions({
    server : {
      url : '{{ route("apiStoreUiUxfileStageOne") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP ZIP/RAR FILE'
  })
  
  const proposalPond = FilePond.create(proposal)
  proposalPond.setOptions({
    server : {
      url : '{{ route("apiStoreUiUxProposal") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP ZIP/RAR FILE'
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