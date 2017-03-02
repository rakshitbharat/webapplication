<?php

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use App\DataTables\ArticleCategoryDataTable;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Image;
use Yajra\Datatables\Datatables;
use App\Models\ArticleCategory;
use App\Models\Cmspage;
use DB;

class GlobalDataComposer {

    public function compose(View $view) {
//        $articleCategory = ArticleCategory::select(['*'])->get();

  //      $sql = "SELECT * FROM cmspage WHERE slug != 'home';";
    //    $CmsPage = DB::select($sql);

      //  $view->with('GlobalArticleCategory', $articleCategory);
       // $view->with('GlobalCmsPage', $CmsPage);
    }

}
