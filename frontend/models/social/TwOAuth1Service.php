<?php
/**
 * An example of extending the provider class.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii2-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace frontend\models\social;

class TwOAuth1Service extends \nodge\eauth\services\TwitterOAuth1Service
{

	protected function fetchAttributes()
	{
		$info = $this->makeSignedRequest('account/verify_credentials.json');

		$this->attributes['id'] = $info['id'];
		$this->attributes['name'] = $info['name'];
		$this->attributes['url'] = 'http://twitter.com/account/redirect_by_id?id=' . $info['id_str'];

		$this->attributes['username'] = $info['screen_name'];
		$exp = explode(' ', $info['name']);
		$this->attributes['first_name'] = $exp[0];
		if(isset($exp[1])) $this->attributes['last_name'] = $exp[1];

		if(isset($info['location'])) {
			$exp = explode(', ', $info['location']);
			if(isset($exp[1])) {
				$this->attributes['city'] = $exp[0];
				$this->attributes['country'] = $exp[1];
			} else {
				$this->attributes['country'] = $exp[0];
			}
		}

		$this->attributes['sex'] = 0;
		$this->attributes['photo_url'] = $info['profile_image_url'];
		
		return true;
	}

	/**
	 * Returns the error array.
	 *
	 * @param array $response
	 * @return array the error array with 2 keys: code and message. Should be null if no errors.
	 */
	protected function fetchResponseError($response)
	{
		if (isset($response['errors'])) {
			$first = reset($response['errors']);
			return [
				'code' => $first['code'],
				'message' => $first['message'],
			];
		}
		return null;
	}
}