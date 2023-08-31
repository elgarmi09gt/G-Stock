@extends('layouts\dashbord')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">
<div class="row">
    <h6 class="text-center col col-md-6 col-sm-6" style="background: #222324; color: #fff; padding: 10px;">{{ $vente->reference }}</h6>
    <h6 class="text-center col col-md-6 col-sm-6" style="background: #222324; color: #fff; padding: 10px;">{{ $client?->prenoms.' '.$client?->nom.'('.$client?->telephone.')' }}</h6>
</div>
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">LISTE PRODUITS</h4>
</div>
@if ($vente->etat != 1)
    <div class="row">
    <div class="col-md-4 col-sm-3">
        <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU PRODUIT</a>
    </div>
    @if ($sorties->count() > 0)
        <div class="col-md-8 col-sm-9 text-right">
            <a href="#"
                class="show-modal-reglement btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-money"></i>REGLEMENT</a>
        </div>
    @endif
@endif
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th class="text-center">Produit</th>
      <th class="text-center">Quantite</th>
      <th class="text-center">Prix(CFA)</th>
      <th class="text-center">Action</th>
    </thead>
    <tbody id="tbody">
        @php $total = 0; @endphp
        @forelse ($sorties as $s)
        <tr>
            <td class="text-center"> {{ $s->produit?->libelle }}</td>
            <td class="text-center"> {{ $s->quantite }}</td>
            <td class="text-center"> {{ $s->prix }}</td>
            <td class="text-center">

                {{--<a href=" route('vente.edit',$s->id) " class="btn btn-warning btn-sm" data-id="">
                    <i class="fa fa-pencil"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;--}}
                @if ($vente->etat != 1)
                    <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_sortie1="{{ $s->id }}">
                        <i class="fa fa-trash" style="font-size: 18px;"></i>
                    </a>&nbsp;
                @endif
              </td>
        </tr>
@php
    $total+=$s->quantite*$s->prix
@endphp
        @empty
            <h4>Pas de Produit</h4>
        @endforelse
    </tbody>
    <tr style="background: #44cb8c; color: #fff;">
        <td colspan="2" class="text-left"><b>{{ 'TOTAL' }}</b> </td>
        <td class="text-center"><b>{{ $total.' FCFA' }}</b></td>
        <td colspan="2" class="text-left"></td>
    </tr>
  </table>
</div>
</div>

</div>
</section>
 {{--$utilisateurs->links()--}}
{{-- Modal Form Show POST --}}
<div id="showmodalF" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" style="color: #fff; font-size: 30px;">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="">REFERNCE </label>
                <input type="val" class="form-control" id="reference" disabled>
            </div>

            <div class="form-group">
                <label for="">CLIENT </label>
                <input type="val" class="form-control" id="client" disabled>
            </div>

            <div class="form-group">
                <label for="">ETAT </label>
                <input type="val" class="form-control" id="etat" disabled>
            </div>

          </div>
      </div>
  </div>
</div>

<div id="showmodalAdd" class="modal fade" role="dialog" tabindex="-1" >
  <div class="modal-dialog" >
      <div class="modal-content">
          <div class="modal-header" style="background: #1D62F0;">
            <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
          </div>
          <div class="modal-body">
          <form method="post" action="{{ route('vente.sorties',['vente' => $vente->id]) }}"  enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="vente_id" class="form-control {{ $errors->has('vente_id') ? ' is-invalid' : '' }}" value="{{ $vente->id}}">

              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Produit: </label>
                  <div class="col-md-6">
                    <select name="produit_id" id="" class="form-control">
                        <option value="" class="form-control">Selectionner un produit</option>
                        @foreach ($produits as $p)
                            <option @selected(old('produit_id')==$p->id) value="{{ $p->id }}" class="form-control">{{ $p->libelle  }}</option>
                        @endforeach
                    </select>
                    {{--  <inputtype="text"name="prenoms"class="form-control$errors->has('prenoms')?'is-invalid':'' " value="{{ old('prenoms')}}">}}--}}
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
                    <input type="text" name="quantite" class="form-control {{ $errors->has('quantite') ? ' is-invalid' : '' }}" value="{{ old('quantite')}}">
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
                  <div class="col-md-6"><input type="text" name="prix" class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" value="{{ old('prix')}}">
                    @if($errors->has('prix'))
                    <div class="text-center text-danger">
                      {{ $errors->first('prix') }}
                    </div>
                    @endif
                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>

            <div class="form-group  text-center">
              <input type="submit" class="btn btn-primary" value="AJOUTER PRODUIT" style="background: #1D62F0; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
            </div>
          </form>

          </div>
      </div>
  </div>
</div>

@if($errors->count())
  @if ($errors->has('mtrc'))
    <script>
      $(document).ready(function() {
        $('#showmodalReg').modal('show');
        $('.modal-title').text('Echec de réglement !');
        $('.modal-header').css('background', '#FF4A55');
      });
    </script>
  @endif
  @if ($errors->has('produit_id'))
  <script>
    $(document).ready(function() {
      $('#showmodalAdd').modal('show');
      $('.modal-title').text('Echec de l\'ajout du Produit !');
      $('.modal-header').css('background', '#FF4A55');
    });
  </script>
  @endif
@endif

<!-- DELETE FORM -->
<div id="showmodalDel" class="modal fade" role="dialog" tabindex="-1" >
 <div class="modal-dialog" >
     <div class="modal-content">
         <div class="modal-header" style="background: #1D62F0;">
           <h4 class="modal-title text-center" style="color: #fff;"></h4>
         </div>
         <div class="modal-body">
           <form class="text-center" action="{{ route('vente.sortie.destroy', $vente ) }}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             @method('delete')
             <input type="hidden" name="id_sortie" type="val" id="id_sortie1">
             <button type="button" data-dismiss="modal" class="btn btn-success">Annuler</button>
             <input type="submit" class="btn btn-danger" value="Confimer">
           </form>
         </div>
     </div>
 </div>
</div>

{{-- REGLEMENT FORM --}}
<div id="showmodalReg" class="modal fade" role="dialog" tabindex="-1" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header" style="background: #1D62F0;">
              <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
              <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
            </div>
            <div class="modal-body">
            <form method="post" action="{{ route('vente.reglement',$vente) }}"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_vente" value="{{ $vente->id }}">
                <div class="form-group">
                    <div class="row">
                      <label class="col-md-3">Net A Payer (CFA): </label>
                      <div class="col-md-6">
                        <input type="text" name="total" class="form-control" value="{{ $total}}" @readonly(true)>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <label class="col-md-3">Somme Reçu(CFA): </label>
                      <div class="col-md-6">
                        <input type="text" name="mtrc" class="form-control {{ $errors->has('mtrc') ? 'is-invalid' : '' }}" value="{{ old('mtrc')}}">
                        @if($errors->has('mtrc'))
                        <div class="text-center text-danger">
                          {{ $errors->first('mtrc') }}
                        </div>
                        @endif
                      </div>

                      <div class="clearfix"></div>
                    </div>
                  </div>


              <div class="form-group  text-center">
                <input type="submit" class="btn btn-primary" value="REGLER" style="background: #1D62F0; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
              </div>
            </form>

            </div>
        </div>
    </div>
  </div>

<script>
// Show function utilisateur
$(document).on('click', '.show-modal', function() {
  $('#showmodalF').modal('show');
  $('#reference').val($(this).data('reference'));
  $('#client').val($(this).data('client'));
  $('#etat').val($(this).data('etat'));
  $('.modal-title').text('Details Vente');
  $('.modal-header').css('background', '#1DC7EA');
});

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter à la vente');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
  $('#id_sortie1').val($(this).data('id_sortie1'));
  $('.modal-header').css('background', 'linear-gradient(90deg, #8E44AD, #3498db)');
});

$(document).on('click', '.show-modal-reglement', function() {
  $('#showmodalReg').modal('show');
  $('.modal-title').text('Effectuer un réglement');
  $('#total').val($(this).data('total'));
  $('.modal-header').css('background', '#1D62F0');
});

</script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tbody tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$('#datatable').dataTable();
</script>
@endsection
