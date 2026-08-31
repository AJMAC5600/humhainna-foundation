<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Volunteer ID Card</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Helvetica, Arial, sans-serif; background: #fff; }
        .card { width: 400px; margin: 20px auto; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 8px rgba(9,22,74,.25); page-break-inside: avoid; }
        .head { background: linear-gradient(135deg, #09164a 0%, #505b91 100%); padding: 16px 20px; position: relative; }
        .org { color: #fff; font-size: 15px; font-weight: bold; letter-spacing: 1.5px; }
        .sub { color: rgba(255,255,255,.75); font-size: 10px; letter-spacing: 1px; margin-top: 2px; }
        .body { display: table; width: 100%; padding: 18px 20px 20px; background: #fff; }
        .left { display: table-cell; vertical-align: top; }
        .right { display: table-cell; vertical-align: top; text-align: right; width: 96px; }
        .photo { width: 86px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #dce9ff; }
        .ph-box { width: 86px; height: 100px; border-radius: 8px; border: 2px dashed #c6c5d0; text-align: center; color: #767680; font-size: 9px; padding-top: 42px; }
        .name { font-size: 19px; font-weight: bold; color: #0b1c30; margin-bottom: 1px; }
        .role { color: #a63b00; font-size: 10.5px; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 12px; }
        table.kv { border-collapse: collapse; }
        table.kv td { padding: 3px 12px 3px 0; font-size: 11px; vertical-align: top; }
        td.k { color: #767680; white-space: nowrap; }
        td.v { color: #0b1c30; font-weight: bold; }
        td.v.blood { color: #EF4444; }
        .qr-label { font-size: 8.5px; color: #767680; margin-top: 4px; }
        .foot { background: #eff4ff; padding: 12px 20px; font-size: 9.5px; color: #45464f; line-height: 1.55; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <div class="org">HUM HAIN NA FOUNDATION</div>
            <div class="sub">OFFICIAL VOLUNTEER IDENTITY CARD</div>
            @if (!empty($settings['helpline']))
                <div style="position:absolute;top:16px;right:20px;text-align:right;color:#93f2f2;font-size:9px;">HELPLINE<br><b>{{ $settings['helpline'] }}</b></div>
            @endif
        </div>
        <div class="body">
            <div class="right">
                <div style="margin-bottom:10px;">
                    @if ($volunteer->photo_path)
                        <img src="{{ public_path('storage/'.$volunteer->photo_path) }}" alt="" class="photo">
                    @else
                        <div class="ph-box">PHOTO</div>
                    @endif
                </div>
                <img src="{{ $qr }}" width="78" height="78" alt="">
                <div class="qr-label">Scan to verify</div>
            </div>
            <div class="left">
                <div class="name">{{ strtoupper($volunteer->full_name) }}</div>
                <div class="role">{{ ucfirst($volunteer->gender ?? '') }} Volunteer</div>
                <table class="kv">
                    <tr><td class="k">Volunteer ID</td><td class="v" style="font-family:'Courier New',monospace;">{{ $volunteer->volunteer_id }}</td></tr>
                    <tr><td class="k">Date of Birth</td><td class="v">{{ optional($volunteer->dob)->format('d-m-Y') }}</td></tr>
                    <tr><td class="k">Blood Group</td><td class="v blood">{{ $volunteer->blood_group ?: '—' }}</td></tr>
                    <tr><td class="k">Mobile</td><td class="v">{{ $volunteer->mobile }}</td></tr>
                    <tr><td class="k">Valid From</td><td class="v">{{ optional($volunteer->valid_from)->format('d-m-Y') }}</td></tr>
                    <tr><td class="k">Valid Till</td><td class="v">{{ optional($volunteer->valid_till)->format('d-m-Y') }}</td></tr>
                </table>
            </div>
        </div>
        <div class="foot">
            <b>If found, please contact:</b> Hum Hain Na Foundation
            @if (!empty($settings['email'])) · {{ $settings['email'] }}@endif
            @if (!empty($settings['phone'])) · {{ $settings['phone'] }}@endif
            @if (!empty($settings['address']))<br>{{ \Illuminate\Support\Str::limit(preg_replace('/\s+/', ' ', strip_tags($settings['address'])), 110) }}@endif
            <br>This card is the property of Hum Hain Na Foundation and must be carried during official activities.
        </div>
    </div>
</body>
</html>
