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
```php
````
