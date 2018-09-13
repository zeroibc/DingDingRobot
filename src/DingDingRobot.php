<?php
/**
 * Created by PhpStorm.
 * User: zeroibc
 * Date: 2018/9/12
 * Time: 11:24
 * E-mail: zeroibc@qq.com
 */

namespace Zeroibc;

class DingDingRobot {
	public $url = '';
	public $messageType = 'text';
	public $content = [];
	public $atContent = [];

	public function __construct($url) {
		$this->url = $url;
	}

	public function setTextType() {
		$this->messageType = 'text';

		return $this;
	}

	public function setMarkdownType() {
		$this->messageType = 'markdown';

		return $this;
	}

	public function setActionCardType() {
		$this->messageType = 'actionCard';

		return $this;
	}

	public function setFeedCardType() {
		$this->messageType = 'feedCard';

		return $this;
	}

	public function setLinkType() {
		$this->messageType = 'link';

		return $this;
	}

	public function setContent(array $content) {
		$this->content[$this->messageType] = $content;

		return $this;
	}

	public function atMobile(array $mobile) {
		$this->atContent['at']['atMobiles'] = $mobile;

		return $this;
	}

	public function atAll($isAtAll = true) {
		$this->atContent['at']['isAtAll'] = $isAtAll;

		return $this;
	}

	public function send() {
		return $this->Request(array_merge(['msgtype' => $this->messageType], $this->content, $this->atContent));
	}

	private function Request(array $post_string) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json;charset=utf-8']);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_string));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);

		return json_decode($data, true);
	}
}