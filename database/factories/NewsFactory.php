<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use App\User;
use Faker\Generator as Faker;
use \Illuminate\Support\Str;

$factory->define(News::class, function (Faker $faker) {
    return [
        'writer_id' => factory(User::class),
        'category' => $faker->bs,
        'title' => $title = $faker->catchPhrase,
        'slug' => Str::slug($title),
        'headline' => $faker->bs,
        'body' => '
        <h1>Lorem ipsum dolor sit amet consectetuer adipiscing
elit</h1>

<p>'.$faker->realText(10000).'</p>

<ul>
  <li>Lorem ipsum dolor sit amet consectetuer.</li>
  <li>Aenean commodo ligula eget dolor.</li>
  <li>Aenean massa cum sociis natoque penatibus.</li>
</ul>

<p>Lorem ipsum dolor sit amet, consectetuer adipiscing
elit. Aenean commodo ligula eget dolor. Aenean massa.
Cum sociis natoque penatibus et magnis dis parturient
montes, nascetur ridiculus mus. Donec quam felis,
ultricies nec, pellentesque eu, pretium quis, sem.</p>

<p>Lorem ipsum dolor sit amet, consectetuer adipiscing
elit. Aenean commodo ligula eget dolor. Aenean massa.
Cum sociis natoque penatibus et magnis dis parturient
montes, nascetur ridiculus mus. Donec quam felis,
ultricies nec, pellentesque eu, pretium quis, sem.</p>

<table class="data">
  <tr>
    <th>Entry Header 1</th>
    <th>Entry Header 2</th>
    <th>Entry Header 3</th>
    <th>Entry Header 4</th>
  </tr>
  <tr>
    <td>Entry First Line 1</td>
    <td>Entry First Line 2</td>
    <td>Entry First Line 3</td>
    <td>Entry First Line 4</td>
  </tr>
  <tr>
    <td>Entry Line 1</td>
    <td>Entry Line 2</td>
    <td>Entry Line 3</td>
    <td>Entry Line 4</td>
  </tr>
  <tr>
    <td>Entry Last Line 1</td>
    <td>Entry Last Line 2</td>
    <td>Entry Last Line 3</td>
    <td>Entry Last Line 4</td>
  </tr>
</table>

<p>Lorem ipsum dolor sit amet, consectetuer adipiscing
elit. Aenean commodo ligula eget dolor. Aenean massa.
Cum sociis natoque penatibus et magnis dis parturient
montes, nascetur ridiculus mus. Donec quam felis,
ultricies nec, pellentesque eu, pretium quis, sem.</p>
'
    ];
});

