<table>
    <thead>
        <tr>
            <th>Dominio</th>
            <th>Proceso</th>
            <th>Subproceso</th>
            <th>Riesgo</th>
            <th>Control</th>
            <th>Actividad</th>
        </tr>
    </thead>
    <tbody>      
        @foreach($actividads as $actividad)
        <tr>
            <td>{{ $actividad[0] }}</td>
            <td>{{ $actividad[1] }}</td>
            <td>{{ $actividad[2] }}</td>
            <td>{{ $actividad[3] }}</td>
            <td>{{ $actividad[4] }}</td>
            <td>{{ $actividad[5] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>