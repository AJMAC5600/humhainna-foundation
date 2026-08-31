<?php

return [
    // Fallback / defaults that Site Content (settings table) overrides once the admin saves.
    'upi_id' => env('HHNF_UPI_ID', 'humhainnafoundation@upi'),
    'org_short_name' => env('HHNF_ORG_SHORT_NAME', 'Hum Hain Na Foundation'),
    'org_name' => env('HHNF_ORG_NAME', 'Hum Hain Na Foundation'),
    'success_url' => env('HHNF_SUCCESS_URL', '/'),
];
