<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";
    require_once __DIR__."/../src/Category.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=to_do');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Where it is coming from
    //What this is doing
    //Where is it going

    //(From) the web address
    //Links to the
    //(To) the get/categories page
    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.twig');
    });

    //(From) home page
    //(Will) List out all categories and give you the option to create a new one
    //(To) empty
    $app->get("/categories", function() use ($app) {
        return $app['twig']->render('categories.twig', array('categories' => Category::getAll())) ;
    });

    //(From) get/categories
    //(Will) add new category and save
    //(To) sends user and categories to post/categories
    $app->post("/categories", function() use ($app) {
        $name = $_POST['name'];
        $new_category = new Category($name);
        $new_category->save();
        return $app['twig']->render('categories.twig', array('categories' => Category::getAll()));
    });

    $app->get("/tasks", function() use ($app) {
        return $app['twig']->render('allfreakingtasks.twig', array('tasks' => Task::getAll()));
    });

    $app->post("tasks", function() use ($app) {
        $description = $_POST['description'];
        $new_task = new Task($description);
        $new_task->save();
        return $app['twig']->render('allfreakingtasks.twig', array('tasks' => Task::getAll()));
    });







    return $app;

?>
