<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Georgia, 'Times New Roman', serif; background: #fff; }
        .cert {
            position: relative; margin: 30px auto; padding: 60px 70px 40px;
            border: 3px double #09164a; border-radius: 6px;
            background: linear-gradient(180deg, #fdfdff 0%, #f2f6ff 100%);
        }
        .corner { position: absolute; width: 46px; height: 46px; border-color: #a63b00; border-style: solid; }
        .tl { top: 12px; left: 12px; border-width: 3px 0 0 3px; border-radius: 8px 0 0 0; }
        .tr { top: 12px; right: 12px; border-width: 3px 3px 0 0; border-radius: 0 8px 0 0; }
        .bl { bottom: 12px; left: 12px; border-width: 0 0 3px 3px; border-radius: 0 0 0 8px; }
        .br { bottom: 12px; right: 12px; border-width: 0 3px 3px 0; border-radius: 0 0 8px 0; }
        .org { text-align: center; color: #09164a; font-size: 26px; font-weight: bold; letter-spacing: 3px; }
        .org-sub { text-align: center; color: #767680; font-size: 11px; letter-spacing: 2px; margin-bottom: 28px; }
        .title { text-align: center; color: #a63b00; font-size: 34px; letter-spacing: 4px; margin: 10px 0 6px; text-transform: uppercase; }
        .presented { text-align: center; color: #45464f; font-style: italic; font-size: 14px; margin: 22px 0 8px; }
        .recipient { text-align: center; color: #09164a; font-size: 32px; font-style: italic; border-bottom: 2px solid #b9c3ff; display: block; max-width: 480px; margin: 0 auto; padding: 0 20px 6px; }
        .reason { text-align: center; color: #45464f; font-size: 13.5px; line-height: 1.7; max-width: 600px; margin: 20px auto 0; }
        .meta { text-align: center; margin-top: 8px; font-size: 11px; color: #767680; letter-spacing: 1px; }
        .bottom { display: table; width: 100%; margin-top: 44px; }
        .col { display: table-cell; vertical-align: bottom; text-align: center; }
        .line { border-top: 1.5px solid #767680; width: 170px; margin: 42px auto 6px; }
        .label { font-size: 11px; color: #45464f; letter-spacing: 1px; }
        .seal { width: 92px; height: 92px; margin: 0 auto 4px; border: 2px dashed #a63b00; border-radius: 9999px; text-align: center; color: #a63b00; font-size: 9px; padding-top: 36px; letter-spacing: 1px; }
        .num { font-family: 'Courier New', monospace; font-size: 11px; color: #09164a; letter-spacing: 1px; }
    </style>
</head>
<body>
<div class="cert">
    <div class="corner tl"></div><div class="corner tr"></div><div class="corner bl"></div><div class="corner br"></div>

    <img src="" alt="" hidden>
    <div style="text-align:center; margin-bottom: 8px;">
        <svg width="54" height="54" viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#09164a"/><path d="M12 21C7 17 4.5 13.5 4.5 10A7.5 7.5 0 0 1 19.5 10c0 3.5-2.5 7-7.5 11Z" fill="#a63b00"/></svg>
    </div>

    <div class="org">HUM HAIN NA FOUNDATION</div>
    <div class="org-sub">{{ $settings['reg_number'] ? 'REGISTERED NGO · REG. NO. '.strtoupper($settings['reg_number']) : 'REGISTERED NON-GOVERNMENT ORGANIZATION' }}</div>

    @php($typeLabel = \App\Models\Certificate::TYPES[$certificate->type] ?? ucfirst($certificate->type))
    <div class="title">Certificate of {{ explode(' ', $typeLabel, 2)[1] ?? 'Participation' }}</div>

    <p class="presented">This certificate is proudly presented to</p>
    <div class="recipient">{{ $certificate->recipient_name }}</div>

    <p class="reason">
        @php($typeName = strtolower($typeLabel))
        in recognition of
        @if ($certificate->duration)<strong>{{ $certificate->duration }}</strong> of @endif
        @switch($certificate->type)
            @case('participation') sincere participation @break
            @case('appreciation') dedicated and consistent contribution @break
            @case('collaboration') valuable collaboration with the Foundation @break
            @case('achievement') outstanding achievement and exemplary service @break
            @default('internship') successful completion of internship @endswitch
        @if ($certificate->reason) — <strong>{{ $certificate->reason }}</strong>@endif.
    </p>

    <p class="meta">
        Certificate No: <span class="num">{{ $certificate->certificate_number }}</span> &nbsp;·&nbsp; Issued on {{ $certificate->issued_on->format('d F Y') }}
    </p>

    <div class="bottom">
        <div class="col">
            <img src="{{ $qr }}" width="72" height="72" alt=""><br/>
            <span class="label">Scan to verify authenticity</span>
        </div>
        <div class="col">
            <div class="seal">OFFICIAL SEAL</div>
        </div>
        <div class="col">
            <div class="line"></div>
            <span class="label">{{ $certificate->signatory_name ?? ($settings['signatory_name'] ?? 'Authorized Signatory') }}<br/>{{ $certificate->signatory_designation ?? ($settings['signatory_designation'] ?? 'Secretary, Hum Hain Na Foundation') }}</span>
        </div>
    </div>
</div>
</body>
</html>
