<div id="header">
    <h1>Recuperación de contraseña</h1>
</div>
<p>
    Has solicitado recuperar tu contraseña. Puedes establecer una nueva por medio del siguiente link
</p>
<p>
    <a href="{{ route('index.password.reset.token', ['id' => $id, 'tmp' => $tmp]) }}">{{ route('index.password.reset.token', ['id' => $id, 'tmp' => $tmp]) }}</a>
</p>

<style>
    #header {
        background-color: #2196f3;
        padding: 3px;
        color: #fff;
    }

    a {
        display: block;
        background-color: #eee;
        color: #2196f3;
        font-size: 20px;
        padding: 10px;
    }
</style>