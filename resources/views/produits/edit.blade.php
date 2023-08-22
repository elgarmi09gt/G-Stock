@extends('layouts\dashbord')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION PRODUIT </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('produit.update', $produit->id) }}"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Reference: </label>
                  <div class="col-md-6"><input type="text" name="reference" class="form-control {{ $errors->has('reference') ? ' is-invalid' : '' }}" value="{{ $produit->reference}}">
                    @if($errors->has('reference'))
                    <div class="text-center text-danger">
                      {{ $errors->first('reference') }}
                    </div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Libelle: </label>
                <div class="col-md-6">
                  <input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" value="{{$produit->libelle}}">
                  @if($errors->has('libelle'))
                  <div class="text-center text-danger">
                    {{ $errors->first('libelle') }}
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
