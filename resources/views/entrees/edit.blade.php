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
        <form method="post" action="{{ route('entree.update', $entree->id) }}"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Produit: </label>
                  <div class="col-md-6">
                    {{--<select name="produit_id" id="" class="form-control" @disabled(true)>
                        <option value="Selectionner un produit" class="form-control"></option>
                        @foreach ($produits as $p)
                            <option @selected($entree->produit_id == $p->id) value="{{ $p->id }}" class="form-control">{{ $p->libelle  }}</option>
                        @endforeach
                    </select>--}}
                    <input type="hidden"name="produit_id"class="form-control$errors->has('produit_id')?'is-invalid':'' " value="{{ $entree->produit_id}}">{{ $produit->libelle }}
                    @if($errors->has('produit_id'))
                    <div class="text-center text-danger">
                      {{ $errors->first('produit_id') }}
                    </div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Quantité: </label>
                  <div class="col-md-6">
                    <input type="text" name="quantite" class="form-control {{ $errors->has('quantite') ? ' is-invalid' : '' }}" value="{{ $entree->quantite }}">
                    @if($errors->has('quantite'))
                    <div class="text-center text-danger">
                      {{ $errors->first('quantite') }}
                    </div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Prix Unitaire(cfa): </label>
                  <div class="col-md-6"><input type="text" name="prix" class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" value="{{ $entree->prix }}">
                    @if($errors->has('prix'))
                    <div class="text-center text-danger">
                      {{ $errors->first('prix') }}
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
