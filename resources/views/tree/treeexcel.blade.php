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
        @for ($i = 0; $i < count($actividads); $i++)
            <tr>
                <td style="background-color:#EBDEF0;">{{ $actividads[$i][0] }}</td>
                <td style="background-color:#D4E6F1;">{{ $actividads[$i][1] }}</td>
                <td style="background-color:#D4EFDF;">{{ $actividads[$i][2] }}</td>
                <td style="background-color:#FCF3CF;">{{ $actividads[$i][3] }}</td>
                <td style="background-color:#F6DDCC;">{{ $actividads[$i][4] }}</td>
                <td style="background-color:#FFCDD2;">{{ $actividads[$i][5] }}</td>
            </tr>
        @endfor
    </tbody>
</table>