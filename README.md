Laravel-Pinyin
==========
Tags: Chinese, Pinyin, tag, slug, URL, rewrite, Bing, permalink, SEO, 标签, 别名, PHP, Laravel

## Installatio
n

The Pinyinslug service provider can be installed via [composer](http://getcomposer.org) by requiring the `lokielse/pinyin` package in your project's `composer.json`.

```json
{
    "require": {
        "lokielse/pinyin": "dev-master"
    }
}
```

Next, add the service provider to `app/config/app.php`.

```php
'providers' => [
    //..
    'Lokielse\Pinyin\PinyinServiceProvider',
]
```

Then, add alias
```php
'alias' => [
    //..
    'Pinyin'=>'Lokielse\Pinyin\Facades\PinyinFacade',
]

```

That's it! You're good to go.

Usages:
```php
Pinyin::convert('今天天气不错');
//JinTianTianQiBuCuo

Pinyin::convert('今天天气不错', Pinyin::POLICY_SHRINK);
//jintiantianqibucuo

Pinyin::convert('今天天气不错', Pinyin::POLICY_SHRINK, true);
//JINTIANTIANQIBUCUO

Pinyin::convert('今天天气不错', Pinyin::POLICY_CAMEL);
//jinTianTianQiBuCuo

Pinyin::convert('今天天气不错', Pinyin::POLICY_STUDLY);
//JinTianTianQiBuCuo

Pinyin::convert('今天天气不错', Pinyin::POLICY_UNDERSCORE);
//jin_tian_tian_qi_bu_cuo

Pinyin::convert('今天天气不错', Pinyin::POLICY_BLANK);
//jin tian tian qi bu cuo

Pinyin::convert('今天天气不错', Pinyin::POLICY_HYPHEN);
//jin-tian-tian-qi-bu-cuo

Pinyin::convert('叿吀吁吂吅', Pinyin::POLICY_HYPHEN);
//hong-mie-yu-mang-song

Pinyin::convert('喛喞喟喠喡喢喣', Pinyin::POLICY_HYPHEN);
//he-ji-huai-chong-wei-che-xu

//default
Pinyin::setDefaultPolicy(Pinyin::POLICY_UNDERSCORE);
Pinyin::setDefaultUpperCase(true);


```

