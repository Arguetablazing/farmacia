@php
    $totalFacturas = $facturas->count();
    $totalMonto = $facturas->sum('total');
    $enviadas = $facturas->where('enviada_por_correo', true)->count();
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Facturas</title>
    <style>
        * {
            font-family: 'Montserrat', 'Segoe UI', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            color: #0f172a;
            background-color: #f8fafc;
        }

        .header {
            text-align: center;
            padding: 25px 0 20px;
            border-bottom: 4px solid #1d4ed8;
            background: linear-gradient(135deg, rgba(29, 78, 216, 0.1), rgba(15, 23, 42, 0.05));
        }


        .title {
            font-size: 28px;
            font-weight: 800;
            margin: 0 0 8px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #1d4ed8;
        }

        .subtitle {
            font-size: 14px;
            color: #475569;
            margin-bottom: 5px;
        }

        .meta {
            margin-bottom: 25px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(37,99,235,0.08), rgba(14,116,144,0.08));
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .meta-item {
            text-align: center;
        }

        .meta-item span {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 1px;
        }

        .meta-item strong {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(15, 23, 42, 0.1);
        }

        thead {
            background: linear-gradient(135deg, #1d4ed8, #0f172a);
            color: #ffffff;
        }

        th {
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 14px 10px;
            text-align: left;
        }

        td {
            padding: 16px 10px;
            font-size: 12px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        tr:nth-child(even) {
            background: rgba(148, 163, 184, 0.08);
        }

        .factura-header {
            font-weight: 700;
            font-size: 14px;
            color: #1d4ed8;
        }

        .detalle-table {
            margin-top: 10px;
            width: 100%;
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .detalle-table th,
        .detalle-table td {
            padding: 10px;
            font-size: 11px;
        }

        .detalle-table thead {
            background: rgba(37, 99, 235, 0.1);
            color: #0f172a;
        }

        .footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid rgba(15, 23, 42, 0.1);
            font-size: 11px;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Reporte General de Facturas</div>
        <div class="subtitle">Generado el {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="meta">
        <div class="meta-item">
            <span>Total de facturas</span>
            <strong>{{ $totalFacturas }}</strong>
        </div>
        <div class="meta-item">
            <span>Ingresos acumulados</span>
            <strong>${{ number_format($totalMonto, 2) }}</strong>
        </div>
        <div class="meta-item">
            <span>Enviadas por correo</span>
            <strong>{{ $enviadas }}</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
                <tr>
                    <td class="factura-header">Factura #{{ $factura->id }}</td>
                    <td>{{ $factura->cliente->nombre }}</td>
                    <td>{{ $factura->usuario->nombre }}</td>
                    <td>{{ optional($factura->fecha)->format('d/m/Y') ?? $factura->created_at->format('d/m/Y') }}</td>
                    <td>${{ number_format($factura->total, 2) }}</td>
                    <td>{{ $factura->enviada_por_correo ? 'Enviada' : 'Sin enviar' }}</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table class="detalle-table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($factura->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Sistema de Gestión de Farmacia &bull; Reporte generado automáticamente.
    </div>
</body>
</html>