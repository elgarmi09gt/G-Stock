@extends('layouts\dashbord')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">UTILISATEURS</h4>
</div>

<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU UTILISATEUR</a>
    </div>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th class="text-center">Prenom</th>
      <th class="text-center">Nom</th>
      <th class="text-center">Login</th>
      <th class="text-center">Role</th>
      <th class="text-center">Action</th>
    </thead>
    <tbody id="tbody">
        @forelse ($users as $u)
        <tr>
            <td class="text-center"> {{ $u->prenom }}</td>
            <td class="text-center"> {{ $u->nom }}</td>
            <td class="text-center"> {{ $u->email }}</td>
            <td class="text-center"> {{ $u->role?->libelle}}</td>
            <td class="text-center">
                <a href="#" class="show-modal btn btn-info btn-sm"
                  data-id="{{$u->id}}" data-prenom="{{$u->prenom}}"
                  data-nom="{{$u->nom}}" data-role="{{ $u->role?->libelle }}"
                  data-email="{{$u->email}}">
                    <i class="fa fa-eye"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;



                <a href="#" class="show-modal-del {{ $u->active == 1 ? 'btn btn-success' : 'btn btn-warning' }} btn-sm" data-id_user1="{{$u->id}}">
                    <i class=" {{ $u->active == 1 ? 'fa fa-thumbs-o-up': 'fa fa-thumbs-o-down'}}"></i>
                </a>&nbsp;
              </td>
        </tr>
        @empty
            <h3>Pas d'Utilisateur</h3>
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
                <label for="">PRENOM </label>
                <input type="val" class="form-control" id="prenom" disabled>
            </div>

            <div class="form-group">
                <label for="">NOM </label>
                <input type="val" class="form-control" id="nom" disabled>
            </div>

            <div class="form-group">
                <label for="">EMAIL </label>
                <input type="val" class="form-control" id="email" disabled>
            </div>

            <div class="form-group">
                <label for="">RÔLE </label>
                <input type="val" class="form-control" id="role" disabled>
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
            <form method="post" action="{{ route('user.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-3">Nom : </label>
                    <div class="col-md-6"><input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" value="{{ old('nom')}}">
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
                    <label class="col-md-3">Prenom : </label>
                    <div class="col-md-6"><input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{ old('prenom')}}">
                      @if($errors->has('prenom'))
                      <div class="text-center text-danger">
                        {{ $errors->first('prenom') }}
                      </div>
                      @endif
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>

                <div class="form-group">
              <div class="row">
                    <label class="col-md-3">Email : </label>
                    <div class="col-md-6"><input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email')}}">
                      @if($errors->has('email'))
                      <div class="text-center text-danger">
                        {{ $errors->first('email') }}
                      </div>
                      @endif
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Mot de passe : </label>
                      <div class="col-md-6"><input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"></div>
                    <div class="clearfix"></div>
                  </div>
                </div>

                <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Confirmer mot de passe : </label>
                      <div class="col-md-6"><input id="password-confirm" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation">
                        @if($errors->has('password'))
                        <div class="text-center text-danger">
                          {{ $errors->first('password') }}
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
      $('.modal-title').text('Echec de l\'ajout de l\'Utilisateur !');
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
           <form class="text-center" action="{{ route('user.destroy') }}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             @method('delete')
             <input type="hidden" name="id_user" type="val" id="id_user1">
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
  $('#prenom').val($(this).data('prenom'));
  $('#nom').val($(this).data('nom'));
  $('#email').val($(this).data('email'));
  $('#role').val($(this).data('role'));
  $('.modal-title').text('Details Utilisateur');
  $('.modal-header').css('background', '#1DC7EA');
});

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter un utilisateur');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir Activer/Desactiver cet Utilisateur ?');
  $('#id_user1').val($(this).data('id_user1'));
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
