# ACF Forms
Helper package to use ACF forms in the front-end. What it does:

- Adds the ability to send notifications
- A default "Admin" notification
- Saves entries to the database

**This package requires [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) v5 to be installed.**

## Install
```sh
composer require trendwerk/acf-forms
```

## Usage
Creating and showing a form with this package consists of three parts:

1. [Initialize package](#initialize)
2. [Register form](#register-form)
3. [Render form](#render)

### Initialize
```php
$acfForms = new \Trendwerk\AcfForms\AcfForms();
$acfForms->init();
```

This code should be run when bootstrapping your theme (traditionally done via `functions.php`). Initialization creates the `entries` post type and sets up defaults form handlers and notifications.

### Register form
```php
$acfForms->register($name, $options);
```

| Parameter | Default | Required | Description |
| :--- | :--- | :--- | :--- |
| `$name` | `null` | Yes | (Unique) name / slug of the form
| `$options` | `null` | Yes | Array with options. See [Options](#options)


### Render
Rendering a form consists of two parts:

- Displaying the form
- Handling form data and enqueue-ing scripts (`Form::head()`)

For example:

```php
use Trendwerk\AcfForms\Form\Form;

Form::head();
...
$form = new Form($name);
$form->render();
```

In reality, the `render` method will be called somewhere inside your actual template.

## Options

| Parameter | Default | Required | Description |
| :--- | :--- | :--- | :--- |
| `acfForm` | `null` | Yes | Options passed to the `acf_form`(https://www.advancedcustomfields.com/resources/acf_form/) function. **`field_groups` is a required property.**
| `label` | `null` | No | Label used in the e-mail subject and entry title. If left empty, the unique form name will be used
| `notifications` | `['Trendwerk\\AcfForms\\Notification\\Admin']` | No | Notifications that are sent via e-mail after form submission. See [Notifications](#notifications)

### Notifications


## Example
The example below walks through all three steps of creating and showing a form, based on a field group. This example uses Twig, [Timber](https://github.com/timber/timber) and [Sphynx](https://github.com/trendwerk/sphynx).

#### `functions.php`
```php
$acfForms = new \Trendwerk\AcfForms\AcfForms();
$acfForms->init();

$acfForms->register('contact', [
    'acfForm'          => [
        'field_groups' => ['group_565474dcb9dd0'],
    ],
]);
```

Field group keys can be found when showing the `slug` of the field group or in the corresponding JSON file.

#### `page-contact.php`
```php
<?php
// Template name: Contact

use Timber\Post;
use Trendwerk\AcfForms\Form\Form;

Form::head();

$context = Timber::get_context();
$context['post'] = new Post();
$context['form'] = new Form('contact');

Timber::render('page-contact.twig', $context);

```

#### `page-contact.twig`
```twig
{% extends 'base.twig' %}

{% block content %}
  <h1>
    {{ post.title }}
  </h1>

  {{ post.content }}

  {{ form.render() }}
{% endblock %}
```
