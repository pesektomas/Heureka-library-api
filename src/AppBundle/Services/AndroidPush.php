<?php

namespace AppBundle\Services;

class AndroidPush
{

	public function push($accessKey)
	{
		$registrationIds = 'dSzRu0dmVDY:APA91bHJOhC32R0elkoG8zYKtwgHsvKKBVv5a-6PeGkfMsXZctojH2UMMrixEEOyjX9mgCWb201B5Hab5PRrCRvW18XqDjPvNzVJDwXBUoRurPGUmV9Fb_QsoxLQPbK3Gr_1-nCq1aR2';
		$msg =
		[
			'message' 	=> 'here is a message. message',
			'title'		=> 'This is a title. title',
			'subtitle'	=> 'This is a subtitle. subtitle',
			'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
			'vibrate'	=> 1,
			'sound'		=> 1,
		];
		$fields =
		[
			'registration_ids' 	=> $registrationIds,
			'data'			=> $msg
		];

		$headers =
		[
			'Authorization: key=' . 'AIzaSyDGsibOZwMkB9m92TP5qcWPUxpx_zGqU38',
			'Content-Type: application/json'
		];

		$ch = \curl_init();
		\curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		\curl_setopt( $ch,CURLOPT_POST, true );
		\curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		\curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		\curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		\curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = \curl_exec($ch );
		\curl_close( $ch );
	}
}