<!DOCTYPE html>
<html>
<form method="post" action=" {{ url('getLatLong') }}">
<input type="text" name="address">
<input type="submit" name="submit" value="submit">
{{ csrf_field() }}
</form>
</html>
