<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Invites</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
	    <div class="row">
		<div class="col m10">
                    <h2>Invites</h2>
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
				    <th>Invite link</th>
				    <th>Name preset</th>
				    <th>Domain</th>
				    <th>Date of termination</th>
				    <th>Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($invites as $invite)
				<tr>
					<td><a href="{{ route('Login.processInvite', [ 'token' => $invite->token ]) }}">Link</a></td>
					<td> @if($invite->name_preset === NULL) - @else {{ $invite->name_preset }} @endif </td>
					<td>{{ $invite->domain->name }}</td>
					<td>{{ $invite->termination_date }} <!-- @if(strtotime($invite->terminaiton_date)>strtotime(date('Y-m-d H:i:s'))) <span class="green-text">Active</span> @else <span class="red-text">Expired</span> @endif --></td>
					<td>
					    <a href="{{route('Admin.deleteInvite', ['id' => $invite->id])}}"><button type="button" class="btn-flat">Delete</button></a>
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
    <form method="post" action="{{route('Admin.addInvite')}}">
    <div class="modal-content">
      <h4>Add a new invite</h4>
	  @csrf
	  <div class="container">
	    <div class="row">
	      <div class="input-field col m12">
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
		<input name="name_preset" id="p_id" type="text" class="validate">
                <label for="p_id">Name preset (optional)</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col m6">
		<input type="text" value="{{ date('Y-m-d') }}" class="datepicker" name="termination_date" id="td_id" required>
		<label for="td_id">Date of termination</label>
	      </div>
	      <div class="input-field col m6">
                <input type="text" value="" class="timepicker" name="termiantion_time" id="tt_id" required>
                <label for="tt_id">Time of termination</label>
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
    $('.datepicker').datepicker({
                monthsFull: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                weekdays: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
		weekdaysShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                selectMonths: true,
                selectYears: 15,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: false,
                format: 'yyyy-mm-dd',
                firstDay: 1
            });
    $('.timepicker').timepicker({
		twelveHour: false
    });
  });

</script>
    </body>
</html>
