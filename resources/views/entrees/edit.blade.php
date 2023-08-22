@extends('layouts\dashbord')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION CLIENT </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('client.update', $client->id) }}"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Prénoms: </label>
                  <div class="col-md-6"><input type="text" name="prenoms" class="form-control {{ $errors->has('prenoms') ? ' is-invalid' : '' }}" value="{{ $client->prenoms}}">
                    @if($errors->has('prenoms'))
                    <div class="text-center text-danger">
                      {{ $errors->first('prenoms') }}
                    </div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Nom: </label>
                  <div class="col-md-6"><input type="text" name="nom" class="form-control {{ $errors->has('nom') ? ' is-invalid' : '' }}" value="{{ $client->nom}}">
                    @if($errors->has('nom'))
                    <div class="text-center text-danger">
                      {{ $errors->first('nom') }}
                    </div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Telephone: </label>
                <div class="col-md-6">
                  <input type="text" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" value="{{$client->telephone}}">
                  @if($errors->has('telephone'))
                  <div class="text-center text-danger">
                    {{ $errors->first('telephone') }}
                  </div>
                  @endif
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          <div class="form-group text-center">
            <input type="submit" class="btn btn-warning" value="MODIFIER" style="background: #FF9500; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
          </div>
          </form>
      </div>
    </div>
  </div>
</section>
@endsection
