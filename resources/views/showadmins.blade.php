<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Admins</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
	    <div class="row">
		<div class="col m10 s9">
                    <h3><i class="material-icons">people</i> Admin users</h3>
		    <p>Administrator accounts to manage this instance of MailMan. Every admin has the same rights.</p>
		</div>
		<div class="col m2">
		    <a class="btn-floating btn-large waves-effect waves-light modal-trigger blue darken-2 add-button" href="#create-modal"><i class="material-icons">add</i></a>
		</div>
	    </div>
            <div class="row">
                <div class="col m12">
                    <table class="striped">
			<thead>
			    	<tr>
				    <th><i class="material-icons tiny">person</i> Username</th>
				    <th><i class="material-icons tiny">build</i> Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($admins as $admin)
				<tr>
					<td>{{ $admin->username }}</td>
					<td>
					    <a class="waves-effect waves-light btn-flat modal-trigger" href="#edit-modal-{{ $admin->id }}"><i class="material-icons">edit</i></a>
					    <a href="#delete-modal-{{$admin->id}}" class="modal-trigger"><button type="button" class="btn-flat"><i class="material-icons">delete</i></button></a>
					</td>
				</tr>
			    @endforeach
			</tbody>
		    </table>
                </div>
            </div>
        </div>
    </main>
@include('footer')

  <div id="create-modal" class="modal">
    <form method="post" action="{{route('Admin.addAdmin')}}">
    <div class="modal-content">
      <h4>Add a new admin user</h4>
          @csrf
          <div class="container">
            <div class="row">
              <div class="input-field col m12">
		<i class="material-icons prefix">person</i>
                <input name="username_add" value="{{ old('username_add') }}" id="u_id" type="text" class="input-text validate @error('username_add') invalid @enderror" data-length="50" required>
                <label for="u_id">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col m12">
		<i class="material-icons prefix">fingerprint</i>
                <input name="password_add" id="p_id" type="password" class="validate @error('password_add') invalid @enderror" required>
                <label for="p_id">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col m12">
		<i class="material-icons prefix">fingerprint</i>
                <input name="password_confirm_add" id="pc_id" type="password" class="validate @error('password_confirm_add') invalid @enderror" required>
                <label for="pc_id">Confirm password</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="submit" href="#!" class="waves-effect waves-light btn blue darken-2">Add<i class="material-icons right">save</i></button>
      </div>
    </form>
  </div>

@foreach($admins as $admin)
  <div id="delete-modal-{{$admin->id}}" class="modal">
    <div class="modal-content">
      <h4>Delete admin</h4>
      <p>Are you really sure you want to delete <b>{{$admin->username}}</b> forever?</p>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <a href="#!" class="modal-close waves-effect waves-green btn grey">Cancel</a>
      <a href="{{route('Admin.deleteAdmin', ['id' => $admin->id])}}" class="modal-close"><button type="button" class="btn red darken-1"><i class="material-icons right">delete_forever</i>Delete now!</button></a>
    </div>
  </div>

  <div id="edit-modal-{{ $admin->id }}" class="modal">
    <form method="post" action="{{route('Admin.updateAdmin', ['id' => $admin->id] )}}">
    <input type="hidden" name="admin_id" value="{{$admin->id}}">
      <div class="modal-content">
        <h4>Edit {{ $admin->username }}</h4>
        @csrf
        <div class="contrainer">
          <div class="row">
            <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_update" placeholder="New password" id="p_id_{{$admin->id}}" type="password" class="validate @error('password_update') invalid @enderror" required>
              <label for="p_id_{{$admin->id}}">New password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_confirm_update" id="pc_id_{{$admin->id}}" placeholder="Confirm new password" type="password" class="validate @error('password_confirm_update') invalid @enderror" required>
              <label for="pc_id_{{$admin->id}}">Confirm new password</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="submit" href="#!" class="waves-effect waves-light btn blue darken-2"><i class="material-icons right">save</i>Save</button>
      </div>
    </form>
  </div>
@endforeach

<script>
$(document).ready(function(){
    $('.modal').modal();
    @if(old('username_add'))
    $('#create-modal').modal('open');
    @endif
    @if(old('password_update'))
    $('#edit-modal-{{old("admin_id")}}').modal('open');
    @endif
    $('select').formSelect();
    $('input.input-text').characterCounter();
  });

</script>

    </body>
</html>
