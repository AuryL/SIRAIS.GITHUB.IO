<table>
    <thead>
        <tr>
            <th  style="background-color:#F52727;">Nombre del Dominio</th>
            <th  style="background-color:#F52727;">Nombre del Proceso clave</th>
            <th  style="background-color:#F52727;">Nombre del Subproceso</th>
            <th  style="background-color:#F52727;">Riesgo inherente</th>
            <th  style="background-color:#F52727;">Objetivo de Control</th>
            <th  style="background-color:#F52727;">Respuesta al riesgo (Actividad de control)</th>
            <th  style="background-color:#3136E2;">Impacto (1-4)</th>
            <th  style="background-color:#3136E2;">Probabilidad de ocurrencia (1-4)</th>
            <th  style="background-color:#3136E2;">Clasificación del riesgo (A,M.B)</th>
            <th  style="background-color:#3136E2;">Se incluye en alcance</th>
            <th  style="background-color:#3136E2;">Comentarios en caso de no incluirse en el alcance</th>
            <th  style="background-color:#3136E2;">Equipo de Auditoría responsable</th>
            <th  style="background-color:#3136E2;">Script de Prueba</th>
            <th  style="background-color:#3136E2;">Referencia en TeamMate</th>
            <th  style="background-color:#3136E2;">¿El diseño del control es adecuado? </th>
            <th  style="background-color:#3136E2;">¿Se probará el control ?</th>
            <th  style="background-color:#3136E2;">Conclusión sobre la efectividad del diseño</th>
            <th  style="background-color:#3136E2;">Conclusión sobre la efectividad de la operación</th>
            <th  style="background-color:#3136E2;">Referencia de RAP / RAI /Observación</th>
        </tr>
    </thead>
    <tbody>      
        @foreach($actividads as $actividad)
            <tr>
                <td style="background-color:#EBDEF0;">{{ $actividad[0] }}</td>
                <td style="background-color:#D4E6F1;">{{ $actividad[1] }}</td>
                <td style="background-color:#D4EFDF;">{{ $actividad[2] }}</td>
                <td style="background-color:#FCF3CF;">{{ $actividad[3] }}</td>
                <td style="background-color:#F6DDCC;">{{ $actividad[4] }}</td>
                <td style="background-color:#FFCDD2;">{{ $actividad[5] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>