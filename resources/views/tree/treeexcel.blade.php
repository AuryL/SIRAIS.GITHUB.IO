<!-- <table>
    <thead>
        <tr>
            <th>Dominio</th>
            <th>Proceso</th>
            <th>Subproceso</th>
            <th>Riesgo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($riesgos as $riesgo)
        <tr>
            <td>{{ $riesgo[0] }}</td>
            <td>{{ $riesgo[1] }}</td>
            <td>{{ $riesgo[2] }}</td>
            <td>{{ $riesgo[3] }}</td>
        </tr>
        @endforeach
    </tbody>
</table> -->


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