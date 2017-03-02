<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\DataTables\ArticleDataTable;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommonController extends Controller {

    public function deleteCommonWithAjax(Request $request) {
        $tableName = $request->input('tableName');
        $id = $request->input('id');
        $force = $request->input('force');
        $databaseName = env("DB_DATABASE", "");
        if ($force) {
            $dataCheckersql = "SELECT 
                               TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
                               FROM
                               INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                               WHERE
                               REFERENCED_TABLE_SCHEMA = '" . $databaseName . "' AND
                               REFERENCED_TABLE_NAME = '$tableName';";
            $dataChecker = DB::select($dataCheckersql);

            $count = 0;
            foreach ($dataChecker as $dataCheckers) {
                $levelTwo = "SELECT 
                               TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
                               FROM
                               INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                               WHERE
                               REFERENCED_TABLE_SCHEMA = '" . $databaseName . "' AND
                               REFERENCED_TABLE_NAME = '" . $dataCheckers->TABLE_NAME . "';";

                $levelTwoData = DB::select($levelTwo);

                $StringArray = "SELECT id FROM " . $dataCheckers->TABLE_NAME . " WHERE " . $dataCheckers->COLUMN_NAME . " = $id";

                $IdInArray = DB::select($StringArray);

                if ($levelTwoData) {
                    foreach ($levelTwoData as $levelTwoDatas) {
                        foreach ($IdInArray as $IdInArrays) {
                            echo $stringToDelete = "DELETE FROM " . $levelTwoDatas->TABLE_NAME . " WHERE " . $levelTwoDatas->COLUMN_NAME . " = " . $IdInArrays->id . "";
                            DB::statement($stringToDelete);
                            $count++;
                        }
                    }
                    echo $levelData = "DELETE FROM " . $dataCheckers->TABLE_NAME . " WHERE " . $dataCheckers->COLUMN_NAME . " = $id";
                    DB::statement($levelData);
                    $count++;
                } else {
                    echo $levelData = "DELETE FROM " . $dataCheckers->TABLE_NAME . " WHERE " . $dataCheckers->COLUMN_NAME . " = $id";
                    DB::statement($levelData);
                    $count++;
                }
            }
            echo $sql = "DELETE FROM $tableName WHERE id = $id;";
            DB::statement($sql);
            echo 1;
            exit;
        }
        $dataCheckersql = "SELECT 
                    TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
                  FROM
                    INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                  WHERE
                    REFERENCED_TABLE_SCHEMA = '" . $databaseName . "' AND
                    REFERENCED_TABLE_NAME = '$tableName';";
        $dataChecker = DB::select($dataCheckersql);
        $count = 0;
        foreach ($dataChecker as $dataCheckers) {
            $dataCheckersql = "SELECT * FROM $dataCheckers->TABLE_NAME WHERE $dataCheckers->COLUMN_NAME = $id;";
            $dataChecker = DB::select($dataCheckersql);
            if ($dataChecker) {
                $count++;
            }
        }
        if ($count == 0) {
            $sql = "DELETE FROM $tableName WHERE id = $id;";
            DB::statement($sql);
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
        echo 1;
        exit;
    }

    public function lockUser(Request $request) {
        $id = $request->input('id');
        $locked = $request->input('locked');
        if ($locked == 1) {
            $locked = 0;
        } else if ($locked == 0) {
            $locked = 1;
        } else {
            echo 2;
        }
        $sql = "UPDATE `users` SET `locked` = '$locked' WHERE `users`.`id` = '$id';";
        DB::statement($sql);
        echo $locked;
        exit;
    }

}
