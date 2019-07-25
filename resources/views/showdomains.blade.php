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
                    <table class="responsive-table striped">
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
					<td>{{ $domain->name }}</td>
					<td>{{ $domain->registerable }}</td>
					<td>...</td>
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
		<input name="name" id="n_id" type="text" placeholder="example.com" class="validate" required>
		<label for="n_id">Domain name</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col m12">
		<p>
                  <label for="r_id">
        	    <input type="checkbox" name="registerable" id="r_id" class="validate" required>
        	    <span>Registerable</span>
                  </label>
                </p>
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
  });

</script>
    </body>
</html>
