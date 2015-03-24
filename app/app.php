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

        $description = $_POST['task'];
        $new_task = new Task($description);
        $new_task->save();

        $new_category->addTask($new_task);

        return $app['twig']->render('categories.twig', array('categories' => Category::getAll()));
    });

    $app->get("/categories/{id}/edit", function($id) use ($app){
        $my_category = Category::find($id);
        return $app['twig']->render('edit_category.twig', array('my_category' => $my_category, 'tasks' => $my_category->getTasks()));
    });

    $app->patch('/categories/{id}/edit', function($id) use ($app){
        $new_cat = $_POST['new_cat_name'];
        $cat = Category::find($id);
        $cat->update($new_cat);

        return $app['twig']->render('edit_category.twig', array('my_category' => $cat, 'tasks' => $cat->getTasks()));
    });

    $app->delete("/categories/{id}/delete", function($id) use ($app) {
        $category = Category::find($id);
        $category->delete();
        return $app['twig']->render('categories.twig', array('categories' => Category::getAll()));
    });

    //(from) home page
    //(will) list all tasks and allow adding a new task
    //(to) post/tasks
    $app->get("/tasks", function() use ($app) {
        return $app['twig']->render('alltasks.twig', array('tasks' => Task::getAll()));
    });

    //(from) get/tasks
    //(will) add a new task and list all tasks
    //(to) itself
    $app->post("/tasks", function() use ($app) {
        $description = $_POST['description'];
        $new_task = new Task($description);
        $new_task->save();

        $new_category_name = $_POST['category']; //this variable name can be changed later
        $new_category = new Category($new_category_name);

        $new_task->addCategory($new_category);

        return $app['twig']->render('alltasks.twig', array('tasks' => Task::getAll()));
    });

    $app->get("/tasks/{id}/edit", function($id) use ($app) {
        $my_task = Task::find($id); //send to main task page
        return $app['twig']->render('edit_task.twig', array('my_task' => $my_task, 'categories' => $my_task->getCategories()));
    });

    $app->patch("/tasks/{id}/edit", function($id) use ($app) { //
        $new_description = $_POST['new_description'];
        $task = Task::find($id);
        $task->update($new_description);

        $new_cat_name = $_POST['new_cat'];

        return $app['twig']->render('edit_task.twig', array('my_task' => Task::find($id), 'categories' => $task->getCategories()));
    });

    $app->delete("/tasks/{id}/delete", function($id) use ($app) {
        $task = Task::find($id);
        $task->delete();
        return $app['twig']->render('alltasks.twig', array('tasks' => Task::getAll()));
    });


    $app->delete("/delete_all_tasks", function() use ($app) {
        Task::deleteAll();
        return $app['twig']->render('alltasks.twig', array('tasks' => Task::getAll()));
    });

    $app->delete("/delete_all_categories", function() use ($app) {
        Category::deleteAll();
        return $app['twig']->render('categories.twig', array('categories' => Category::getAll()));
    });



    return $app;

?>
