<span>
  Sebelum peserta masuk ke tahap upload berkas, diharapkan untuk melengkapi pembayaran lomba
  {{ $competition['title'] }}
  sebesar Rp {{ number_format($competition['price'], 2, ',', '.') }}. Selanjutnya, tunggu sampai panitia melakukan
  konfirmasi pembayaran.
</span>
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom/simple-notify.min.css') }}" type="text/css">
@endpush
<form action="{{ route('dashboard.store-payment',[
    'competitionSlug' => $competition['slug'],
    'team_code' => $competition['team']['code']
  ]) }}" enctype="multipart/form-data" method="post">
  @csrf
  <div class="my-4">
    @if ($competition['payment_proof'] != null)

    <x-cards.submitted-card class="m-0" style="height: 18em" message="bukti transfer telah disubmit" />

    @else

    <div class="col d-flex flex-column justify-content-center border-dash rounded m-0" style="height: 18em">
      <input type="file" name="payment_proof" id="paymentProofInput" accept=".png, .jpg, .jpeg">
    </div>
    
    <div></div>

    <div class="mt-2">
      <span style="color: #aaa">
        <span style="color: #EC167F">*</span> .png/jpg, max 10MB
      </span>
    </div>

    @endif

    <div class="row justify-content-end mt-5 p-3">
      @if($competition['payment_proof'] != null)
      <x-buttons.outlined-button label="save permanently" disabled />
      @else
      <x-buttons.outlined-button label="save permanently" />
      @endif
    </div>
  </div>
<form>

@push('scripts')
<script>
  const paymentProofInput = document.querySelector('input[id="paymentProofInput"]')
  const pond = FilePond.create(paymentProofInput)
  
  pond.setOptions({
    server : {
      url : '{{ route("apiStorePayment") }}',
      headers : {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    labelIdle: 'SELECT OR DROP BUKTI TRANSFER HERE',

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