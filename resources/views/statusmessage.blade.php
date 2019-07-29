@if(session('success'))
    <script>
        $(document).ready(function() {
	    M.toast({html: '{{ session("success") }}', displayLength: 6000, classes: 'blue'});
        });
    </script>
@endif

@if ($errors->any())
<script>
	$(document).ready(function() {
		@foreach ($errors->all() as $error)
		M.toast({html: '{{ $error }}', displayLength: 6000, classes: 'red darken-2'});
		@endforeach
	});
</script>

@endif
