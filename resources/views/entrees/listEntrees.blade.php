@extends('layouts\dashbord')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">STOCK</h4>
</div>

<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVELLE ENTREE</a>
    </div>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th class="text-center">Produit</th>
      <th class="text-center">Quantité</th>
      <th class="text-center">Prix Unitaire(CFA)</th>
      <th class="text-center">Action</th>
    </thead>
    <tbody id="tbody">
        @forelse ($entrees as $e)
        <tr>
            <td class="text-center"> {{ $e->produit->libelle }}</td>
            <td class="text-center {{ $e->quantite <= 5 ? 'alert alert-danger' : ($e->quantite < 50 ? 'alert alert-warning' : '') }}"> {{ $e->quantite }}</td>
            <td class="text-center"> {{ $e->prix }}</td>
            <td class="text-center">
                <a href="#" class="show-modal btn btn-info btn-sm"
                  data-id="{{$e->id}}" data-produit="{{$e->produit->libelle}}"
                  data-quantite="{{$e->quantite}}"
                  data-prix="{{$e->prix}}">
                    <i class="fa fa-eye"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="{{ route('entree.edit',$e->id) }}" class="btn btn-warning btn-sm" data-id="">
                    <i class="fa fa-pencil"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_entree1="{{$e->id}}">
                    <i class="fa fa-trash" style="font-size: 18px;"></i>
                </a>&nbsp;
              </td>
        </tr>
        @empty
            <h3>Stock vide</h3>
        @endforelse
    </tbody>
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
                <label for="">PRODUIT </label>
                <input type="val" class="form-control" id="produit" disabled>
            </div>

            <div class="form-group">
                <label for="">QUANTITE </label>
                <input type="val" class="form-control" id="quantite" disabled>
            </div>

            <div class="form-group">
                <label for="">PRIX(CFA) </label>
                <input type="val" class="form-control" id="prix" disabled>
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
          <form method="post" action="{{ route('entree.store') }}"  enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Produit: </label>
                  <div class="col-md-6">
                    <select name="produit_id" id="" class="form-control">
                        <option value="Selectionner un produit" class="form-control"></option>
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
              <input type="submit" class="btn btn-primary" value="AJOUTER" style="background: #1D62F0; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
            </div>
          </form>

          </div>
      </div>
  </div>
</div>

@if($errors->count())
  <script>
    $(document).ready(function() {
      $('#showmodalAdd').modal('show');
      $('.modal-title').text('Echec de l\'ajout dans le stock !');
      $('.modal-header').css('background', '#FF4A55');
    });
  </script>
@endif
<!-- DELETE FORM -->
<div id="showmodalDel" class="modal fade" role="dialog" tabindex="-1" >
 <div class="modal-dialog" >
     <div class="modal-content">
         <div class="modal-header" style="background: #1D62F0;">
           <h4 class="modal-title text-center" style="color: #fff;"></h4>
         </div>
         <div class="modal-body">
           <form class="text-center" action="{{ route('entree.destroy') }}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             @method('delete')
             <input type="hidden" name="id_entree" type="val" id="id_entree1">
             <button type="button" data-dismiss="modal" class="btn btn-success">Annuler</button>
             <input type="submit" class="btn btn-danger" value="Confimer">
           </form>
         </div>
     </div>
 </div>
</div>

<script>
// Show function utilisateur
$(document).on('click', '.show-modal', function() {
  $('#showmodalF').modal('show');
  $('#id').val($(this).data('id'));
  $('#produit').val($(this).data('produit'));
  $('#quantite').val($(this).data('quantite'));
  $('#prix').val($(this).data('prix'));
  $('.modal-title').text('Details Stock');
  $('.modal-header').css('background', '#1DC7EA');
});

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter dans le stock');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
  $('#id_entree1').val($(this).data('id_entree1'));
  $('.modal-header').css('background', 'linear-gradient(90deg, #8E44AD, #3498db)');
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
