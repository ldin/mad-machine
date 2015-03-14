<?php

//return array(
//
//    'initialize' => function($authority) {
//    	$user = $authority->getCurrentUser();
//    	
//        $authority->addAlias('manage', array('create', 'read', 'update', 'delete'));
//        $authority->addAlias('moderate', array('read', 'update', 'delete'));
//    }
//
//);

return array(

        'initialize' => function($authority) {

            $user = $authority->getCurrentUser();

            //action aliases
            $authority->addAlias('admin', array( 'read', 'update', 'create', 'delete', 'readUser', 'editUser'));
            $authority->addAlias('moderator', array('read', 'update', 'create', 'readUser'));
            $authority->addAlias('manager', array('read', 'update', 'readUser'));
            $authority->addAlias('user', array('read'));
            
            //an example using the `hasRole` function, see below examples for more details
            if($user->hasRole('mainAdmin')) {
                $authority->allow( 'admin', 'all');
                $authority->allow( 'right_to_all', 'all');
                $authority->allow( 'editProject', 'all');
            }
            if($user->hasRole('admin')) {
                $authority->allow( 'admin', 'all');
                $authority->allow( 'editProject', 'all');
            }
            if($user->hasRole('moderator')) {
                $authority->allow( 'moderator', 'all');
                $authority->allow( 'editProject', 'all');
            }
            if($user->hasRole('manager')) {
                $authority->allow( 'manager', 'all');
                $authority->allow( 'editProject', 'ProjectNews');
                $authority->allow( 'editProject', 'ProjectComment');
            }
            if($user->hasRole('user')) {
                $authority->allow( 'read', 'all');
                $authority->deny( 'read', 'ProjectBudget');
            }
            if($user->hasRole('investor')) {
                $authority->allow( 'read', 'all');
            }
            if($user->hasRole('developer')) {
                $authority->allow( 'read', 'all');
                $authority->deny( 'read', 'ProjectBudget');
            }
            if($user->hasRole('auth')) {
                $authority->deny( 'read', 'all');
            }

            // loop through each of the users permissions, and create rules
            foreach($user->permissions as $perm) {
                if($perm->type == 'allow') {
                    $authority->allow($perm->action, $perm->resource);
                } else {
                    $authority->deny($perm->action, $perm->resource);
                }
            }
        }

    );