<?php

return [
    /*
   |--------------------------------------------------------------------------
   | Models
   |--------------------------------------------------------------------------
   |
   | If you want, you can replace default models from this package by models
   | you created.
   |
   */

    'models' => [
        'approval' => \Pitisha\Models\Approval::class,
    ],

    /*
  |--------------------------------------------------------------------------
  | Tables
  |--------------------------------------------------------------------------
  |
  | If you want, you can replace default tables from this package
  |
  */
    'tables' => [
        'approval' => "approvals",
    ],

    /**
     * Allow soft delete
     */

    'softdelete' => true,

    /**
     * Approval level
     */
    'level' => 1,

    /**
     * the percentage of accepted approval
     */
    'approval_percentage' => 60

];
