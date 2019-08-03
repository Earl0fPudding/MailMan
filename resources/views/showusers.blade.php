<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Users</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
	    <div class="row">
		<div class="col m10 s9">
                    <h3><i class="material-icons">person</i> Mail users</h3>
		    <p>Useres which have their own mailboxes and are able to log in to a mail client to send and receive mails.</p>
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
				    <th><i class="material-icons tiny">language</i> Domain</th>
				    <th><i class="material-icons tiny">build</i> Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($users as $user)
				<tr>
					<td>{{ $user->username }}</td>
					<td>{{ $user->domain->name }}</td>
					<td>
					    <a class="waves-effect waves-light btn-flat modal-trigger" href="#edit-modal-{{ $user->id }}"><i class="material-icons">edit</i></a>
					    <a href="#delete-modal-{{$user->id}}" class="modal-trigger"><button type="button" class="btn-flat"><i class="material-icons">delete</i></button></a>
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
    <form method="post" action="{{route('Admin.addUser')}}">
    <div class="modal-content">
      <h4>Add a new mail user</h4>
          @csrf
          <div class="container">
            <div class="row">
              <div class="input-field col m6 s12">
	      <i class="material-icons prefix">person</i>
              <input name="username" id="u_id" type="text" data-length="50" value="{{ old('username') }}" class="validate input-text @error('username') invalid @enderror" required>
              <label for="u_id">Username</label>
          </div>
          <div class="input-field col m6 s12">
	      <i class="material-icons prefix">@</i>
              <select id="d_id" name="domain_id">
                  @if(sizeof($domains)==0) <option value="" disabled selected>No domains available</option> @endif
		  @foreach($domains as $domain)
		    <option value="{{ $domain->id }}" @if(old('domain_id')==$domain->id) selected @endif  >{{ $domain->name }}</option>
		  @endforeach
              </select>
              <label for="d_id">Domain</label>
          </div>

            </div>
            <div class="row">
          <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password" id="p_id" type="password" class="validate @error('password') invalid @enderror" required>
              <label for="p_id">Password</label>
          </div>
      </div>
      <div class="row">
          <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_confirm" id="pc_id" type="password" class="validate @error('password_confirm') invalid @enderror" required>
              <label for="pc_id">Confirm password</label>
          </div>
      </div>
          </div>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" href="#!" class="waves-effect waves-light btn blue darken-2"><i class="material-icons right">save</i>Add</button>
    </div>
    </form>
  </div>

@foreach($users as $user)
  <div id="delete-modal-{{$user->id}}" class="modal">
    <div class="modal-content">
      <h4>Delete user</h4>
      <p>Are you really sure you want to delete <b>{{$user->username.'@'.$user->domain->name}}</b> forever?</p>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <a href="#!" class="modal-close waves-effect waves-green btn grey">Cancel</a>
      <a href="{{route('Admin.deleteUser', ['id' => $user->id])}}" class="modal-close"><button type="button" class="btn red darken-1"><i class="material-icons right">delete_forever</i>Delete now!</button></a>
    </div>
  </div>

  <div id="edit-modal-{{ $user->id }}" class="modal">
    <form method="post" action="{{route('Admin.updateUser', ['id' => $user->id] )}}">
	<input type="hidden" name="user_id" value="{{$user->id}}">
      <div class="modal-content">
        <h4>Edit {{ $user->username.'@'.$user->domain->name }}</h4>
        @csrf
        <div class="contrainer">
          <div class="row">
            <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_update" placeholder="New password" id="p_id_{{$user->id}}" type="password" class="validate @error('password_update') invalid @enderror" required>
              <label for="p_id_{{$user->id}}">New password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col m12">
	      <i class="material-icons prefix">fingerprint</i>
              <input name="password_confirm_update" id="pc_id_{{$user->id}}" placeholder="Confirm new password" type="password" class="validate @error('password_confirm_update') invalid @enderror" required>
              <label for="pc_id_{{$user->id}}">Confirm new password</label>
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
    $('select').formSelect();
    $('input.input-text').characterCounter();
    @if(old('username'))
    $('#create-modal').modal('open');
    @endif
    @if(old('user_id'))
    $('#edit-modal-{{old("user_id")}}').modal('open');
    @endif
  });

</script>
<script src="{{asset('js/mailman.js')}}"></script>
    </body>
</html>
