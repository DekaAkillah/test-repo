@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/simple-notify.min.css') }}" type="text/css">
@endpush

<form action="{{ route('dashboard.stage-one', [
    'competitionSlug' => $competition['slug'],
    'team_code' => $competition['team']['code']
  ]) }}" method="post">
  @csrf 
  
  <div class="col">
    <div class="row">
      <div class="col-md-6">
        <div class="mb-2">
          <span class="text-uppercase" style="letter-spacing: .17em">berkas persyaratan</span>
        </div>
  
        <div class="col d-flex flex-column justify-content-center border-dash rounded mt-4 mb-2">
          <input type="file" name="file_stage_1" id="file_stage_1" accept=".rar, .zip">
        </div>
  
        <small>
          File yang harus ada di folder:
          <ul class="px-3">
            <li>
              Scan KTM Semua Anggota : <br>
              KTM_Nama_Asal Instansi/Universitas.pdf
            </li>
            <li>
              Bukti follow akun instagram @inspace_itk: <br>
              Follow Inspace_Nama_Asal Instansi/Universitas.jpg/png
            </li>
            <li>
              Bukti follow akun instagram @hmsi_itk : <br>
              Follow HMSI_Nama_Asal Instansi/Universitas.jpg/png
            </li>
            <li>
              SS bukti up twibbon : <br>
              Twibbon_Nama_Asal Instansi/Universitas.jpg/png
              <a href="https://bit.ly/TemplateTwibbonINSPACE2022" target="_blank" rel="noopener noreferrer"
                style="color: #893ff8">
                [download]
              </a>
            </li>
            <li>
              Format penamaan rar/zip : <br>
              LOMBA POSTER INFOGRAFIS INSPACE 2022_NAMA PESERTA_ASAL PERGURUAN TINGGI_BERKAS PERSYARATAN
            </li>
          </ul>
          <span style="color: #aaa">
            <span style="color: #EC167F">*</span> .zip/rar, max 10MB
          </span>
        </small>
      </div>
  
      <div class="col-md-6">
        <div class="mb-2">
          <span class="text-uppercase" style="letter-spacing: .17em">poster/dokumen</span>
        </div>
  
        <div class="col d-flex flex-column justify-content-center border-dash rounded mt-4 mb-2">
          <input type="file" name="document" id="document" accept=".rar, .zip">
        </div>
  
        <small>
          File yang harus ada di folder:
          <ul class="px-3">
            <li>File poster : <br> 
               Nama Peserta_Asal Sekolah/Institusi.png/jpeg</li>
            <li>
              Surat orisinalitas karya
              <a href="https://bit.ly/TemplateSuratOrisinalitasPosterInfografis2022" target="_blank" rel="noopener noreferrer"
                style="color: #893ff8">
                [download]
              </a>
            </li>
          </ul>
          <span style="color: #aaa">
            <span style="color: #EC167F">*</span> .zip/rar, max 10MB
          </span>
        </small>
      </div>
    </div>
  
    <div class="row justify-content-end mt-5 p-3">
      @if($competition['program_team']['file_stage_1'] == null)
        <x-buttons.outlined-button label="save permanently" />
      @else
        <x-buttons.outlined-button label="save permanently" disabled/>
      @endif
    </div>
  </div>
</form>


@push('scripts')
<script>
  const fileStageOne = document.querySelector('#file_stage_1')
  const documentFile = document.querySelector('#document')

  const fileStageOnePond = FilePond.create(fileStageOne)
  fileStageOnePond.setOptions({
    server : {
      url : '{{ route("apiStorePosterFileStageOne") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP ZIP/RAR FILE HERE'
  })
  
  const documentPond = FilePond.create(documentFile)
  documentPond.setOptions({
    server : {
      url : '{{ route("apiStorePosterDocument") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP ZIP/RAR FILE HERE'
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