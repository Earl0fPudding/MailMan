<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Aliases</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
	    <div class="row">
		<div class="col m10 s9">
                    <h3><i class="material-icons">compare_arrows</i> Aliases</h3>
		    <p>Certain incoming mails can be forwaded to a specific existing mail account.</p>
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
				    <th><i class="material-icons tiny">file_upload</i> Source address</th>
				    <th><i class="material-icons tiny">file_download</i> Destination address</th>
				    <th><i class="material-icons tiny">build</i> Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($aliases as $alias)
				<tr>
					<form method="post" id="edit_form_{{ $alias->id }}" action="{{route('Admin.updateAlias', ['id' => $alias->id])}}"></form>
					<td>{{ $alias->source_username.'@'.$alias->domain->name }}</td>
					<td>
					     <div class="input-field col m7">
					         <input type="hidden" name="_token" form="edit_form_{{ $alias->id }}" value="{{ csrf_token() }}">
    						 <select name="user_id_update" form="edit_form_{{ $alias->id }}">
						    @foreach($users as $user)
      						     <option value="{{ $user->id }}" @if($alias->destination_user_id==$user->id) selected @endif>{{ $user->username.'@'.$user->domain->name }}</option>
						    @endforeach
    						 </select>
  					     </div>
					</td>
					<td>
					    <button type="submit" form="edit_form_{{ $alias->id }}" class="btn-flat"><i class="material-icons">save</i></button>
					    <a href="{{route('Admin.deleteAlias', ['id' => $alias->id])}}"><button type="button" class="btn-flat"><i class="material-icons red-text darken-1">delete_forever</i></button></a>
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
    <form method="post" action="{{route('Admin.addAlias')}}">
    <div class="modal-content">
      <h4>Add a new alias</h4>
	  @csrf
	  <div class="container">
	    <div class="row">
              <div class="input-field col m6 s12">
		<i class="material-icons prefix">person</i>
                <input name="username_add" value="{{ old('username_add') }}" id="u_id" type="text" class="validate input-text @error('username_add') invalid @enderror" data-length="50" required>
                <label for="u_id">Username</label>
              </div>
              <div class="input-field col m6 s12">
		<i class="material-icons prefix">@</i>
                <select id="d_id" name="domain_id_add">
                  @if(sizeof($domains)==0) <option value="" disabled selected>No domains available</option> @endif
                @foreach($domains as $domain)
                  <option value="{{ $domain->id }}" @if(old('domain_id_add')==$domain->id) selected @endif>{{ $domain->name }}</option>
                @endforeach
                </select>
                <label for="d_id">Domain</label>
              </div>
            </div>
	    <div class="row">
	      <div class="input-field col m12">
		<i class="material-icons prefix">email</i>
		<select name="user_id_add" id="user_id_add">
		 @if(sizeof($users)==0) <option value="" selected disabled>No mail address available</option> @endif
                @foreach($users as $user)
                  <option value="{{ $user->id }}" @if(old('user_id_add')==$user->id) selected @endif>{{ $user->username.'@'.$user->domain->name }}</option>
                @endforeach
                </select>
		<label for="user_id">Destination address</label>
	      </div>
	    </div>
	  </div>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" href="#!" class="waves-effect waves-light btn blue darken-2"><i class="material-icons right">save</i>Add</button>
    </div>
    </form>
  </div>

<script>
$(document).ready(function(){
    $('.modal').modal();
    @if(old('username_add'))
    $('#create-modal').modal('open');
    @endif
    $('select').formSelect();
    $('input.input-text').characterCounter();
  });

</script>
<script src="{{asset('js/mailman.js')}}"></script>
    </body>
</html>
