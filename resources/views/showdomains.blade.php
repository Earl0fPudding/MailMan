<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Domains</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
	    <div class="row">
		<div class="col m10">
                    <h2>Domains</h2>
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
				    <th>Domain name</th>
				    <th>Registerable</th>
				    <th>Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($domains as $domain)
				<tr>
				  <form method="post" id="edit_form_{{ $domain->id }}" action="{{route('Admin.updateDomain', ['id' => $domain->id])}}"></form>
					<td>{{ $domain->name }}</td>
					<td>
					     <div class="input-field col m2">
					         <input type="hidden" name="_token" form="edit_form_{{ $domain->id }}" value="{{ csrf_token() }}">
    						 <select name="registerable_update" form="edit_form_{{ $domain->id }}">
      						     <option value="0" @if($domain->registerable==0) selected @endif>No</option>
      						     <option value="1" @if($domain->registerable==1) selected @endif>Yes</option>
    						 </select>
  					     </div>
					</td>
					<td>
					    <button type="submit" form="edit_form_{{ $domain->id }}" class="btn-flat">Save</button>
					    <a href="{{route('Admin.deleteDomain', ['id' => $domain->id])}}"><button type="button" class="btn-flat">Delete</button></a>
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
    <form method="post" action="{{route('Admin.addDomain')}}">
    <div class="modal-content">
      <h4>Add a new domain</h4>
	  @csrf
	  <div class="container">
	    <div class="row">
	      <div class="input-field col m12">
		<input name="name_add" data-length="70" id="n_id" value="{{ old('name_add') }}" type="text" placeholder="example.com" class="validate input-text @error('name_add') invalid @enderror" required>
		<label for="n_id">Domain name</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col m12">
		<p>
                  <label for="r_id">
        	    <input type="checkbox" name="registerable_add" id="r_id" class="validate" value="1" @if(old('registerable_add')) checked @endif>
        	    <span>Registerable</span>
                  </label>
                </p>
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
    $('select').formSelect();
    $('input.input-text').characterCounter();
    @if(old('name_add'))
    $('#create-modal').modal('open');
    @endif
  });

</script>
    </body>
</html>
