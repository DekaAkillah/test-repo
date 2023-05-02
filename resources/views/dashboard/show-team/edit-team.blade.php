@extends('layouts.master')
@push('styles')
<!-- Fontawesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"
  integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<section>
  <div class="container-sm w-75 border border-dark rounded py-3 px-4">
    <div class="row justify-content-center">
      <span class="h4 text-white">Configure {{ $team->name }}</span>
    </div>

    <form action="{{ route('dashboard.edit-team.post', [
        'competitionSlug' => $program->slug,
        'teamCode' => $team->code,
      ]) }}" method="post">
      @csrf
      <div class="d-flex align-items-center my-4">
        <div class="mr-3" style="width: 20%">
          <input type="file" class="filepond" name="logo" accept="image/png, image/jpeg" />
        </div>
        {{-- <img class="img-fluid rounded-circle mr-4" style="width: 15%"
          src="{{ $team->logo ?? 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/822e6a3e-aa59-423a-b62a-6b48776c3218/d9n9s7c-829f616b-09bf-4a8e-b614-9a118193a899.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzgyMmU2YTNlLWFhNTktNDIzYS1iNjJhLTZiNDg3NzZjMzIxOFwvZDluOXM3Yy04MjlmNjE2Yi0wOWJmLTRhOGUtYjYxNC05YTExODE5M2E4OTkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.BngEaYYNnh8CCThLqJ1QCf04wfNWGM8aRGdFT7qYQ8k' }}"
          alt="avatar"> --}}

        <x-inputs.stroke-input placeholder="Enter a cool team name" value="{{ old('name', $team->name) }}" name="name" />
      </div>

      <div class="row px-3 my-4">
        <div class="col p-0 mr-2">
          <div class="form-group mb-4">
            <label for="">Team Leader Institution</label>
            <x-inputs.outlined-input value="{{ $team->institution }}" readonly />
          </div>
          <div class="form-group">
            <label for="">Team Leader Major</label>
            <x-inputs.outlined-input value="{{ $team->major }}" readonly />
          </div>
        </div>

        <div class="col p-0 ml-2">
          <div class="form-group">
            <label for="">Team Code</label>
            <x-inputs.outlined-input class="code" placeholder="Team unique code" maxlength="6"
              value="{{ strtoupper(old('code', $team->code)) }}" readonly/>
            <small class=" text-muted">Help other member identify their team</small>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end">
        <x-buttons.outlined-button type="submit" label="update" />
      </div>
    </form>

    <div class="row px-3 my-5">
      <div class="col p-0 mr-2">
        <div class="mb-3">
          <span class="h6 font-weight-bold text-uppercase" style="letter-spacing: .17em">
            add member
          </span>
        </div>

        <div class="d-flex justify-content-between">
          <div class="form-group mr-3" style="flex: 1">
            <x-inputs.outlined-input id="memberEmail" type="text" placeholder="Member email" />
            <small class="text-muted">
              Make sure team member has registered in INSPACE
            </small>
          </div>

          <x-buttons.outlined-button type="button" class="align-self-start" id="btnFindMember" label="find" />
        </div>

        <div class="d-flex flex-column" id="personInfo">
          <span class="h6 font-weight-bold text-white text-uppercase mt-2 mb-3" style="letter-spacing: .17em">
            person info
          </span>

          <span id="name" class="h6 font-weight-normal text-uppercase" style="letter-spacing: .17em">
            name: -
          </span>
          <span id="institution" class="h6 font-weight-normal text-uppercase" style="letter-spacing: .17em">
            institution: -
          </span>

          @php
          $countMembers = count($members);
          @endphp
          @if($countMembers == $program->max_team)
          <x-buttons.outlined-button class="mt-2 align-self-end" id="btnConfirmMember" label="confirm" disabled />
          @else
          <x-buttons.outlined-button class="mt-2 align-self-end" id="btnConfirmMember" label="confirm" />
          @endif
        </div>
      </div>

      <div class="col p-0 ml-4">
        <div class="mb-3">
          <span class="h6 font-weight-bold text-uppercase" style="letter-spacing: .17em">
            current member
          </span>
        </div>

        <div class="d-flex justify-content-between mb-1 member-item-small">
          <span class="h5 font-weight-normal text-uppercase">You</span>
          <x-miscs.badge label="leader" />
        </div>

        @foreach($members as $member)
        <x-items.member-item-small id="{{ $member->user->id }}" name="{{ $member->user->name }}" />
        @endforeach

      </div>
    </div>

    <div class="d-flex justify-content-end mb-2">
      <x-buttons.text-button type="button" label="back to dashboard" onclick="window.location.assign('{{ route('dashboard.show-team', ['competitionSlug' => $program->slug, 'team_code' => $team->code]) }}')" />
    </div>
  </div>
</section>

<x-modals.warning-modal title="Member tidak ditemukan" usePrimaryButton="false"
  message="Periksa kembali email yang diinput atau ajak temanmu untuk daftar akun di INSPACE!" />

@endsection

@push('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
  function closeWarningModal() {
    $('#warningModal').modal('hide')
  }
</script>

<script>
  const btnFindMember = document.querySelector('#btnFindMember')
  const btnConfirmMember = document.querySelector('#btnConfirmMember')
  var currentUser = {}

  btnFindMember.addEventListener('click', async () => {
    let email = document.querySelector('#memberEmail').value

    let user = await findUserByEmail(email)

    setPersonInfo(user)
    currentUser = user
  })

  const findUserByEmail = async email => {
    try {
      const res = await axios.get(`/api/assemble-member/find/${email}`)
      const user = res.data;

      return user;
    } catch(e) {
      console.error(e)
    }
  }

  btnConfirmMember.addEventListener('click', async e => {
    e.preventDefault();

    let data = {
      teamId : '{{ $team->id }}',
      userId : currentUser.id,
      teamLeaderId : '{{ auth()->user()->id }}'
    }

    await addMember(data)

    location.reload()
  })

  const addMember = async data => {
    try {
      const res = await axios.post(`/api/assemble-member/add`, data)
      const userData = res.data

      return userData;
    } catch(e) {
      console.error(e)
    }
  }

  const setPersonInfo = ({name, institution}) => {
    
    if (name == undefined || institution == undefined){
      name = '-'
      institution = '-'
      
      let warningModal = new bootstrap.Modal(document.querySelector('#warningModal'), {
        keyboard: false
      })

      warningModal.show()
    }

    document.querySelector('#personInfo #name').innerHTML = 'name: ' + name
    document.querySelector('#personInfo #institution').innerHTML = 'institution: ' + institution
    
  }

  const memberItem = ({id, name}) => {
    return `<x-items.member-item-small id="${id}" name="${name}" />`
  }
</script>
<script>
  let memberEmail = document.querySelector('#memberEmail')

  memberEmail.addEventListener('keyup', (e) => {
    let isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e.target.value);
    
    isValid ? 
      memberEmail.style.borderColor = '#39B085'
      :
      memberEmail.style.borderColor = '#EC163D'

  })
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

  const avatar = document.querySelector('.filepond')
  const pond = FilePond.create(avatar);

  pond.setOptions({
    labelIdle: `Update team avatar`,
    imagePreviewHeight: 128,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 128,
    imageResizeTargetHeight: 128,
    stylePanelLayout: 'compact circle',
    styleLoadIndicatorPosition: 'center bottom',
    styleButtonRemoveItemPosition: 'center bottom',
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