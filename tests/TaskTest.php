<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once 'src/Task.php';

    $server = 'mysql:host=localhost;dbname=todotest';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);




    class TaskTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Task::deleteAll();
        }



        function test_save()
        {
            $description = "Wash the dog";
            $test_task = new Task($description);

            $test_task->save();

            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_Task = new Task($description);
            $test_Task->save();
            $test_Task2 = new Task($description2);
            $test_Task2->save();

            $result = Task::getAll();

            $this->assertEquals([$test_Task, $test_Task2], $result);
        }

        function test_deleteAll()
        {
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_Task = new Task($description);
            $test_Task->save();
            $test_Task2 = new Task($description2);
            $test_Task2->save();

            Task::deleteAll();

            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            $description = "Wash the dog";
            $id = 1;
            $test_Task = new Task($description, $id);

            $result = $test_Task->getId();

            $this->assertEquals(1, $result);
        }
    }



 ?>
