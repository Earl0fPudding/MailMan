<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Username blacklist</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
	    <div class="row">
		<div class="col m10">
                    <h3><i class="material-icons">pan_tool</i> Username blacklist</h3>
		    <p>Usernames which are not possible to sign up a new account with. Admins are allowed to create mail users with those names tho.</p>
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
				    <th><i class="material-icons tiny">local_offer</i> Forbidden username</th>
				    <th><i class="material-icons tiny">build</i> Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($forbidden_usernames as $forbidden_username)
				<tr>
					<td>{{ $forbidden_username->username }}</td>
					<td>
					    <a href="{{route('Admin.deleteForbiddenUsername', ['id' => $forbidden_username->id])}}"><button type="button" class="btn-flat"><i class="material-icons red-text darken-1">delete_forever</i></button></a>
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
    <form method="post" action="{{route('Admin.addForbiddenUsername')}}">
    <div class="modal-content">
      <h4>Add a new forbidden username</h4>
	  @csrf
	  <div class="container">
	    <div class="row">
	      <div class="input-field col m12">
		<i class="material-icons prefix">local_offer</i>
		<input name="username_add" value="{{old('username_add')}}" data-length="50" id="u_id" type="text" class="validate input-text @error('username_add') invalid @enderror">
                <label for="u_id">Username</label>
	      </div>
	    </div>
	  </div>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" href="#!" class="waves-effect waves-light btn blue darken-2">Add <i class="material-icons right">save</i></button>
    </div>
    </form>
  </div>

<script>
$(document).ready(function(){
    $('.modal').modal();
    @if(old('username_add'))
    $('#create-modal').modal('open');
    @endif
    $('input.input-text').characterCounter();
  });

</script>
    </body>
</html>
