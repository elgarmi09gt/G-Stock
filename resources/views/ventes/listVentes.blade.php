@extends('layouts\dashbord')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">VENTES</h4>
</div>

<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU VENTE</a>
    </div>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th class="text-center">Reference</th>
      <th class="text-center">Client</th>
      <th class="text-center">Etat</th>
      <th class="text-center">Action</th>
    </thead>
    <tbody id="tbody">
        @forelse ($ventes as $v)
        <tr>
            <td class="text-center"> {{ $v->reference }}</td>
            <td class="text-center"> {{ $v->client?->prenoms.' '.$v->client?->nom.' '.$v->client?->telephone }}</td>
            <td class="text-center">
                @if ($v->etat == 0) {{ 'Non payé' }} @else {{ 'Paiement en cours' }} @endif</td>
            <td class="text-center">
                <a href="#" class="show-modal btn btn-info btn-sm"
                  data-id="{{$v->id}}" data-client="{{ $v->client?->prenoms.' '.$v->client?->nom.' '.$v->client?->telephone }}"
                  data-reference="{{$v->reference}}"
                  data-etat="@if ($v->etat == 0) {{ 'Non payé' }} @else {{ 'Paiement en cours' }} @endif">
                    <i class="fa fa-eye"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="{{ route('vente.edit',$v->id) }}" class="btn btn-warning btn-sm" data-id="">
                    <i class="fa fa-pencil"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_vente1="{{$v->id}}">
                    <i class="fa fa-trash" style="font-size: 18px;"></i>
                </a>&nbsp;
              </td>
        </tr>
        @empty
            <h3>Pas de Vente</h3>
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
          <form method="post" action="{{ route('vente.store') }}"  enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Client: </label>
                  <div class="col-md-6">
                    <select name="client_id" id="" class="form-control">
                        <option value="" class="form-control">Selectionner un client</option>
                        @foreach ($clients as $c)
                            <option @selected(old('client_id')==$c->id) value="{{ $c->id }}" class="form-control">{{ $c->prenoms.' '.$c->nom.'('.$c->telephone.')'  }}</option>
                        @endforeach
                    </select>
                    {{--  <inputtype="text"name="prenoms"class="form-control$errors->has('prenoms')?'is-invalid':'' " value="{{ old('prenoms')}}">}}--}}
                    @if($errors->has('client_id'))
                    <div class="text-center text-danger">
                      {{ $errors->first('client_id') }}
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
  <script>
    $(document).ready(function() {
      $('#showmodalAdd').modal('show');
      $('.modal-title').text('Echec de l\'ajout du Client !');
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
           <form class="text-center" action="{{ route('client.destroy') }}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             @method('delete')
             <input type="hidden" name="id_client" type="val" id="id_client1">
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
  $('#reference').val($(this).data('reference'));
  $('#client').val($(this).data('client'));
  $('#etat').val($(this).data('etat'));
  $('.modal-title').text('Details Vente');
  $('.modal-header').css('background', '#1DC7EA');
});

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter un client');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
  $('#id_client1').val($(this).data('id_client1'));
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
