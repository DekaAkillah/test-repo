@extends('layouts.master')


@section('content')
<section class="text-light" id="editProfile">
  <div class="wm wm-border dark wow fadeInDown"></div>
  <div class="container-sm border border-dark rounded mt-4 pt-5 px-5 pb-2">
    <div class="d-flex justify-content-between">
      <h3 class="text-uppercase mb-5" style="letter-spacing: .17em">biodata</h3>
      <a href="{{ route('dashboard.change-password') }}" class="text-muted">Change password</a>
    </div>
    <form class="my-4" action="#" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col">
          <img src="{{ asset($user->avatar) == 'img/logo/inspace_noyear.webp' ? asset($user->avatar) : asset('storage/'.$user->avatar)  }}" alt="avatar" class="rounded-circle mt-4 mb-2"
            style="width: 150px; border: white solid 4px" >

          <div class="form-group mt-4 mb-5">
            <input type="file" name="avatar">
          </div>

          <div class="form-group">
            <label for="">Nama Lengkap</label>
            <x-inputs.outlined-input type="text" value="{{ $user->name }}" disabled />
          </div>

          <div class="form-group">
            <label for="">Email</label>
            <x-inputs.outlined-input type="text" value="{{ $user->email }}" disabled />
          </div>

          <div class="form-group">
            <label for="">No HP</label>
            <x-inputs.outlined-input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}"
              placeholder="eg. 0812345" />
            @error('telephone')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Tempat Lahir</label>
            <x-inputs.outlined-input type="text" name="birthplace" value="{{ old('birthplace', $user->birthplace) }}"
              placeholder="eg. Balikpapan" />
            @error('birthplace')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Tanggal Lahir</label>
            <x-inputs.outlined-input type="date" name="date_of_birth"
              value="{{ old('date_of_birth', $user->date_of_birth) }}" />
            @error('date_of_birth')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="">Kab./Kota Domisili</label>
            <x-inputs.outlined-input type="text" name="city" placeholder="eg. Balikpapan"
              value="{{ old('city', $user->city) }}" />
            @error('city')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Provinsi Domisili</label>
            <x-inputs.outlined-input type="text" name="province" placeholder="eg. Kalimantan Timur"
              value="{{ old('province', $user->province) }}" />
            @error('province')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">NIM/NIS</label>
            <x-inputs.outlined-input type="text" name="number_id" placeholder="eg. 10201063"
              value="{{ old('number_id', $user->number_id) }}" />
            @error('number_id')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Jurusan/Prodi</label>
            <x-inputs.outlined-input type="text" name="class_major" placeholder="eg. Sistem Informasi"
              value="{{ old('class_major', $user->class_major) }}" />
            @error('class_major')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Sekolah/Universitas</label>
            <x-inputs.outlined-input type="text" name="institution" placeholder="eg. Institut Teknologi Kalimantan"
              value="{{ old('institution', $user->institution) }}" />
            @error('institution')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Tahun Angkatan</label>
            <x-inputs.outlined-input type="text" name="class_year" placeholder="eg. 2020"
              value="{{ old('class_year', $user->class_year) }}" />
            @error('class_year')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Username Instagram</label>
            <x-inputs.outlined-input type="text" name="instagram_username" placeholder="eg. myusername"
              value="{{ old('instagram_username', $user->instagram_username) }}" />
            @error('instagram_username')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row mt-5 mr-1 justify-content-end">
        <x-buttons.text-button type="button" label="Back to dashboard"
          onclick="location.href = '{{ route('dashboard.index') }}'" />
        <x-buttons.outlined-button class="ml-3" type="submit" label="Save" />
      </div>
    </form>
  </div>
</section>
@endsection


@push('styles')
  <link rel="stylesheet" href="{{ asset('css/custom/simple-notify.min.css') }}" type="text/css">
@endpush

@push('scripts')
<script src="{{ asset('js/custom/simple-notify.min.js') }}"></script>
<script src="{{ asset('js/custom/toast.js') }}"></script>
<script>
  const checkSession = '{{ Session::has("success") ? "success" : (Session::has("error") ? "error" : "") }}';
  console.log(checkSession)
  if(checkSession === 'success'){
    successToast('{{ Session::get("success") }}')
  }

  if(checkSession === 'error'){
    errorToast('{{ Session::get("error") }}')
  }

</script>
@endpush
