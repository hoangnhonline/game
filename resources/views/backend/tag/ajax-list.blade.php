@if( $tagArr->count() > 0)
	@foreach( $tagArr as $value )
	<option value="{{ $value->id }}" {{ ($tagSelected) && in_array($value->id, $tagSelected) ? "selected" : "" }}>{{ $value->name }}</option>
	@endforeach
@endif