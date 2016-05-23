<?php

namespace AppBundle\Services;

class AndroidPush
{

	public function push($accessKey, array $registrationIds, $title, $message)
	{

		$msg = [
			'message'       => $message,
			'title'         => $title,
		];

		$fields = [
			'registration_ids'  => $registrationIds,
			'data'              => $msg
		];

		$headers = [
			'Authorization: key=' . $accessKey,
			'Content-Type: application/json'
		];

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		echo $result;

	}

}
