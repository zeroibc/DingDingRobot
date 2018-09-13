# DingDingRobot
钉钉机器人webhook

使用方法：
```php
 include_once 'vendor/autoload.php';
 
/**
 * 必填
 * 钉钉机器人的webhook地址
 */
 
 $robot = new \Zeroibc\DingDingRobot($web_hook);
 $content = [
    'content' => 'zeroibc'
 ];
 $robot->setTextType()->setContent($content)->send();
```