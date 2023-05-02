<!-- section begin -->
<section id="section-competitions" class="text-light" data-bgimage="url(images-event/bg/1_1.webp) fixed top center"
  data-stellar-background-ratio=".2">
  <div class="wm wm-border dark text-center wow fadeInDown">Competitions</div>
    <div class="container">
      <div class="row">
      <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
        <h1>Competitions</h1>
        <div class="separator"><span><i class="fa fa-square"></i></span></div>
        <div class="spacer-single"></div>
      </div>

      <div class="clearfix"></div>

      @foreach($programs as $program)
        <div class="col-xl-3 col-lg-4 col-sm-6 mb30 wow fadeInUp">
          <!-- team member -->
          <div class="card2 text-center">
            <div class="team-pic2">
              <img src="{{ asset('logo-program') }}/{{ $program->slug }}.webp" class="img-responsive" alt="" />
            </div>
            <div class="team-desc">
              <h3>{{ $program->name }}</h3>
              <p class="lead">
                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' ,$program->stage_1_open_registration)->format('d/m/Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s' ,$program->stage_1_close_registration)->format('d/m/Y') }}
              </p>
              <div class="small-border">
              
              </div>
              <p>
                {{ $program->short_description }}
              </p>
              <div class="col-md-12">
                <a href="{{ route('competition.show', $program->slug) }}" class="btn btn-line">View Detail</a>
              </div>
            </div>
          </div>
          <!-- team close -->
        </div>
      @endforeach
    </div>
  </div>
</section>
<!-- section close -->