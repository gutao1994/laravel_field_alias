<?php
return [
    'express' => [
	    '1' => '圆通快递',
	    '2' => '申通快递',
	    '3' => '顺丰快递',
	    '4' => '韵达快递',
	    '5' => '德邦物流',
	    '6' => '中通快递',
	    '7' => '百世汇通',
	    '8' => 'EMS',
	    '9' => '安捷物流',
	    '10' => '天天快递',
	    '11' => '全峰快递',
	    '12' => '城市100',
	    '13' => '万象物流',
	    '14' => '全一快递',
	    '15' => '笨鸟海淘',
    ],
    'contract_status' => [
	    '1' => '邮寄中',
	    '2' => '备用',
	    '3' => '使用中',
	    '4' => '回邮中',
	    '5' => '回邮已收到',
	    '6' => '归档',
	    '10001' => '作废',
    ],
    'contract_exception_status' => [
	    '1' => '无异常',
	    '2' => '缺失',
	    '3' => '填错',
     ],
     'financial_role' => [
         'role_id' => env('FINANCIAL_ROLE_ID', 0),
         'role_name' => '金融端用户',
     ],
     'attributes' => [
	     'serial_number' => 'number',
	     'customer_name' => 'name',
	     'customer_mobile' => 'mobile',
	     'invest_earning' => 'interest',
	     'invest_money' => 'amount',
	     'invest_amount' => 'count',
	     'sign_time' => 'buy_date',
	     'bank_account' => 'bank_card',
	     'bank' => 'bank_name',
     ],
];





















