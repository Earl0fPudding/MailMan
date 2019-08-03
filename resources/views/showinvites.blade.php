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
                    <h3><i class="material-icons">person_add</i> Invites</h3>
		    <p>Create and share invitations with specific people so they can sign up to domains that are otherwise not registerable.</p>
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
				    <th><i class="material-icons tiny">link</i> Invite link</th>
				    <th><i class="material-icons tiny">person</i> Name preset</th>
				    <th><i class="material-icons tiny">language</i> Domain</th>
				    <th><i class="material-icons tiny">access_time</i> Date of termination</th>
				    <th><i class="material-icons tiny">build</i> Options</th>
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
					    <a href="{{route('Admin.deleteInvite', ['id' => $invite->id])}}"><button type="button" class="btn-flat"><i class="material-icons red-text darken-1">delete_forever</i></button></a>
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
		<i class="material-icons prefix">language</i>
		<select id="d_id" name="domain_id_add">
                  @if(sizeof($domains)==0) <option value="" disabled selected>No domains available</option> @endif
                  @foreach($domains as $domain)
                    <option value="{{ $domain->id }}" @if(old('domain_id_add')==$domain->id) selected @endif >{{ $domain->name }}</option>
                  @endforeach
                </select>
                <label for="d_id">Domain</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col m12">
		<i class="material-icons prefix">person</i>
		<input name="name_preset_add" value="{{ old('name_preset_add') }}" id="p_id" type="text" class="validate input-text @error('name_preset_add') invalid @enderror" data-length="50">
                <label for="p_id">Name preset (optional)</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col m6">
		<i class="material-icons prefix">date_range</i>
		<input type="text" @if(old('termination_date_add')) value="{{old('termination_date_add')}}" @else value="{{ date('Y-m-d') }}" @endif class="datepicker @error('termination_date_add') invalid @enderror" name="termination_date_add" id="td_id" required>
		<label for="td_id">Date of termination</label>
	      </div>
	      <div class="input-field col m6">
		<i class="material-icons prefix">access_time</i>
                <input type="text" value="{{old('termination_time_add')}}" class="timepicker @error('termination_time_add') invalid @enderror" name="termination_time_add" id="tt_id" required>
                <label for="tt_id">Time of termination</label>
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
    @if(old('domain_id_add'))
    $('#create-modal').modal('open');
    @endif
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
    $('input.input-text').characterCounter();
  });

</script>
<script src="{{asset('js/mailman.js')}}"></script>
    </body>
</html>
