<?php
    class HelloController extends AppController{
        public $name="Hello";
        public $components=array('DebugKit.Toolbar');

        function index(){
            echo "hoge";
        }
    }


?>
