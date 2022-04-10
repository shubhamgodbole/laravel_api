<?php

return [
    'user_type' => array(
        'admin' => '1',
        'owner' => '2',
        'tenant' => '3',
    ),

    'booking_status' => array(
        'completed' => '1',
        'cancelled' => '2',
    ),
    
    'transection_status' => array(
        'pending' => '0',
        'success' => '1',
        'fail' => '2',
    ),

    'request_type' => array(
        'Registration' => 'Registration',
        'Login' => 'Login',
        'ForgotPassword' => 'ForgotPassword',
    ),
    'luxry_type' => array(
        '1' => 'Furnished',
        '2' => 'Non Furnished',
        '3' => 'Semi Furnished',
    ),

    'payment_mode' => array(
        'online' => '1',
        'pay_at_pg' => '2',
    ),
];