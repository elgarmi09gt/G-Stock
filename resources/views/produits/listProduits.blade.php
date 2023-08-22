@extends('layouts\dashbord')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">PRODUITS</h4>
</div>

<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU PRODUIT</a>
    </div>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th class="text-center">Reference</th>
      <th class="text-center">Libelle</th>
      <th class="text-center">Action</th>
    </thead>
    <tbody id="tbody">
        @forelse ($produits as $p)
        <tr>
            <td class="text-center"> {{ $p->reference }}</td>
            <td class="text-center"> {{ $p->libelle }}</td>
            <td class="text-center">
                <a href="#" class="show-modal btn btn-info btn-sm"
                  data-id="{{$p->id}}" data-libelle="{{$p->libelle}}"
                  data-reference="{{$p->reference}}"
                  data-active="{{$p->active}}">
                    <i class="fa fa-eye"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="{{ route('produit.edit',$p->id) }}" class="btn btn-warning btn-sm" data-id="">
                    <i class="fa fa-pencil"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_produit1="{{$p->id}}">
                    <i class="fa fa-trash" style="font-size: 18px;"></i>
                </a>&nbsp;
              </td>
        </tr>
        @empty
            <h3>Pas de produit</h3>
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
                <label for="">IDENTIFIANT </label>
                <input type="val" class="form-control" id="id" disabled>
            </div>

            <div class="form-group">
                <label for="">REFERENCE </label>
                <input type="val" class="form-control" id="reference" disabled>
            </div>

            <div class="form-group">
                <label for="">LIBELLE </label>
                <input type="val" class="form-control" id="libelle" disabled>
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
          <form method="post" action="{{ route('produit.store') }}"  enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Reference: </label>
                  <div class="col-md-6"><input type="text" name="reference" class="form-control {{ $errors->has('reference') ? ' is-invalid' : '' }}" value="{{ old('reference')}}">
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
                  <div class="col-md-6"><input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" value="{{ old('libelle')}}">
                    @if($errors->has('libelle'))
                    <div class="text-center text-danger">
                      {{ $errors->first('libelle') }}
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
      $('.modal-title').text('Echec de l\'ajout du Produit !');
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
           <form class="text-center" action="{{ route('produit.destroy') }}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             @method('delete')
             <input type="hidden" name="id_produit" type="val" id="id_produit1">
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
  $('#libelle').val($(this).data('libelle'));
  $('#reference').val($(this).data('reference'));
  $('.modal-title').text('Details Produit');
  $('.modal-header').css('background', '#1DC7EA');
});

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter un produit');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
  $('#id_produit1').val($(this).data('id_produit1'));
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
