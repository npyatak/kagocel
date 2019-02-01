<?php
/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii2-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace frontend\models\social;

class OkOAuth2Service extends \nodge\eauth\services\OdnoklassnikiOAuth2Service
{
	const SCOPE_GET_EMAIL = 'GET_EMAIL';

	protected $providerOptions = [
		'authorize' => 'https://www.odnoklassniki.ru/oauth/authorize',
		'access_token' => 'https://api.odnoklassniki.ru/oauth/token.do',
	];
	protected $baseApiUrl = 'https://api.odnoklassniki.ru/fb.do';

	protected $scopes = [self::SCOPE_GET_EMAIL];

	protected function fetchAttributes()
	{
	    $info = $this->makeSignedRequest('', [
			'query' => [
				'method' => 'users.getCurrentUser',
				'format' => 'JSON',
				'application_key' => $this->clientPublic,
				'client_id' => $this->clientId,
			],
		]);

		$this->attributes['id'] = $info['uid'];
		//$this->attributes['name'] = $info['name'];
		$this->attributes['first_name'] = $info['first_name'];
		$this->attributes['last_name'] = $info['last_name'];
		$this->attributes['birthdate'] = strtotime($info['birthday']);

		return true;
	}


	/**
	 * @param string $link
	 * @param string $message
	 * @return array
	 */
	public function wallPost($link, $message)
	{
		return $this->makeSignedRequest('', [
			'query' => [
				'application_key' => $this->clientPublic,
				'method' => 'share.addLink',
				'format' => 'JSON',
				'linkUrl' => $link,
				'comment' => $message,
			],
		]);
	}

}
