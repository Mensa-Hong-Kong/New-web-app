<?php
    return [
        'apiIPs' => env( "STRIPE_API_IPS" ),
        'apiArrayKey' => env( "STRIPE_API_ARRAY_KEY" ),
        'armadaGatorIPs' => env( "STRIPE_ARMADA_GATOR_IPS" ),
        'armadaGatorArrayKey' => env( "STRIPE_ARMADA_GATOR_ARRAY_KEY" ),
        'webhookIPs' => env( "STRIPE_WEBHOOK_IPS" ),
        'webhookArrayKey' => env( "STRIPE_WEBHOOK_ARRAY_KEY" ),
    ];
