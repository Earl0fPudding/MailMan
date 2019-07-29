@if(session('success'))
    <script>
        $(document).ready(function() {
	    M.toast({html: '{{ session("success") }}', displayLength: 5000, classes: 'blue darken-2'});
        });
    </script>
@endif

@if ($errors->any())
<script>
	$(document).ready(function() {
		@foreach ($errors->all() as $error)
		M.toast({html: '{{ $error }}', displayLength: 5000, classes: 'red darken-2'});
		@endforeach
	});
</script>

@endif
