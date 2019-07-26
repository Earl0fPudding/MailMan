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
		<div class="col m10">
                    <h2>Aliases</h2>
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
				    <th>Source address</th>
				    <th>Destination address</th>
				    <th>Options</th>
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
    						 <select name="user_id" form="edit_form_{{ $alias->id }}">
						    @foreach($users as $user)
      						     <option value="{{ $user->id }}" @if($alias->destination_user_id==$user->id) selected @endif>{{ $user->username.'@'.$user->domain->name }}</option>
						    @endforeach
    						 </select>
  					     </div>
					</td>
					<td>
					    <button type="submit" form="edit_form_{{ $alias->id }}" class="btn-flat">Save</button>
					    <a href="{{route('Admin.deleteAlias', ['id' => $alias->id])}}"><button type="button" class="btn-flat">Delete</button></a>
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
                <input name="username" id="u_id" type="text" class="validate" required>
                <label for="u_id">Username</label>
              </div>
              <div class="col m1 valign-wrapper s2">
                <h5>@</h5>
              </div>
              <div class="input-field col m5 s10">
                <select id="d_id" name="domain_id">
                  <option value="" disabled selected>Choose a domain</option>
                @foreach($domains as $domain)
                  <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                @endforeach
                </select>
                <label for="d_id">Domain</label>
              </div>
            </div>
	    <div class="row">
	      <div class="input-field col m12">
		<select name="user_id">
		  <option value="" selected disabled>Choose a domain</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->username.'@'.$user->domain->name }}</option>
                @endforeach
                </select>
	      </div>
	    </div>
	  </div>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" href="#!" class="modal-close waves-effect waves-light btn blue darken-2">Add</button>
    </div>
    </form>
  </div>

<script>
$(document).ready(function(){
    $('.modal').modal();
    $('select').formSelect();
  });

</script>
    </body>
</html>
