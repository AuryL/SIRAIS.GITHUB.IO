<table>
    <thead>
        <tr>
            <th>Dominio</th>
            <th>Proceso</th>
            <th>Subproceso</th>
            <th>Riesgo</th>
            <th>Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach($controls as $control)
        <tr>
            <td>{{ $control[0] }}</td>
            <td>{{ $control[1] }}</td>
            <td>{{ $control[2] }}</td>
            <td>{{ $control[3] }}</td>
            <td>{{ $control[4] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>