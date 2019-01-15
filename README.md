#weather

基于 [高德开放平台](https://lbs.amap.com/dev/id/newuser) 的 PHP 天气信息组件

## 安装   
```sh
$ composer require sylvia/weather -vvv
```

## 配置
在使用本拓展之前，你需要去 [高德开放平台](https://lbs.amap.com/dev/id/newuser) 注册账号，然后创建应用，获取应用的 API Key。

## 使用

```php
use Sylvia\Weather\Weather;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Weather($key);
```

### 获取实时天气

```php
$response = $weather->getWeather('上海');
```
### 示例：
```php
{
  "status" => "1",
  "count" => "1",
  "info" => "OK",
  "infocode" => "10000",
  "lives" => [
    {
      "province" => "上海"
      "city" => "上海市"
      "adcode" => "310000"
      "weather" => "阴"
      "temperature" => "7"
      "winddirection" => "北"
      "windpower" => "≤3"
      "humidity" => "83"
      "reporttime" => "2019-01-15 10:45:47"
    }
  ]
}
```

### 获取近期天气预报
```
$response = $weather->getWeather('深圳', 'all');
```

示例：
```php
{
  "status" => "1",
  "count" => "1",
  "info" => "OK",
  "infocode" => "10000",
  "forecasts" =>[
  {
      "city" => "上海市",
      "adcode" => "310000",
      "province" => "上海",
      "reporttime" => "2019-01-15 10:45:47",
      "casts" => [
        {
          "date" => "2019-01-15"
          "week" => "2"
          "dayweather" => "小雨"
          "nightweather" => "多云"
          "daytemp" => "8"
          "nighttemp" => "2"
          "daywind" => "北"
          "nightwind" => "北"
          "daypower" => "5"
          "nightpower" => "5"
        },
        {
          "date" => "2019-01-16"
          "week" => "3"
          "dayweather" => "多云"
          "nightweather" => "多云"
          "daytemp" => "5"
          "nighttemp" => "0"
          "daywind" => "北"
          "nightwind" => "北"
          "daypower" => "≤3"
          "nightpower" => "≤3"
        },
        {
          "date" => "2019-01-17"
          "week" => "4"
          "dayweather" => "晴"
          "nightweather" => "晴"
          "daytemp" => "7"
          "nighttemp" => "1"
          "daywind" => "西北"
          "nightwind" => "西北"
          "daypower" => "≤3"
          "nightpower" => "≤3"
        },
        {
          "date" => "2019-01-18"
          "week" => "5"
          "dayweather" => "晴"
          "nightweather" => "多云"
          "daytemp" => "10"
          "nighttemp" => "5"
          "daywind" => "东南"
          "nightwind" => "东南"
          "daypower" => "4"
          "nightpower" => "4"
        }
      ]
  }]
}
```

### 获取 XML 格式返回值
第三个参数为返回值类型，可选 `json` 与 `xml`，默认 `json`：

```php
$response = $weather->getWeather('深圳', 'all', 'xml');
```
示例：

```xml
<response>
    <status>1</status>
    <count>1</count>
    <info>OK</info>
    <infocode>10000</infocode>
    <lives type="list">
        <live>
            <province>广东</province>
            <city>深圳市</city>
            <adcode>440300</adcode>
            <weather>中雨</weather>
            <temperature>27</temperature>
            <winddirection>西南</winddirection>
            <windpower>5</windpower>
            <humidity>94</humidity>
            <reporttime>2018-08-21 16:00:00</reporttime>
        </live>
    </lives>
</response>
```

### 参数说明

```
array | string   getWeather(string $city, string $type = 'base', string $format = 'json')
```
> - `$city` - 城市名，比如：“深圳”；
> - `$type` - 返回内容类型：`base`: 返回实况天气 / `all`:返回预报天气；
> - `$format`  - 输出的数据格式，默认为 json 格式，当 output 设置为 “`xml`” 时，输出的为 XML 格式的数据。
​
### 在 Laravel 中使用

在 Laravel 中使用也是同样的安装方式，配置写在 `config/services.php` 中：

```php
	.
	.
	.
	 'weather' => [
		'key' => env('WEATHER_API_KEY'),
    ],
```

然后在 `.env` 中配置 `WEATHER_API_KEY` ：

```env
WEATHER_API_KEY=xxxxxxxxxxxxxxxxxxxxx
```

可以用两种方式来获取 `Overtrue\Weather\Weather` 实例：
#### 方法参数注入

```php
	.
	.
	.
	public function edit(Weather $weather) 
	{
		$response = $weather->getWeather('深圳');
	}
	.
	.
	.
```

#### 服务名访问

```php
	.
	.
	.
	public function edit() 
	{
		$response = app('weather')->getWeather('深圳');
	}
	.
	.
	.

```

## 参考

- [高德开放平台天气接口](https://lbs.amap.com/api/webservice/guide/api/weatherinfo/)

## License

MIT