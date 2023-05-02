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
      <span class="h4 text-white">Assemble Member</span>
    </div>

    <!-- <form action="#" method="post"> -->
      <div class="d-flex align-items-center my-4">
        <img class="img-fluid rounded-circle mr-4" style="width: 15%"
          src="{{ $team->logo == 'img/logo/inspace_noyear.webp' ? asset($team->logo) : asset('storage/'.$team->logo) }}"
          alt="avatar">

        <span class="h3">{{ $team->name }}</span>
      </div>

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

            @if(count($members) == $program->max_team)
              <x-buttons.outlined-button class="mt-2 align-self-end" id="btnConfirmMember" label="confirm" disabled/>
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
        <!-- <x-buttons.text-button type="button" label="add others later" onclick="location.href = '/dashboard'" /> -->
        <x-buttons.outlined-button onclick="location.href='{{ route('dashboard.show-team', [ 'competitionSlug' => $program->slug, 'team_code' => $team->code ]) }}'" label="save team" />
      </div>
    <!-- </form> -->
  </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
      console.log(userData)
    } catch(e) {
      console.error(e)
    }
  }

  const setPersonInfo = ({name, institution}) => {
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
@endpush