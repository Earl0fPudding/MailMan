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
                    <h2>Username blacklist</h2>
		</div>
		<div class="col m2">
			<a class="waves-effect waves-light modal-trigger add-button" href="#create-modal"><ion-icon size="large" name="add-circle"></ion-icon></a>
		</div>
	    </div>
            <div class="row">
                <div class="col m12">
                    <table class="striped">
			<thead>
			    	<tr>
				    <th>Forbidden username</th>
				    <th>Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($forbidden_usernames as $forbidden_username)
				<tr>
					<td>{{ $forbidden_username->username }}</td>
					<td>
					    <a href="{{route('Admin.deleteForbiddenUsername', ['id' => $forbidden_username->id])}}"><button type="button" class="btn-flat">Delete</button></a>
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
		<input name="username_add" value="{{old('username_add')}}" data-length="50" id="u_id" type="text" class="validate input-text @error('username_add') invalid @enderror">
                <label for="u_id">Username</label>
	      </div>
	    </div>
	  </div>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" href="#!" class="waves-effect waves-light btn blue darken-2">Add</button>
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
