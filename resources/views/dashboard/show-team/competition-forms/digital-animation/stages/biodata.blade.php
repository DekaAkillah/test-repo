@php
$checkFile = $competition['program_team']['file_stage_1'] != null;
$checkResultLink = $competition['program_team']['result_link']
!= null;
$checkReport = $competition['program_team']['report'] != null;

$hasSubmitted = $checkFile and $checkResultLink and $checkReport;
@endphp

<span class="font-weight-bold text-capitalize">biodata peserta</span>
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/simple-notify.min.css') }}" type="text/css">
@endpush
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

      @if ($hasSubmitted)

      <x-cards.submitted-card class="my-2" message="berkas persyaratan telah disubmit" />

      @else

      <div class="col d-flex flex-column justify-content-center border-dash rounded my-2 p-0">
        <input type="file" accept=".zip, .rar" name="file_stage_1" id="file_stage_1">
      </div>

      @error('file_stage_1')
      <div class="invalid-feedback d-block">
        {{ $message }}
      </div>
      @enderror

      @endif

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
          <li>
            Format penamaan rar/zip : <br>
            Animasi Digital INSPACE 2022_Nama Tim_Asal Instansi/Universitas.rar/zip
          </li>
        </ul>
        <span class="text-grey">
          <span style="color: #EC167F">*</span> .zip/rar, max 10MB
        </span>
      </small>

    </div>

    <div class="col pr-0 pl-2">
      <div class="">
        <span class="text-uppercase" style="letter-spacing: .17em">laporan</span>
      </div>

      @if ($hasSubmitted)

      <x-cards.submitted-card class="my-2" message="berkas laporan telah disubmit" />

      @else

      <div class="col d-flex flex-column justify-content-center border-dash rounded my-2 p-0">
        <input type="file" name="report" id="report" accept=".rar, .zip">
      </div>
      @endif

      @error('report')
      <div class="invalid-feedback d-block">
        {{ $message }}
      </div>
      @enderror

      <small>
        File yang harus ada di folder:
        <ul class="px-3">
          <li>
            Surat orisinalitas karya : <br>
            Surat Pernyataan Orisinalitas Karya_Animasi Digital_Nama Tim_Asal Universitas/Instansi.pdf
            <a href="https://bit.ly/OrisinalitasKaryaAnimasiDigitalINSPACE2022" target="_blank"
              rel="noopener noreferrer" style="color: #893ff8">
              [download]
            </a>
          </li>
          <li>
            Laporan : <br>
            Laporan_Animasi Digital_Nama Tim_Asal Universitas/Instansi.pdf
          </li>
          <li>
            Format Penamaan rar/zip : <br>
            LSPOK_Animasi Digital_Nama Tim_Asal Universitas/Instansi
          </li>
        </ul>
        <span class="text-grey">
          <span style="color: #EC167F">*</span> .zip/rar, max 10MB
        </span>
      </small>

    </div>
  </div>

  <div class="col col-md-8 my-5 p-0">
    <label for="">Link Video</label>

    @if ($hasSubmitted)

    <x-inputs.outlined-input placeholder="{{ $competition['program_team']['result_link'] }}" readonly />

    @else

    <x-inputs.outlined-input placeholder="youtube/gdrive" name="result_link" />
    <small>
      <span class="text-grey">
        <span style="color: #EC167F">*</span> Pastikan linknya dapat diakses siapa saja
      </span>
    </small>

    @endif

  </div>

  <div class="row justify-content-end">

    @if($hasSubmitted)
    <x-buttons.outlined-button type="submit" label="save permanently" disabled />
    @else
    <x-buttons.outlined-button type="submit" label="save permanently"/>
    @endif

  </div>
</form>

@push('scripts')
<script>
  const docsInput = document.querySelector('input[id="file_stage_1"]')
  const docsPond = FilePond.create(docsInput)
  
  docsPond.setOptions({
    server : {
      url : '{{ route("apiStoreDigitalAnimationFileStageOne") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP BERKAS PERSYARATAN HERE'
  })

  const reportInput = document.querySelector('input[id="report"]')
  const reportPond = FilePond.create(reportInput)
  
  reportPond.setOptions({
    server : {
      url : '{{ route("apiStoreDigitalAnimationReport") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP LAPORAN HERE'
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