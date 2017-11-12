# Wordpress+Twig

A WordPress starter theme that utilizes MVC structure and Twig as its template engine.


## Installation

The preferred method of installation is to use Composer. In your WordPress project's `composer.json`, require WordPress+Twig:

```json
"require": {
  "jenwachter/wptwig": "dev-master"
}
```

_Note: There are no official releases of this project as of yet; therefore, dev-master is the branch to pull for now._

WordPress+Twig uses [Composer Installers](https://github.com/composer/installers), which allows the theme to be installed in a location other than `/vendor`. Define this location as your WordPress themes folder:

```json
"extra": {
  "installer-paths": {
    "public/wp-content/themes/{$name}/": ["type:wordpress-theme"]
  }
}
```

## Usage

You can find basic usage in the starter theme's `index.php` file:

```php
<?php
$page = new \wptwig\Controllers\Page($post);
$page->show();
```
A page controller is instantiated and the global `$post` object is passed in as the only argument. Then the controller's `show()` method is called, rendering the template.

Now, I'll go through all three application layers hidden in those two lines of code so that you can extend this starter theme as you need.

### Controller

The controller's job is to fetch data and the display that data in a template. In `src/Controllers/Page.php`, two properties are defined:

```php
public $modelName = "Page";
public $template = "page";
```

`$modelName` defines the name of the model the controller should instantiate, found in `src/Models/{$modelName}.php`. `$template`  defines the name of the template the data should be rendered in, found in `src/Views/{$template}.twig`.

Additionally, the Page controller extends from the Base controller, which does several things:

* Instantiates a model
* Creates a Twig environment
* Defines a `show()` method, which fetches data from the model and renders the data in the Twig template


### Model

The model's job is to gather all the data needed for the view. Since the view will be out of the WordPress scope, we need to gather all data we need for the template in the model, which is still in the WordPress scope. For example, you cannot call functions like `wp_header()` and `wp_footer()` in a Twig template.

Each model needs at least a `get()` method, which returns an array of data to the controller for rendering. In `src/Models/Page.php`, you'll see there is a `get()` method, but right now, all it does is extend from its parent, which gathers data like the post, its metadata, site header, site footer, and body classes. See `src/Models/base.php` for more details.

If you want to gather more information for the Page view, do so in the Page model's `get()` method. For example, to get an array of tags associated with the page, you can modify `get()` to look like this:

```php
<?php
public function get()
{
  $data = parent::get();

  // modify data for pages, if needed
  $data["tags"] = wp_get_post_tags($this->post->ID);

  return $data;
}
```


### View

The view's job is to render the data gathered by the model. For a simple example, see the templates in the `Views/` folder and the [Twig documentation](http://twig.sensiolabs.org/).
