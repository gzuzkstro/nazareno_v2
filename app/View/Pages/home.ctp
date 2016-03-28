<h2>Estadísticas del sistema</h2>
<table class="consulta">
    <tr>
        <td><input type="radio" id="del" name="consultar" value="del" checked><label for="del">Del</label></td>
        <td>
            <select id="delselect">
                <option value="dia">Día</option>
                <option value="mes">Mes</option>
                <option value="ano">Año</option>
                <option value="todos">Todos los tiempos</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><input type="radio" id="rango" name="consultar" value="rango"><label for="rango">Por Rango</label></td>
        <td>Desde <input type="text" id="desde"></td>
        <td>Hasta <input type="text" id="hasta"></td>
    </tr>
</table>
<br>
<center>
    <input type="button" value="Consultar" id="consultar-button">
</center>