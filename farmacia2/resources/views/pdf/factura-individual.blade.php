@php
    $cliente = $factura->cliente;
    $usuario = $factura->usuario;
    $detalles = $factura->detalles;
    $fechaEmision = $factura->fecha ? \Carbon\Carbon::parse($factura->fecha) : $factura->created_at;
    $horaEmision = $factura->created_at ? \Carbon\Carbon::parse($factura->created_at) : null;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $factura->id }}</title>
    <style>
        * {
            font-family: 'Montserrat', 'Segoe UI', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            color: #0f172a;
            background-color: #f8fafc;
        }

        .document {
            width: 100%;
            max-width: 820px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.15);
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.3);
        }

        .header {
            padding: 20px;
            background: linear-gradient(135deg, #1d4ed8 0%, #0f172a 100%);
            color: #ffffff;
            text-align: center;
            position: relative;
            margin-bottom: 10px;
        }


        .header-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 2px;
            margin: 5px 0;
        }

        .header-subtitle {
            font-size: 14px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.8);
            margin-top: 5px;
        }

        .section {
            padding: 30px;
        }

        .section-title {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
            color: #475569;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: linear-gradient(135deg, rgba(59,130,246,0.08), rgba(15,118,110,0.08));
            border: 1px solid rgba(30, 64, 175, 0.15);
            border-radius: 12px;
            padding: 16px;
        }

        .info-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .table thead {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.12), rgba(15, 118, 110, 0.12));
            color: #0f172a;
        }

        .table th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 16px;
            text-align: left;
        }

        .table td {
            padding: 14px 16px;
            font-size: 12px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .table tbody tr:nth-child(even) {
            background: rgba(248, 250, 252, 0.8);
        }

        .summary {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .summary-table {
            width: 220px;
            border-collapse: collapse;
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            overflow: hidden;
        }

        .summary-table td {
            padding: 10px 14px;
            font-size: 12px;
        }

        .summary-table tr:last-child {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.12), rgba(30, 64, 175, 0.12));
            font-weight: 800;
            font-size: 14px;
            color: #0f172a;
        }

        .footer {
            padding: 20px 30px 30px;
            text-align: center;
            font-size: 11px;
            color: #64748b;
            border-top: 1px solid rgba(148, 163, 184, 0.2);
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.8), rgba(236, 253, 245, 0.7));
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="document">
        <div class="header">
            <div class="header-title">Factura Electrónica</div>
            <div class="header-subtitle">Comprobante de Venta</div>
        </div>

        <div class="section">
            <div class="section-title">Detalles de la factura</div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Número de factura</div>
                    <div class="info-value">#{{ str_pad($factura->id, 6, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Fecha de emisión</div>
                    <div class="info-value">{{ optional($fechaEmision)->format('d/m/Y') }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Hora de emisión</div>
                    <div class="info-value">{{ optional($horaEmision)->format('H:i:s') }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Estado de envío</div>
                    <div class="info-value">
                        <span class="badge">{{ $factura->enviada_por_correo ? 'Enviada por correo' : 'No enviada' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Información del cliente</div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Nombre completo</div>
                    <div class="info-value">{{ $cliente->nombre }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Correo electrónico</div>
                    <div class="info-value">{{ $cliente->correo ?? 'No registrado' }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Teléfono</div>
                    <div class="info-value">{{ $cliente->telefono ?? 'No registrado' }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Atendido por</div>
                    <div class="info-value">{{ $usuario->nombre }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Detalle de productos</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="summary">
                <table class="summary-table">
                    <tr>
                        <td>Subtotal</td>
                        <td style="text-align:right;">${{ number_format($detalles->sum('subtotal'), 2) }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td style="text-align:right;">${{ number_format($factura->total, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            Sistema de Gestión de Farmacia · Documento generado automáticamente · {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</body>
</html>