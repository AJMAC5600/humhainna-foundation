<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Donation Receipt</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Helvetica, Arial, sans-serif; color: #0b1c30; }
        .sheet { max-width: 640px; margin: 24px auto; border: 1px solid #dce9ff; border-radius: 10px; overflow: hidden; }
        .head { background: #09164a; color: #fff; padding: 22px 28px; }
        .org { font-size: 18px; font-weight: bold; letter-spacing: 2px; }
        .tag { font-size: 10px; opacity: .75; letter-spacing: 1px; margin-top: 3px; }
        .body { padding: 26px 28px; background: #fff; }
        h2 { color: #09164a; font-size: 16px; letter-spacing: 1px; margin-bottom: 14px; }
        table.kv { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.kv td { padding: 7px 0; font-size: 12.5px; border-bottom: 1px solid #eff4ff; }
        td.k { color: #767680; width: 42%; }
        td.v { font-weight: bold; text-align: right; }
        .amount-box { background: #eff4ff; border: 1px solid #b9c3ff; border-radius: 8px; padding: 14px 18px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .amount { font-size: 22px; font-weight: bold; color: #09164a; }
        .note { font-size: 10.5px; color: #45464f; line-height: 1.65; }
        .foot { padding: 14px 28px 20px; font-size: 10px; color: #767680; line-height: 1.6; }
    </style>
</head>
<body>
<div class="sheet">
    <div class="head">
        <div class="org">HUM HAIN NA FOUNDATION</div>
        <div class="tag">OFFICIAL DONATION RECEIPT{{ !empty($settings['reg_number']) ? ' · REG. NO. '.strtoupper($settings['reg_number']) : '' }}</div>
    </div>
    <div class="body">
        <h2>RECEIPT {{ $donation->receipt_number }}</h2>

        <table class="kv">
            <tr><td class="k">Donor Name</td><td class="v">{{ $donation->donor_name }}</td></tr>
            @if ($donation->pan)<tr><td class="k">PAN</td><td class="v">{{ $donation->pan }}</td></tr>@endif
            @if ($donation->email)<tr><td class="k">Email</td><td class="v">{{ $donation->email }}</td></tr>@endif
            @if ($donation->mobile)<tr><td class="k">Mobile</td><td class="v">{{ $donation->mobile }}</td></tr>@endif
            @if ($donation->cause)<tr><td class="k">Cause</td><td class="v">{{ ucfirst($donation->cause) }}</td></tr>@endif
            <tr><td class="k">Payment Method</td><td class="v">{{ strtoupper($donation->method) }}</td></tr>
            <tr><td class="k">Type</td><td class="v">{{ $donation->frequency === 'monthly' ? 'Monthly' : 'One-time' }}</td></tr>
            @if (!empty($settings['bank_account_number']))<tr><td class="k">Received in A/c</td><td class="v">XXXX{{ substr($settings['bank_account_number'], -4) }} ({{ $settings['bank_ifsc'] }})</td></tr>@endif
            <tr><td class="k">Date of Payment</td><td class="v">{{ optional($donation->paid_at)->format('d M Y') }}</td></tr>
        </table>

        <div class="amount-box">
            <span style="font-size:11px;color:#45464f;letter-spacing:1px;">AMOUNT RECEIVED</span>
            <span class="amount">₹ {{ number_format((float) $donation->amount, 2) }}</span>
        </div>

        <p style="font-size:11.5px;margin-bottom:10px;"><i>Amount in words:</i> <b>{{ \Illuminate\Support\Number::spell((float) $donation->amount, 'en', 'INR') ?? number_format((float)$donation->amount).' rupees' }}</b></p>

        <img src="{{ $qr }}" width="64" height="64" alt="" style="float:right; margin-left: 14px;">
        @php($note80g = $settings['tax_note_80g'] ?? null)
        <p class="note">
            @if ($note80g)
                {!! nl2br(e($note80g)) !!}<br><br>
            @else
                This receipt acknowledges the above contribution to Hum Hain Na Foundation.<br><br>
            @endif
            Verify this receipt at any time by scanning the QR code or visiting our website's verification page with the receipt number.
        </p>
        <div style="clear:both"></div>
    </div>
    <div class="foot">
        With heartfelt gratitude for your generosity — your support directly funds education drives, health camps and relief work.
        @if (!empty($settings['email']) || !empty($settings['phone']))
            <br>{{ $settings['email'] ?? '' }} {{ !empty($settings['phone']) ? ' · '.$settings['phone'] : '' }}
        @endif
    </div>
</div>
</body>
</html>
