@extends('layouts.master')

@push('styles')
<link rel="stylesheet" href="/css/timeline.css" type="text/css">
@endpush

@section('content')
<!-- parallax section -->
<section id="section-hero" class="text-light" data-bgimage="url(/images-event/bg/10.webp) fixed top center"
    data-stellar-background-ratio=".2">
    <div class="wm wm-border dark wow fadeInDown">
        @if($program->slug == 'ui-ux-2022')
        UI/UX
        @elseif($program->slug == 'animasi-digital-2022')
        Animasi
        @elseif($program->slug == 'poster-2022')
        Poster
        @elseif($program->slug == 'bpc-2022')
        BPC
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="title-2 mt40 mb10">
                    {{ $program->name }}
                </h1>
                <span>Daftar sebelum {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                    ,$program->stage_1_close_registration)->format('d M Y') }}</span>
            </div>
        </div>
    </div>
</section>
<!-- section close -->

<!-- section begin -->
<section>
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">

                <div class="blog-read" style="background-size: cover;">
                    <h3 align="center">About</h3>
                    <div class="small-border" style="background-size: cover;"></div>
                    <p>
                        {{ $program->description }}
                    </p>
                </div>

                <!-- team member -->
                <div class="text-center p-4">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h3>Grand Prize</h3>
                            <div class="small-border"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="team-desc p-0 m-0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="team-pic">
                                            <img src="{{ asset('images-event/dua.webp') }}" class="img-responsive"
                                                alt="" />
                                            <br>
                                            <b>Second Place</b><br>
                                            @if($program->slug == 'ui-ux-2022')
                                            Rp. 1.000.000,00
                                            @elseif($program->slug == 'animasi-digital-2022')
                                            Rp. 2.000.000,00
                                            @elseif($program->slug == 'poster-2022')
                                            Rp. 600.000,00
                                            @elseif($program->slug == 'bpc-2022')
                                            Rp. 1.500.000,00
                                            @endif
                                            <br>
                                            + E-Certificate
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="team-pic">
                                            <img src="{{ asset('images-event/satu.webp') }}" class="img-responsive"
                                                alt="" />
                                            <br>
                                            <b>First Place</b><br>
                                            @if($program->slug == 'ui-ux-2022')
                                            Rp. 1.500.000,00
                                            @elseif($program->slug == 'animasi-digital-2022')
                                            Rp. 3.500.000,00
                                            @elseif($program->slug == 'poster-2022')
                                            Rp. 800.000,00
                                            @elseif($program->slug == 'bpc-2022')
                                            Rp. 2.500.000,00
                                            @endif
                                            <br>
                                            + E-Certificate
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="team-pic">
                                            <img src="{{ asset('images-event/tiga.webp') }}" class="img-responsive"
                                                alt="" />
                                            <br>
                                            <b>Third Place</b><br>
                                            @if($program->slug == 'ui-ux-2022')
                                            Rp. 750.000,00
                                            @elseif($program->slug == 'animasi-digital-2022')
                                            Rp. 1.500.000,00
                                            @elseif($program->slug == 'poster-2022')
                                            Rp. 400.000,00
                                            @elseif($program->slug == 'bpc-2022')
                                            Rp. 1.000.000,00
                                            @endif
                                            <br>
                                            + E-Certificate
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- team close -->

                <!-- <div class="blog-read">
          <h4>Prize</h4>
          prize goes here
        </div>  -->


            </div>



            <div id="sidebar" class="col-md-4">
                <div class="widget widget-text">
                    <h4>Quick Action</h4>
                    <div class="small-border"></div>
                    <div class="d-flex flex-column">
                        <div>Biaya pendaftaran: Rp {{ number_format($program->price, 2, ',', '.') }}</div>
                        <div>

                            @if($program->is_individual == 1 and $program->is_group == 0)
                            Kategori: Individu
                            @elseif($program->is_individual == 0 and $program->is_group == 1)
                            Kategori: Tim (1 Ketua dan {{ $program->max_team }} Anggota)
                            @elseif($program->is_individual == 1 and $program->is_group == 1)
                            Kategori: Individu atau Tim (1 Ketua dan {{ $program->max_team }} Anggota)
                            @endif
                        </div>
                        <div class="col mt-4 p-0">
                            <a href="#" data-toggle="modal" data-target="#warningModal"
                                class="btn btn-primary mr-2 text-white">Daftar</a>
                            <a href="{{ $program->guidebook_link }}" target="_blank" class="btn btn-secondary">Download
                                Guidebook</a>
                        </div>
                    </div>
                </div>

                <div class="widget widget-post">
                    <h4>Timeline</h4>
                    <div class="small-border"></div>

                    <div class="row">
                        <div class="col">
                            <ul class="timeline">
                                @if($program->slug == 'ui-ux-2022')
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_open_registration)->format('d M Y') }} </a>
                                    <p>
                                        Open Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_close_registration)->format('d M Y') }} </a>
                                    <p>
                                        Close Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_start_selection)->format('d M Y') }} - {{
                                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_end_selection)->format('d M Y') }} </a>
                                    <p>
                                        Tahap 1 Seleksi Proposal
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->finalist_announcement)->format('d M Y') }} </a>
                                    <p>
                                        Pengumuman Finalis
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->technical_meeting)->format('d M Y') }} </a>
                                    <p>
                                        Technical Meeting
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->final)->format('d M Y') }} </a>
                                    <p>
                                        Tahap 2 Final
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> 23 Oct 2022 </a>
                                    <p>
                                        Pengumuman Juara
                                    </p>
                                </li>
                                @endif

                                @if($program->slug == 'animasi-digital-2022')
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_open_registration)->format('d M Y') }} </a>
                                    <p>
                                        Open Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_close_registration)->format('d M Y') }} </a>
                                    <p>
                                        Close Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_start_selection)->format('d M Y') }} - {{
                                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_end_selection)->format('d M Y') }} </a>
                                    <p>
                                        Tahap Seleksi 1
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_announcement)->format('d M Y') }} </a>
                                    <p>
                                        Pengumuman 5 Besar
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_start_selection)->format('d M Y') }} - {{
                                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_end_selection)->format('d M Y') }} </a>
                                    <p>
                                        Tahap Seleksi 2
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> 23 Oct 2022 </a>
                                    <p>
                                        Pengumuman Juara
                                    </p>
                                </li>
                                @endif

                                @if($program->slug == 'poster-2022')
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_open_registration)->format('d M Y') }} </a>
                                    <p>
                                        Open Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_close_registration)->format('d M Y') }} </a>
                                    <p>
                                        Close Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_start_selection)->format('d M Y') }} - {{
                                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_end_selection)->format('d M Y') }} </a>
                                    <p>
                                        Tahap Seleksi 1
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_announcement)->format('d M Y') }} </a>
                                    <p>
                                        Pengumuman 6 Besar
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_start_selection)->format('d M Y') }} - {{
                                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_end_selection)->format('d M Y') }} </a>
                                    <p>
                                        Tahap Seleksi 2
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> 23 Oct 2022 </a>
                                    <p>
                                        Pengumuman Juara
                                    </p>
                                </li>
                                @endif

                                @if($program->slug == 'bpc-2022')
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_open_registration)->format('d M Y') }} </a>
                                    <p>
                                        Open Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_close_registration)->format('d M Y') }} </a>
                                    <p>
                                        Close Registration
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_start_selection)->format('d M Y') }} - {{
                                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_end_selection)->format('d M Y') }} </a>
                                    <p>
                                        Tahap Seleksi 1
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_1_announcement)->format('d M Y') }} </a>
                                    <p>
                                        Pengumuman Lolos Seleksi 1
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_open_registration)->format('d M Y') }} </a>
                                    <p>
                                        Pembukaan Pengumpulan Proposal (Seleksi 2)
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_close_registration)->format('d M Y') }} </a>
                                    <p>
                                        Penutupan Pengumpulan Proposal (Seleksi 2)
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_start_selection)->format('d M Y') }} - {{
                                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_end_selection)->format('d M Y') }} </a>
                                    <p>
                                        Tahap Seleksi 2
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->stage_2_announcement)->format('d M Y') }} </a>
                                    <p>
                                        Pengumuman Lolos Seleksi 2
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->technical_meeting)->format('d M Y') }} </a>
                                    <p>
                                        Technical Meeting
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s'
                                        ,$program->final)->format('d M Y') }} </a>
                                    <p>
                                        Presentasi Final
                                    </p>
                                </li>
                                <li>
                                    <a href="#"> 23 Oct 2022 </a>
                                    <p>
                                        Pengumuman Juara
                                    </p>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="widget widget-text">
                    <h4>Contact</h4>
                    <div class="small-border"></div>
                    <span>
                        <a href="#"><i class="fa fa-phone fa-lg mr-2"></i></a>
                        {{ $program->comittee->telephone }} ({{ $program->comittee->name }})
                    </span>
                    @if($program->slug == 'bpc-2022')
                    <br><span>
                        <a href="#"><i class="fa fa-phone fa-lg mr-2"></i></a>
                        083852097357 (Trie)
                    </span>
                    @endif
                </div>

            </div>

        </div>
    </div>
</section>

<x-modals.warning-modal title="Siap untuk mengikuti lomba ini?"
    message="Pastikan kamu telah membaca guidebook dengan baik. Kalau udah siap langsung daftar!"
    primaryLabel="Daftar" secondaryLabel="Cancel"
    secondaryAction="history.baack();"
    primaryAction="{{ route('competition.create-team', $program->slug) }}" />
@endsection
