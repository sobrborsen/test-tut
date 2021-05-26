<!DOCTYPE html>
<html>

<head></head>

<body>
    <h1>Reverse</h1>
    <form method="get" action='/reverse'>
        <label>Indtast et tekst</label>
        <input name="text" size="50" value="{{ $text ?? '' }}">
        <button type="submit">Reverse</button>
    </form>

    @if($errors->any())
    <p style="color:red">Error: {{ $errors->first('text') }}</p>
    @endisset

    @isset($reversed)
    <p>Reversed: {{ $reversed }}</p>
    @endif
</body>

</html>
