<?php
    class User extends Model{
        public $name = 'User';
        public $useTable = 'users';
       
        public $validate = array(
            'name' => array(
                'between' => array(
                    'rule' => array('between',0,10),
                    'required' => true,
                    'alloEmpty' => false,
                    'message' => '10文字以内で必ず入力して下さい'
                ),
                'custom' => array(
                    'rule' => array('custom','/^[a-zA-Z]+$/'),
                    'message' => '半角英字で入力してください'
                ),
                'unique' => array(
                    'rule' => 'isUnique',
                    'message' =>'ユーザー名がかぶってます'

                )
            ),
            'email' => array(
                'rule' => 'email',
                'required' => true,
                'alloEmpty' => false,
                'message' => 'メールアドレスの形式で必ず入力して下さい'
            ),

            'password' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'alloEmpty' => false,
                'message' => '必ず入力して下さい'
            ),
            'pass_check' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'alloEmpty' => false,
                'message' => '必ず入力して下さい'
            )
        );
    }

?>