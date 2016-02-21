# Eloquent Sentiment

Laravel 5 package for adding sentiment to eloquent models.

## Installation

This package can be installed through Composer.
```bash
composer require mintbridge/eloquent-sentiment
```

Once installed add the service provider and facade to your app config
```php
// config/app.php

'providers' => [
    '...',
    'Mintbridge\EloquentSentiment\SentimentServiceProvider',
];

'aliases' => [
    '...',
    'Sentiment' => 'Mintbridge\EloquentSentiment\SentimentFacade',
];
```

You'll also need to publish and run the migration in order to create the database table.
```
php artisan vendor:publish --provider="Mintbridge\EloquentSentiment\SentimentServiceProvider" --tag="config"
php artisan vendor:publish --provider="Mintbridge\EloquentSentiment\SentimentServiceProvider" --tag="migrations"
php artisan migrate
```

The configuration will be written to ```config/eloquent-sentiment.php```. The options have sensible defaults but you should change the user model to match the one used in your application.

## Usage

This package will allow your users to add sentiment to models used in your application. To do so the models that you would like to be sentimentable must use the `Sentimentable` trait and implement `SentimentableInterface`.

```php
use Mintbridge\EloquentSentiment\Sentimentable;
use Mintbridge\EloquentSentiment\SentimentableInterface;

class Article extends Eloquent implements SentimentableInterface {

    use Sentimentable;
    ...
}
```

Sentiment can be added to models by using the `SentimentManager` or more easily with the Sentiment facade:

```php
$article = Article::find(1);

// add article as a favourite
Sentiment::add('like', $article);

// remove article from by a favourite
Sentiment::remove('like', $article);

// toggle article as being a favourite
Sentiment::toggle('like', $article);
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

